<?php
include ("include.common.php");
include("server.includes.inc.php");
$columns = json_decode($_REQUEST['cl']);
$columns[]="id";
$table = $_REQUEST['t'];
$obj = new $table();


$sLimit = "";
if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ){
	$sLimit = " LIMIT ".intval( $_GET['iDisplayStart'] ).", ".intval( $_GET['iDisplayLength'] );
}

//error_log("Mapping:".$_REQUEST['sm']);

$data = $baseService->getData($_REQUEST['t'],$_REQUEST['sm'],$_REQUEST['ft'],$_REQUEST['ob'],$sLimit, $_REQUEST['cl'], $_REQUEST['sSearch']);

//Get Total row count
$totalRows = 0;
if(in_array($table, $baseService->userTables)){
	$cemp = $baseService->getCurrentEmployeeId();
	$sql = "Select count(id) as count from ".$obj->_table." where employee = ?";
	$rowCount = $obj->DB()->Execute($sql, array($cemp));
			
}else{
	$sql = "Select count(id) as count from ".$obj->_table;
	$rowCount = $obj->DB()->Execute($sql);
}

foreach ($rowCount as $cnt) {
	$totalRows = $cnt['count'];
}	

/*
 * Output
 */

$output = array(
	"sEcho" => intval($_GET['sEcho']),
	"iTotalRecords" => $totalRows,
	"iTotalDisplayRecords" => $totalRows,
	"aaData" => array()
);

foreach($data as $item){
	$row = array();
	$colCount = count($columns);
	for ($i=0 ; $i<$colCount;$i++){
		$row[] = $item->$columns[$i];
	}
	$output['aaData'][] = $row;
}
//error_log(print_r($output,true));
echo json_encode($output);
