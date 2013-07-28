<?php
$adminModulesTemp = array();
$ams = scandir(CLIENT_PATH.'/admin/');
$currentLocation = 0;
foreach($ams as $am){
	if(is_dir(CLIENT_PATH.'/admin/'.$am) && $am != '.' && $am != '..'){
		$meta = json_decode(file_get_contents(CLIENT_PATH.'/admin/'.$am.'/meta.json'));
		$arr = array();
		$arr['name'] = $am;	
		$arr['label'] = $meta->label;	
		$arr['menu'] = $meta->menu;	
		$arr['order'] = $meta->order;
		
		if(!isset($adminModulesTemp[$arr['menu']])){
			$adminModulesTemp[$arr['menu']] = array();	
		}

		if($arr['order'] == '0'){
			$adminModulesTemp[$arr['menu']]["Z".$currentLocation] = $arr; 	
			$currentLocation++;
		}else{
			$adminModulesTemp[$arr['menu']]["A".$arr['order']] = $arr;
		}
		
		$moduleCapsName = ucfirst($am);
		$initFile = CLIENT_PATH.'/admin/'.$am."/api/".$moduleCapsName."Initialize.php";
		if(file_exists($initFile)){
			include $initFile;	
			$class = $moduleCapsName."Initialize";
			if(class_exists($class)){
				$initClass = new $class();
				$initClass->setBaseService($baseService);
				$initClass->init();	
			}
			
		}
	}	
}


$userModulesTemp = array();
$ams = scandir(CLIENT_PATH.'/modules/');
foreach($ams as $am){
	if(is_dir(CLIENT_PATH.'/modules/'.$am) && $am != '.' && $am != '..'){
		$meta = json_decode(file_get_contents(CLIENT_PATH.'/modules/'.$am.'/meta.json'));
		$arr = array();
		$arr['name'] = $am;	
		$arr['label'] = $meta->label;	
		$arr['menu'] = $meta->menu;	
		$arr['order'] = $meta->order;
		
		if(!isset($userModulesTemp[$arr['menu']])){
			$userModulesTemp[$arr['menu']] = array();	
		}

		if($arr['order'] == '0'){
			$userModulesTemp[$arr['menu']]["Z".$currentLocation] = $arr; 
			$currentLocation++;	
		}else{
			$userModulesTemp[$arr['menu']]["A".$arr['order']] = $arr;
		}
		
		$moduleCapsName = ucfirst($am);
		$initFile = CLIENT_PATH.'/modules/'.$am."/api/".$moduleCapsName."Initialize.php";
		if(file_exists($initFile)){
			include $initFile;	
			$class = $moduleCapsName."Initialize";
			if(class_exists($class)){
				$initClass = new $class();
				$initClass->setBaseService($baseService);
				$initClass->init();	
			}
			
		}
	}	
}



foreach ($adminModulesTemp as $k=>$v){
	ksort($adminModulesTemp[$k]);	
}

foreach ($userModulesTemp as $k=>$v){
	ksort($userModulesTemp[$k]);	
}

$adminMenus = json_decode(file_get_contents(CLIENT_PATH.'/admin/meta.json'));
$adminModules = array();
$added = array();
foreach($adminMenus as $menu){
	$arr = array("name"=>$menu,"menu"=>$adminModulesTemp[$menu]);
	$adminModules[] = $arr;	
	$added[] = $menu;
}

foreach($adminModulesTemp as $k=>$v){
	if(!in_array($k, $added)){
		$arr = array("name"=>$k,"menu"=>$adminModulesTemp[$k]);
		$adminModules[] = $arr;	
	}
}

$userMenus = json_decode(file_get_contents(CLIENT_PATH.'/modules/meta.json'));
$userModules = array();
$added = array();
foreach($userMenus as $menu){
	$arr = array("name"=>$menu,"menu"=>$userModulesTemp[$menu]);
	$userModules[] = $arr;	
	$added[] = $menu;
}

foreach($userModulesTemp as $k=>$v){
	if(!in_array($k, $added)){
		$arr = array("name"=>$k,"menu"=>$userModulesTemp[$k]);
		$userModules[] = $arr;	
	}
}

error_log("Admin Modules :".print_r($adminModules,true));
//error_log("User Modules :".print_r($userModules,true));

