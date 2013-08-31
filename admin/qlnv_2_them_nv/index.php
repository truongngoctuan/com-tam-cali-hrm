<?php 
/*
This file is part of iCE Hrm.

iCE Hrm is free software: you Can redistribute it and/or modify
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

$moduleName = 'NLC';
define('MODULE_PATH',__DIR__);
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';

?>
<script type="text/javascript" src="<?=BASE_URL.'js/raphael-min.js?v='.$jsVersion?>"></script>
<script type="text/javascript" src="<?=BASE_URL.'js/graffle.js?v='.$jsVersion?>"></script>
<div class="span9">
			  
	<ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
		<li class="active"><a id="tabNhanVien" href="#tabPageNhanVien">Thêm nhân viên</a></li>
		<li><a id="tabNVState" href="#tabPageNVState">Tình trạng nhân viên</a></li>
		<li><a id="tabNhuCauTuyenDung" href="#tabPageNhuCauTuyenDung">Thêm nhu cầu tuyển dụng</a></li>
	</ul>
	 
	<div class="tab-content">
		<div class="tab-pane active" id="tabPageNhanVien">
			<div id="NhanVien" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="NhanVienForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
		<div class="tab-pane" id="tabPageNVState">
			<div id="NVState" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="NVStateForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
		<div class="tab-pane" id="tabPageNhuCauTuyenDung">
			<div id="NhuCauTuyenDung" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="NhuCauTuyenDungForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
	</div>

</div>
<?php
/*
$TEST = $baseService->getDB()->Execute("SELECT * FROM BO_PHAN WHERE TRUE");
debugging_p($TEST);
$TEST2 = $baseService->getDB()->GetAll("SELECT * FROM BO_PHAN WHERE TRUE");
debugging_p($TEST2);

$arr234 = $baseService->getDB()->GetAssoc("select * from BO_PHAN"); # returns associative array $key=>col
debugging_p($arr234);
*/

//build a staic header
$boPhanArray = $baseService->getDB()->GetAll("SELECT * FROM BO_PHAN WHERE TRUE");
$loaiNgayArray = $baseService->getDB()->GetAll("SELECT * FROM LOAI_NGAY WHERE TRUE");
debugging_p($boPhanArray, "bophanArray");
debugging_p($loaiNgayArray, "loaiNgayArray");

$htmlHeader="";
$firstRowHeader = "";
$secondRowHeader = "";
// add chi Nhanh - ca columns
$firstRowHeader = '<th class="sorting_disabled" colspan="1" rowspan="2">Chi nhánh - Ca</th>';
//$secondRowHeader = '<th class="sorting_disabled" colspan="0"></th>';
foreach($loaiNgayArray as $loaiNgay) {
	//debugging("asd");
	$firstRowHeader = $firstRowHeader.'<th align="center" class="sorting_disabled" colspan="'.count($boPhanArray).'" rowspan="1"><div align="center">'.$loaiNgay['TEN'].'</div></th>';
}
$firstRowHeader = '<tr role="row">'.$firstRowHeader.'</tr>';


foreach($loaiNgayArray as $loaiNgay) {
	foreach ($boPhanArray as $boPhan) {
		$secondRowHeader = $secondRowHeader.'<th class="sorting_disabled" colspan="1" rowspan="1">'.$boPhan['TEN'].'</th>';
	}
}
$secondRowHeader = '<tr role="row">'.$secondRowHeader.'</tr>';

//debugging_p($firstRowHeader,"firstRowHeader");
//debugging_p($secondRowHeader, "secondRowHeader");

$htmlHeader = $firstRowHeader.$secondRowHeader;
?>
<script>
var htmlHeader = <?php echo json_encode($htmlHeader); ?>;
var nHeaderColumns = <?php echo (count($loaiNgayArray) * count($boPhanArray) + 1); ?>;
console.log(nHeaderColumns);
var modJsList = new Array();

modJsList['tabNhanVien'] = new NhanVienAdapter('NhanVien');
modJsList['tabNVState'] = new NVStateAdapter('NVState');
modJsList['tabNhuCauTuyenDung'] = new NhuCauTuyenDungAdapter('NhuCauTuyenDung');

var modJs = modJsList['tabNhanVien'];
</script>
<?php include APP_BASE_PATH.'footer.php';?>      