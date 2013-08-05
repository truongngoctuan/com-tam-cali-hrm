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
include ("include.common.php");
//include ("classes/services/testServices.php");

$modulePath = getSessionObject("modulePath");
if(!defined('MODULE_PATH')){
	define('MODULE_PATH',$modulePath);
}

include("server.includes.inc.php");

$action = $_REQUEST['a'];
if($action == 'get'){
	$ret['object'] = $baseService->get($_REQUEST['t'],$_REQUEST['sm'],$_REQUEST['ft'],$_REQUEST['ob']);
	$ret['status'] = "SUCCESS";
	
}else if($action == 'getData'){
	$ret['object'] = $baseService->getElement($_REQUEST['t'],$_REQUEST['id'],$_REQUEST['sm']);
	if(!empty($ret['object'])){
		$ret['status'] = "SUCCESS";	
	}else{
		$ret['status'] = "ERROR";
	}
}else if($action == 'getElement'){
	$ret['object'] = $baseService->getElement($_REQUEST['t'],$_REQUEST['id'],$_REQUEST['sm']);
	if(!empty($ret['object'])){
		$ret['status'] = "SUCCESS";	
	}else{
		$ret['status'] = "ERROR";
	}
}else if($action == 'add'){
	$ret['object'] = $baseService->addElement($_REQUEST['t'],$_REQUEST);
	if(!empty($ret['object'])){
		$ret['status'] = "SUCCESS";	
	}else{
		$ret['status'] = "ERROR";
	}	
	
}else if($action == 'delete'){
	$ret['object'] = $baseService->deleteElement($_REQUEST['t'],$_REQUEST['id']);
	if($ret['object'] == null){
		$ret['status'] = "SUCCESS";	
	}else{
		$ret['status'] = "ERROR";
	}
	
}else if($action == 'getFieldValues'){
	$ret['data'] = $baseService->getFieldValues($_REQUEST['t'], $_REQUEST['key'], $_REQUEST['value']);
	if($ret['data'] != null){	
		$ret['status'] = "SUCCESS";	
	}else{
		$ret['status'] = "ERROR";
	}

}else if($action == 'setAdminEmp'){
	$baseService->setCurrentAdminEmployee($_REQUEST['empid']);	
	$ret['status'] = "SUCCESS";	
	
}else if($action == 'ca'){
	$mod = $_REQUEST['mod'];
	$modPath = explode("=", $mod);
	$moduleCapsName = ucfirst($modPath[1]);
	
	$subAction = $_REQUEST['sa'];
	$apiFile = APP_BASE_PATH.$modPath[0]."/".$modPath[1]."/api/".$moduleCapsName."ActionManager.php";
	$emailSenderFile = APP_BASE_PATH.$modPath[0]."/".$modPath[1]."/api/".$moduleCapsName."EmailSender.php";
	if(file_exists($apiFile)){
			
		include ($apiFile);
			
		if(file_exists($emailSenderFile)){
			include ($emailSenderFile);	
		}
		
		$cls = $moduleCapsName."ActionManager";
		$apiClass = new $cls();
		$apiClass->setUser($user);
		$apiClass->setBaseService($baseService);
		//$apiClass->setEmailTemplates($emailTemplates);
		$apiClass->setEmailSender($emailSender);
		
		
		$res = $apiClass->$subAction(json_decode($_REQUEST['req']));
		$ret = $res->getJsonArray();
	}else{
		$ret = array("status"=>"ERROR");
		error_log("File dosen't exist :".$apiFile);	
	}	
	
}

echo json_encode($ret);