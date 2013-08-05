<?php

class BaseService{
	
	var $nonDeletables = array();
	var $errros = array();
	public $userTables = array();
	var $currentUser = null;
	var $db = null;
	
	public function get($table,$mappingStr = null, $filterStr = null, $orderBy = null, $limit = null){
		if(!empty($mappingStr)){
		$map = json_decode($mappingStr);
		}
		$obj = new $table();
		
		$query = "";
		$queryData = array();
		if(!empty($filterStr)){
			$filter = json_decode($filterStr);
			
			foreach($filter as $k=>$v){
				$query.=" and ".$k."=?";
				$queryData[] = $v;
			}		
		}
		
		if(empty($orderBy)){
			$orderBy = "";
		}else{
			$orderBy = " ORDER BY ".$orderBy;
		}
		
		
		if(in_array($table, $this->userTables)){
			$cemp = $this->getCurrentEmployeeId();
			if(!empty($cemp)){
				$list = $obj->Find("employee = ?".$query.$orderBy, array_merge(array($cemp),$queryData));	
			}else{
				$list = array();
			}
					
		}else{
			$list = $obj->Find("1=1".$query.$orderBy,$queryData);	
		}	
		
		
		
		if(!empty($mappingStr) && count($map)>0){
			$list = $this->populateMapping($list, $map);
		}

		return $list;
	}
	
	
	public function getData($table,$mappingStr = null, $filterStr = null, $orderBy = null, $limit = null, $searchColumns = null, $searchTerm = null){
		if(!empty($mappingStr)){
		$map = json_decode($mappingStr);
		}
		//error_log(print_r($filterStr,true));
		$obj = new $table();
		
		$query = "";
		$queryData = array();
		if(!empty($filterStr)){
			$filter = json_decode($filterStr);
			
			foreach($filter as $k=>$v){
				$query.=" and ".$k."=?";
				$queryData[] = $v;
			}		
		}
		
		
		if(!empty($searchTerm) && !empty($searchColumns)){
			$searchColumnList = json_decode($searchColumns);
			$tempQuery = " and (";
			foreach($searchColumnList as $col){
				
				if($tempQuery != " and ("){
					$tempQuery.=" or ";	
				}
				$tempQuery.=$col." like ?";
				$queryData[] = "%".$searchTerm."%";
			}	
			$query.= $tempQuery.")";	
		}
		
		if(empty($orderBy)){
			$orderBy = "";
		}else{
			$orderBy = " ORDER BY ".$orderBy;
		}
		
		if(empty($limit)){
			$limit = "";	
		}
		
		
		/*
		if(in_array($table, $this->userTables)){
			$cemp = $this->getCurrentEmployeeId();
			if(!empty($cemp)){
				$list = $obj->Find("employee = ?".$query.$orderBy.$limit, array_merge(array($cemp),$queryData));	
			}else{
				$list = array();
			}
			
			//error_log("employee = ?".$query.$orderBy.$limit);
			//error_log(print_r($queryData,true));
					
		}else{
			$list = $obj->Find("1=1".$query.$orderBy.$limit,$queryData);
			//error_log("1=1".$query.$orderBy.$limit);
			//error_log(print_r($queryData,true));	
		}	
		*/
		
		$list = $obj->Find("1=1".$query.$orderBy.$limit,$queryData);
		
		if(!empty($mappingStr) && count($map)>0){
			$list = $this->populateMapping($list, $map);
		}
		
		//error_log(print_r($list,true));
		
		return $list;
	}
	
	public function populateMapping($list,$map){
		$listNew = array();
		foreach($list as $item){
			$item = $this->populateMappingItem($item, $map);
			$listNew[] = $item;	
		}
		return 	$listNew;
	}
	
	public function populateMappingItem($item,$map){
		foreach($map as $k=>$v){
			$fTable = $v[0];
			$tObj = new $fTable();
			$tObj->Load($v[1]."= ?",array($item->$k));
			
			if($tObj->$v[1] == $item->$k){
				$v[2] = str_replace("+"," ",$v[2]);
				$values = explode(" ", $v[2]);
				if(count($values) == 1){
					$item->$k = $tObj->$v[2];	
				}else{
					$objVal = "";
					foreach($values as $v){
						if($objVal != ""){
							$objVal .= " ";	
						}
						$objVal .= $tObj->$v;
					}
					$item->$k = $objVal;
				}
			}	
		}
		return 	$item;
	}
	
	public function getElement($table,$id,$mappingStr = null){
		$obj = new $table();
		//echo($obj->PrimaryKeyName());
		if(in_array($table, $this->userTables)){
			$cemp = $this->getCurrentEmployeeId();
			if(!empty($cemp)){
				$obj->Load($obj->PrimaryKeyName().' = ?', array($id));	
			}else{
			}
			//echo('asd');		
		}else{
			$obj->Load($obj->PrimaryKeyName().' = ?',array($id));
			//echo('asd2');
		}
		
		if(!empty($mappingStr)){
			$map = json_decode($mappingStr);	
		}
		//echo('asd3');
		//print_r($obj);
		$PrimaryKeyName = $obj->PrimaryKeyName();
		if($obj->$PrimaryKeyName == $id){
			//echo('asd4');
			if(!empty($mappingStr)){
				foreach($map as $k=>$v){
					$fTable = $v[0];
					$tObj = new $fTable();
					$tObj->Load($v[1]."= ?",array($obj->$k));
					if($tObj->$v[1] == $obj->$k){
						$name = $k."_Name";
						$values = explode("+", $v[2]);
						if(count($values) == 1){
							$obj->$name = $tObj->$v[2];	
						}else{
							$objVal = "";
							foreach($values as $v){
								if($objVal != ""){
									$objVal .= " ";	
								}
								$objVal .= $tObj->$v;
							}
							$obj->$name = $objVal;
						}
					}	
				}
			}
			return 	$obj;
		}
		//echo('asd10');
		return null;
	}
	
