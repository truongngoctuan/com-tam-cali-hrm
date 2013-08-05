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
<script>
var modJsList = new Array();

modJsList['tabNhanVien'] = new NhanVienAdapter('NhanVien');
modJsList['tabNVState'] = new NVStateAdapter('NVState');
modJsList['tabNhuCauTuyenDung'] = new NhuCauTuyenDungAdapter('NhuCauTuyenDung');

var modJs = modJsList['tabNhanVien'];
</script>
<?php include APP_BASE_PATH.'footer.php';?>      