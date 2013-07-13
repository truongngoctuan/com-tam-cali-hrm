<?php
class LeavesEmailSender{
	
	var $emailSender = null;
	var $subActionManager = null;
	
	public function __construct($emailSender, $subActionManager){
		$this->emailSender = $emailSender;	
		$this->subActionManager = $subActionManager;	
	}
	
	private function getEmployeeSupervisor($employee){
		
		if(empty($employee->supervisor)){
			error_log("Employee supervisor is empty");
			return null;
		}
		
		$sup = new Employee();
		$sup->Load("id = ?",array($employee->supervisor));
		if($sup->id != $employee->supervisor){
			error_log("Employee supervisor not found");
			return null;	
		}	
		
		return $sup;
	}
	
	private function getEmployeeById($id){
		$sup = new Employee();
		$sup->Load("id = ?",array($id));
		if($sup->id != $id){
			error_log("Employee not found");
			return null;	
		}	
		
		return $sup;	
	}
	
	public function sendLeaveApplicationEmail($employee){
		
		$sup = $this->getEmployeeSupervisor($employee);
		if(empty($sup)){
			return false;
		}
		
		$params = array();
		$params['supervisor'] = $sup->first_name." ".$sup->last_name; 
		$params['name'] = $employee->first_name." ".$employee->last_name; 
		$params['url'] = CLIENT_BASE_URL; 
		
		$email = $this->subActionManager->getEmailTemplate('leaveApplied.html');
		
		$this->emailSender->sendEmail("Leave Application Received",$sup->work_email,$email,$params);
	}
	
	public function sendLeaveApplicationSubmittedEmail($employee){
		
		
		$params = array(); 
		$params['name'] = $employee->first_name." ".$employee->last_name; 
		
		$email = $this->subActionManager->getEmailTemplate('leaveSubmittedForReview.html');
		
		$this->emailSender->sendEmail("Leave Application Submitted",$employee->work_email,$email,$params);
	}
	
	public function sendLeaveStatusChangedEmail($employee, $leave){
		
		$emp = $this->getEmployeeById($leave->employee);
		
		$params = array(); 
		$params['name'] = $emp->first_name." ".$emp->last_name; 
		$params['startdate'] = $leave->date_start; 
		$params['enddate'] = $leave->date_end; 
		$params['status'] = $leave->status; 
		
		$email = $this->subActionManager->getEmailTemplate('leaveStatusChanged.html');
		
		$this->emailSender->sendEmail("Leave Application ".$leave->status,$emp->work_email,$email,$params);
	}
}