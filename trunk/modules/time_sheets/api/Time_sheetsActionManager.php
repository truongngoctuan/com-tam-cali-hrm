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

class Time_sheetsActionManager extends SubActionManager{
	public function getTimeEntries($req){
		$employee = $this->baseService->getElement('Employee',$this->getCurrentEmployeeId());
		$timeSheetEntry = new EmployeeTimeEntry();
		$list = $timeSheetEntry->Find("timesheet = ? order by date_start",array($req->id));
		$mappingStr = $req->sm;
		$map = json_decode($mappingStr);
		if(!$list){
			error_log($timeSheetEntry->ErrorMsg());	
		}
		error_log($mappingStr);
		if(!empty($mappingStr)){
			$list = $this->baseService->populateMapping($list,$map);	
		}
		return new IceResponse(IceResponse::SUCCESS,$list);	
	}
	
	public function changeTimeSheetStatus($req){
		$employee = $this->baseService->getElement('Employee',$this->getCurrentEmployeeId());
		
		$subordinate = new Employee();
		$subordinates = $subordinate->Find("supervisor = ?",array($employee->id));
		
		$subordinatesIds = array();
		foreach($subordinates as $sub){
			$subordinatesIds[] = $sub->id;
		}
		
		
		$timeSheet = new EmployeeTimeSheet();
		$timeSheet->Load("id = ?",array($req->id));
		if($timeSheet->id != $req->id){
			return new IceResponse(IceResponse::ERROR,"Timesheet not found");		
		}

		if($req->status == 'Submitted' && $employee->id == $timeSheet->employee){
			
		}else if(!in_array($timeSheet->employee, $subordinatesIds) && $this->user->user_level != 'Admin'){
			return new IceResponse(IceResponse::ERROR,"This Timesheet does not belong to any of your subordinates");	
		}
		
		$timeSheet->status = $req->status;
		
		$ok = $timeSheet->Save();
		if(!$ok){
			error_log($timeSheet->ErrorMsg());
		}
		return new IceResponse(IceResponse::SUCCESS,"");
	}
	
	public function createPreviousTimesheet($req){
		$employee = $this->baseService->getElement('Employee',$this->getCurrentEmployeeId());
		
		
		
		$timeSheet = new EmployeeTimeSheet();
		$timeSheet->Load("id = ?",array($req->id));
		if($timeSheet->id != $req->id){
			return new IceResponse(IceResponse::ERROR,"Timesheet not found");		
		}

		if($timeSheet->employee != $employee->id){
			return new IceResponse(IceResponse::ERROR,"You don't have permissions to add this Timesheet");	
		}
		
		$end = date("Y-m-d", strtotime("last Saturday", strtotime($timeSheet->date_start)));
		$start = date("Y-m-d", strtotime("last Sunday", strtotime($end)));
		
		$tempTimeSheet = new EmployeeTimeSheet();
		$tempTimeSheet->Load("employee = ? and date_start = ?",array($employee->id, $start));
		if($employee->id == $tempTimeSheet->employee){
			return new IceResponse(IceResponse::ERROR,"Timesheet already exists");		
		}
		
		$newTimeSheet = new EmployeeTimeSheet();
		$newTimeSheet->employee = $employee->id;
		$newTimeSheet->date_start = $start;
		$newTimeSheet->date_end = $end;
		$newTimeSheet->status = "Pending";
		$ok = $newTimeSheet->Save();
		if(!$ok){
			error_log("Error creating time sheet : ".$newTimeSheet->ErrorMsg());	
			return new IceResponse(IceResponse::ERROR,"Error creating Timesheet");
		}	
		
		
		return new IceResponse(IceResponse::SUCCESS,"");
	}
	
	public function getSubEmployeeTimeSheets($req){
		
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
		
		error_log("subordinatesIds: ".$subordinatesIds);
		
		$mappingStr = $req->sm;
		$map = json_decode($mappingStr);
		$timeSheet = new EmployeeTimeSheet();
		$list = $timeSheet->Find("employee in (".$subordinatesIds.")",array());	
		if(!$list){
			error_log($timeSheet->ErrorMsg());	
		}
		if(!empty($mappingStr)){
			$list = $this->baseService->populateMapping($list,$map);	
		}
		
		return new IceResponse(IceResponse::SUCCESS,$list);
	}
}