	public function addElement($table,$obj){
		$ele = new $table();
		$PrimaryKeyName = $ele->PrimaryKeyName();
		
		if(!empty($obj[$PrimaryKeyName])){
			//echo('asd');
			$ele->Load($PrimaryKeyName.' = ?',array($obj[$PrimaryKeyName]));	
		}
		//print_r($ele);
		foreach($obj as $k=>$v){
			if($k == $PrimaryKeyName || $k == 't' || $k == 'a'){
				continue;	
			}
			if($v == "NULL"){
				$v = null;	
			}
			$ele->$k = $v;	
		}
		if(empty($obj[$PrimaryKeyName])){	
			if(in_array($table, $this->userTables)){
				$cemp = $this->getCurrentEmployeeId();
				if(!empty($cemp)){
					$ele->employee = $cemp;	
				}else{
					return "Employee id is not set";
				}		
			}
		}
		$ok = $ele->Save();
		if(!$ok){
			error_log($ele->ErrorMsg());
			return $this->findError($ele->ErrorMsg());		
		}
		return $ele;
		/*
		if(!empty($obj['id'])){
			$ele->Load('id = ?',array($obj['id']));	
		}
		
		foreach($obj as $k=>$v){
			if($k == 'id' || $k == 't' || $k == 'a'){
				continue;	
			}
			if($v == "NULL"){
				$v = null;	
			}
			$ele->$k = $v;	
		}
		if(empty($obj['id'])){	
			if(in_array($table, $this->userTables)){
				$cemp = $this->getCurrentEmployeeId();
				if(!empty($cemp)){
					$ele->employee = $cemp;	
				}else{
					return "Employee id is not set";
				}		
			}
		}
		$ok = $ele->Save();
		if(!$ok){
			error_log($ele->ErrorMsg());
			return $this->findError($ele->ErrorMsg());		
		}
		return $ele;
		*/
	}
	
	public function deleteElement($table,$id){
		$ele = new $table();
		//$ele->Load('id = ?',array($id));
		//echo ($ele->PrimaryKeyName());
		$ele->Load($ele->PrimaryKeyName().' = ?',array($id));	
		$nonDeletableTable = $this->nonDeletables[$table];
		if(!empty($nonDeletableTable)){
			foreach($nonDeletableTable as $field => $value){
				if($ele->$field == $value){
					return "This item can not be deleted";	
				}	
			}	
		}
		$ok = $ele->Delete();
		if(!$ok){
			error_log($ele->ErrorMsg());
			return $this->findError($ele->ErrorMsg());	
		}
		return null;
	}
	
	public function getFieldValues($table,$key,$value){
		
		$values = explode("+", $value);
		
		$ret = array();
		$ele = new $table();
		$list = $ele->Find('1 = 1',array());
		foreach($list as $obj){
			if(count($values) == 1){
				$ret[$obj->$key] = $obj->$value;	
			}else{
				$objVal = "";
				foreach($values as $v){
					if($objVal != ""){
						$objVal .= " ";	
					}
					$objVal .= $obj->$v;
				}
				$ret[$obj->$key] = $objVal;
			}
		}	
		return $ret;
	}
	
	public function setNonDeletables($table, $field, $value){
		if(!isset($this->nonDeletables[$table])){
			$this->nonDeletables[$table] = array();	
		}
		$this->nonDeletables[$table][$field] = $value;
	}
	
	public function setSqlErrors($errros){
		$this->errros = $errros;	
	}
	
	public function setUserTables($userTables){
		$this->userTables = $userTables;	
	}
	
	public function setCurrentUser($currentUser){
		$this->currentUser = $currentUser;	
	}
	
	public function findError($error){
		foreach($this->errros as $k=>$v){
			if(strstr($error, $k)){
				return $v;
			}
		}	
		return $error;
	}
	
	public function getCurrentEmployeeId(){
		include (APP_BASE_PATH."include.common.php");
		$adminEmpId = getSessionObject('admin_current_employee');
		if(empty($adminEmpId)){
			$user = getSessionObject('user');	
			return $user->employee;
		}
		return $adminEmpId;
	}
	
	public function setCurrentAdminEmployee($employeeId){
		include (APP_BASE_PATH."include.common.php");
		if($this->currentUser->user_level == 'Admin'){
			if($employeeId == "-1"){
				saveSessionObject('admin_current_employee',null);	
			}else{
				saveSessionObject('admin_current_employee',$employeeId);	
			}
					
		}	
	}
	
	public function setDB($db){
		$this->db = $db;
	}
	
	public function getDB(){
		return $this->db;
	}
}
?>