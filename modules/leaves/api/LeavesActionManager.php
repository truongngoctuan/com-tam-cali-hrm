<?php
/*
This file is part of iCE Hrm.

iCE Hrm is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

iCE Hrm is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with iCE Hrm. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------

Original work Copyright (c) 2012 [Gamonoid Media Pvt. Ltd]  
Developer: Thilina Hasantha (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */

class LeavesActionManager extends SubActionManager{
	
	const FULLDAY = 1;
	const HALFDAY = 0;
	const NOTWORKINGDAY = 2;
	
	public function addLeave($req){
		$employee = $this->baseService->getElement('Employee',$this->getCurrentEmployeeId());
		$rule = $this->getLeaveRule($employee, $req->leave_type);
		
		if($rule->employee_can_apply == "No"){
			return new IceResponse(IceResponse::ERROR,"You are not allowed to apply for this type of leaves");		
		}


		//Find Current leave period
		$leaveCounts = array();
		$currentLeavePeriod = $this->getCurrentLeavePeriod();
		if(empty($currentLeavePeriod)){
			return new IceResponse(IceResponse::ERROR,"Leave period is not defined");
		}
		
		//Validate leave days
		$days = json_decode($req->days);
		foreach($days as $day=>$type){
			
			$sql = "select ld.id as leaveId from EmployeeLeaveDays ld join EmployeeLeaves el on ld.employee_leave = el.id where el.employee = ? and el.leave_type = ? and ld.leave_date = ? and ld.leave_type = ? and el.status <> 'Rejected'";
			$rs = $this->baseService->getDB()->Execute($sql, array($employee->id,$req->leave_type,date("Y-m-d",strtotime($day)),$type));
			$counter = 0;
			foreach ($rs as $k => $v) {
				$counter++;
			}	
			
			if($counter > 0){
				return new IceResponse(IceResponse::ERROR,"This leave is overlapping with another leave you have already applied");	
			}
		}

		//Adding Employee Leave
		$employeeLeave = new EmployeeLeave();
		$employeeLeave->employee = $employee->id;
		$employeeLeave->leave_type = $req->leave_type;
		$employeeLeave->leave_period = $currentLeavePeriod->id;
		$employeeLeave->date_start = $req->date_start;
		$employeeLeave->date_end = $req->date_end;
		$employeeLeave->details = $req->details;
		$employeeLeave->status = "Pending";
		$employeeLeave->details = $req->details;
		
		$ok = $employeeLeave->Save();
		
		if(!$ok){
			error_log($employeeLeave->ErrorMsg());
			return new IceResponse(IceResponse::ERROR,"Error occured while applying leave.");	
		}
		
		$days = json_decode($req->days);
		
		foreach($days as $day=>$type){
			$employeeLeaveDay = new EmployeeLeaveDay();
			$employeeLeaveDay->employee_leave = $employeeLeave->id;	
			$employeeLeaveDay->leave_date = date("Y-m-d",strtotime($day));
			$employeeLeaveDay->leave_type = $type;
			$employeeLeaveDay->Save();
		}
		
		if(!empty($this->emailSender)){
			$leavesEmailSender = new LeavesEmailSender($this->emailSender, $this);
			$leavesEmailSender->sendLeaveApplicationEmail($employee);
			$leavesEmailSender->sendLeaveApplicationSubmittedEmail($employee);
		}
		
		return new IceResponse(IceResponse::SUCCESS,$employeeLeave);
	}

	public function getLeaveDays($req){
				
		$employee = $this->baseService->getElement('Employee',$this->getCurrentEmployeeId());
		$rule = $this->getLeaveRule($employee, $req->leave_type);
		
		if($this->user->user_level == 'Admin' && $this->getCurrentEmployeeId() != $this->user->employee){
			//Admin is updating information for an employee	
		}else{
			if($rule->employee_can_apply == "No"){
				return new IceResponse(IceResponse::ERROR,"You are not allowed to apply for this type of leaves");		
			}	
		}

		//Find Current leave period
		$leaveCounts = array();
		$currentLeavePeriod = $this->getCurrentLeavePeriod();
		if(empty($currentLeavePeriod)){
			return new IceResponse(IceResponse::ERROR,"Leave period is not defined");
		}

		$leaveMatrix = $this->getAvailableLeaveMatrixForEmployeeLeaveType($employee, $currentLeavePeriod, $req->leave_type);

		$leaves = array();
		$leaves['totalLeaves'] = floatval($leaveMatrix[0]);
		$leaves['pendingLeaves'] = floatval($leaveMatrix[1]);
		$leaves['approvedLeaves'] = floatval($leaveMatrix[2]);
		$leaves['rejectedLeaves'] = floatval($leaveMatrix[3]);
		$leaves['availableLeaves'] = $leaves['totalLeaves'] - $leaves['pendingLeaves'] -  $leaves['approvedLeaves'];

		$startDate = $req->start_date;
		$endDate = $req->end_date;
		$days = array();
		$days = $this->getDays($startDate, $endDate);
		$dayMap = array();
		foreach($days as $day){
			$dayMap[$day] = $this->getDayWorkTime($day);
		}
		
		return new IceResponse(IceResponse::SUCCESS,array($dayMap,$leaves,$rule));
	}
	
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
	
