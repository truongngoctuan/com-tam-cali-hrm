<?php
class LeavesActionManager extends SubActionManager{
	
	const FULLDAY = 1;
	const HALFDAY = 0;
	const NOTWORKINGDAY = 2;
	
	
	
	public function getLeaveDaysReadonly($req){
		$leaveId = $req->leave_id;
		
		$employeeLeave = new EmployeeLeave();
		$employeeLeave->Load("id = ?",array($leaveId));

		$employee = $this->baseService->getElement('Employee',$employeeLeave->employee);
		$rule = $this->getLeaveRule($employee, $employeeLeave->leave_type);
		
		$currentLeavePeriod = $this->getCurrentLeavePeriod();

		$leaveMatrix = $this->getAvailableLeaveMatrixForEmployeeLeaveType($employee, $currentLeavePeriod, $employeeLeave->leave_type);

		$leaves = array();
		$leaves['totalLeaves'] = floatval($leaveMatrix[0]);
		$leaves['pendingLeaves'] = floatval($leaveMatrix[1]);
		$leaves['approvedLeaves'] = floatval($leaveMatrix[2]);
		$leaves['rejectedLeaves'] = floatval($leaveMatrix[3]);
		$leaves['availableLeaves'] = $leaves['totalLeaves'] - $leaves['pendingLeaves'] -  $leaves['approvedLeaves'];

		$employeeLeaveDay = new EmployeeLeaveDay();
		$days = $employeeLeaveDay->Find("employee_leave = ?",array($leaveId));
		return new IceResponse(IceResponse::SUCCESS,array($days,$leaves));
	}
	

	private function getAvailableLeaveMatrixForEmployee($employee,$currentLeavePeriod){


		//Iterate all leave types and create leave matrix
		/**
		 * [[Leave Type],[Total Available],[Pending],[Approved],[Rejected]]
		 */
		$leaveType = new LeaveType();
		$leaveTypes = $leaveType->Find("1=1",array());

		foreach($leaveTypes as $leaveType){
			$employeeLeaveQuota = new stdClass();
				
			$rule = $this->getLeaveRule($employee, $leaveType->id);
			$employeeLeaveQuota->avalilable = floatval($rule->default_per_year);
			$pending = $this->countLeaveAmounts($this->getEmployeeLeaves($employee->id, $currentLeavePeriod->id, $leaveType->id, 'Pending'));
			$approved = $this->countLeaveAmounts($this->getEmployeeLeaves($employee->id, $currentLeavePeriod->id, $leaveType->id, 'Approved'));
			$rejected = $this->countLeaveAmounts($this->getEmployeeLeaves($employee->id, $currentLeavePeriod->id, $leaveType->id, 'Rejected'));
				
				
			$leaveCounts[$leaveType->name] = array($avalilable,$pending,$approved,$rejected);
		}

		return $leaveCounts;

	}

	private function getAvailableLeaveMatrixForEmployeeLeaveType($employee,$currentLeavePeriod,$leaveTypeId){

		/**
		 * [Total Available],[Pending],[Approved],[Rejected]
		 */

		$rule = $this->getLeaveRule($employee, $leaveTypeId);
		$avalilable = $rule->default_per_year;
		$pending = $this->countLeaveAmounts($this->getEmployeeLeaves($employee->id, $currentLeavePeriod->id, $leaveTypeId, 'Pending'));
		$approved = $this->countLeaveAmounts($this->getEmployeeLeaves($employee->id, $currentLeavePeriod->id, $leaveTypeId, 'Approved'));
		$rejected = $this->countLeaveAmounts($this->getEmployeeLeaves($employee->id, $currentLeavePeriod->id, $leaveTypeId, 'Rejected'));

		return array($avalilable,$pending,$approved,$rejected);


	}

	private function countLeaveAmounts($leaves){
		$amount = 0;
		foreach($leaves as $leave){
			$empLeaveDay = new EmployeeLeaveDay();
			$leaveDays = $empLeaveDay->Find("employee_leave = ?",array($leave->id));
			foreach($leaveDays as $leaveDay){
				if($leaveDay->leave_type == 'Full Day'){
					$amount += 1;
				}else if($leaveDay->leave_type == 'Half Day - Morning'){
					$amount += 0.5;
				}else if($leaveDay->leave_type == 'Half Day - Afternoon'){
					$amount += 0.5;
				}
			}
		}
		return floatval($amount);
	}

	private function getEmployeeLeaves($employeeId,$leavePeriod,$leaveType,$status){
		$employeeLeave = new EmployeeLeave();
		$employeeLeaves = $employeeLeave->Find("employee = ? and leave_period = ? and leave_type = ? and status = ?",
		array($employeeId,$leavePeriod,$leaveType,$status));
		if(!$employeeLeaves){
			error_log($employeeLeave->ErrorMsg(),true);
		}
		
		return $employeeLeaves;
			
	}

	private function getCurrentLeavePeriod(){
		$leavePeriod = new LeavePeriod();
		$leavePeriod->Load("status = ?",array('Active'));
		if($leavePeriod->status == 'Active'){
			return $leavePeriod;
		}
		return null;
	}

	private function getLeaveRule($employee,$leaveType){
		$rule = null;
		$leaveRule = new LeaveRule();
		$leaveTypeObj = new LeaveType();
		$rules = $leaveRule->Find("employee = ? and leave_type = ?",array($employee->id,$leaveType));
		if(count($rules)>0){
			return $rules[0];
		}

		$rules = $leaveRule->Find("job_title = ? and employment_status = ? and leave_type = ? and employee is null",array($employee->job_title,$employee->employment_status,$leaveType));
		if(count($rules)>0){
			return $rules[0];
		}

		$rules = $leaveRule->Find("job_title = ? and employment_status is null and leave_type = ? and employee is null",array($employee->job_title,$leaveType));
		if(count($rules)>0){
			return $rules[0];
		}

		$rules = $leaveRule->Find("job_title is null and employment_status = ? and leave_type = ? and employee is null",array($employee->employment_status,$leaveType));
		if(count($rules)>0){
			return $rules[0];
		}

		$rules = $leaveTypeObj->Find("id = ?",array($leaveType));
		if(count($rules)>0){
			return $rules[0];
		}

	}
	
	
	public function getSubEmployeeLeaves($req){

		$mappingStr = $req->sm;
		$map = json_decode($mappingStr);
		$employeeLeave = new EmployeeLeave();
		$list = $employeeLeave->Find("1=1");	
		if(!$list){
			error_log($employeeLeave->ErrorMsg());	
		}
		if(!empty($mappingStr)){
			$list = $this->baseService->populateMapping($list,$map);	
		}
		
		return new IceResponse(IceResponse::SUCCESS,$list);
	}
	
	public function changeLeaveStatus($req){
		
		//$employee = $this->baseService->getElement('Employee',$this->getCurrentEmployeeId());
		
		
		$employeeLeave = new EmployeeLeave();
		$employeeLeave->Load("id = ?",array($req->id));
		if($employeeLeave->id != $req->id){
			return new IceResponse(IceResponse::ERROR,"Leave not found");
		}
		
		if($this->user->user_level != 'Admin'){
			return new IceResponse(IceResponse::ERROR,"Only an admin can do this");	
		}
		
		$employeeLeave->status = $req->status;
		$ok = $employeeLeave->Save();
		if(!$ok){
			error_log($employeeLeave->ErrorMsg());
		}
		return new IceResponse(IceResponse::SUCCESS,"");
	}

}