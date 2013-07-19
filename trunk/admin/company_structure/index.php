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

$moduleName = 'company_structure';
define('MODULE_PATH',__DIR__);
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';

?>
<script type="text/javascript" src="<?=BASE_URL.'js/raphael-min.js?v='.$jsVersion?>"></script>
<script type="text/javascript" src="<?=BASE_URL.'js/graffle.js?v='.$jsVersion?>"></script>
<div class="span9">
			  
	<ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
		<li class="active"><a id="tabCompanyStructure" href="#tabPageCompanyStructure">Company Structure</a></li>
		<li><a id="tabCompanyGraph" href="#tabPageCompanyGraph">Company Graph</a></li>
	</ul>
	 
	<div class="tab-content">
		<div class="tab-pane active" id="tabPageCompanyStructure">
			<div id="CompanyStructure" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<!-- this form is for cover the CompanyStructure for add a new one-->
			<div id="CompanyStructureForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
		<div class="tab-pane" id="tabPageCompanyGraph">
			<div id="CompanyGraph" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="CompanyGraphForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
	</div>

</div>
<script>
var modJsList = new Array();
modJsList['tabCompanyStructure'] 	= new CompanyStructureAdapter('CompanyStructure');
modJsList['tabCompanyGraph'] = new CompanyGraphAdapter('CompanyStructure');

var modJs = modJsList['tabCompanyStructure'];
/*
[
			{ "sTitle": "ID","bVisible":false },
			{ "sTitle": "Tên Chi Nhánh" },
			{ "sTitle": "Address"},
			{ "sTitle": "Type"},
			{ "sTitle": "Country", "sClass": "center" },
			{ "sTitle": "Parent Structure"}
			
				
		*/	
	<?php $a = Array(Array("sTitle"=> "ID","bVisible"=>false), "sTitle" => "Tên Chi Nhánh", "sTitle" => "Address", "sTitle" => "Type", Array("sTitle"=> "Country", "sClass"=> "center"), "sTitle" => "Parent Structure");
			
	
?>
		
var foo = <?php echo json_encode($a); ?>;
	var foo2 = [
			{ "sTitle": "ID","bVisible":false },
			{ "sTitle": <?php echo json_encode("Tên Chi Nhánh"); ?> },
			{ "sTitle": "Address"},
			{ "sTitle": "Type"},
			{ "sTitle": "Country", "sClass": "center" },
			{ "sTitle": "Parent Structure"}
	];
	

//alert(foo);
</script>
<?php include APP_BASE_PATH.'footer.php';?>      