	private function getDays($start, $end){
		$days = array();
		$curent = $start;
		while(strtotime($curent)<=strtotime($end)){
			$days[] = $curent;
			$curent = date("Y-m-d",strtotime("+1 day",strtotime($curent)));	
		}
		return $days; 
	}
	
	private function getDayWorkTime($day){
		$holiday = $this->getHoliday($day);
		if(!empty($holiday)){
			if($holiday->status == 'Full Day'){
				return self::NOTWORKINGDAY;	
			}else{
				return self::HALFDAY;
			}	
		}
		
		$workday = $this->getWorkDay($day);
		if(empty($workday)){
			return self::FULLDAY;
		}
		
		if($workday->status == 'Full Day'){
			return self::FULLDAY;
		}else if($workday->status == 'Half Day'){
			return self::HALFDAY;
		}else{
			return self::NOTWORKINGDAY;
		}
		
	}
	
	private function getWorkDay($day){
		$dayName = date("l",strtotime($day));
		$workDay = new WorkDay();
		$workDay->Load("name = ?",array($dayName));
		if($workDay->name == $dayName){
			return $workDay;	
		}
		return null;
	}
	
	private function getHoliday($day){
		$hd = new HoliDay();
		$hd->Load("dateh = ?",$day);
		if($hd->dateh == $day){
			return $hd;	
		}	
		return null;
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
			error_log($employeeLeave->ErrorMsg());
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
		
		$employee = $this->baseService->getElement('Employee',$this->getCurrentEmployeeId());
		
		$subordinate = new Employee();
		$subordinates = $subordinate->Find("supervisor = ?",array($employee->id));
		
		$subordinatesIds = "";
		foreach($subordinates as $sub){
			if($subordinatesIds != ""){
				$subordinatesIds.=",";	
			}
			$subordinatesIds.=$sub->id;
		}
		$subordinatesIds.="";
		
		
		$mappingStr = $req->sm;
		$map = json_decode($mappingStr);
		$employeeLeave = new EmployeeLeave();
		$list = $employeeLeave->Find("employee in (".$subordinatesIds.")",array());	
		if(!$list){
			error_log($employeeLeave->ErrorMsg());	
		}
		if(!empty($mappingStr)){
			$list = $this->baseService->populateMapping($list,$map);	
		}
		return new IceResponse(IceResponse::SUCCESS,$list);
	}
	
	public function changeLeaveStatus($req){
		
		$employee = $this->baseService->getElement('Employee',$this->getCurrentEmployeeId());
		
		$subordinate = new Employee();
		$subordinates = $subordinate->Find("supervisor = ?",array($employee->id));
		
		$subordinatesIds = array();
		foreach($subordinates as $sub){
			$subordinatesIds[] = $sub->id;
		}
		
		
		$employeeLeave = new EmployeeLeave();
		$employeeLeave->Load("id = ?",array($req->id));
		if($employeeLeave->id != $req->id){
			return new IceResponse(IceResponse::ERROR,"Leave not found");
		}
		
		if(!in_array($employeeLeave->employee, $subordinatesIds) && $this->user->user_level != 'Admin'){
			return new IceResponse(IceResponse::ERROR,"This leave does not belong to any of your subordinates");	
		}
		
		$employeeLeave->status = $req->status;
		$ok = $employeeLeave->Save();
		if(!$ok){
			error_log($employeeLeave->ErrorMsg());
		}
		
		
		if(!empty($this->emailSender)){
			$leavesEmailSender = new LeavesEmailSender($this->emailSender, $this);
			$leavesEmailSender->sendLeaveStatusChangedEmail($employee, $employeeLeave);
		}
		
		return new IceResponse(IceResponse::SUCCESS,"");
	}

}