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

include 'includes.inc.php';
if(empty($user)){
	header("Location:".CLIENT_BASE_URL."login.php");
}
if($_REQUEST['g']  == 'admin' && $user->user_level != "Admin"){
	header("Location:".CLIENT_BASE_URL."?g=modules&n=employees");	
}

$logoFileName = CLIENT_BASE_PATH."data/logo.png";
$logoFileUrl = CLIENT_BASE_URL."data/logo.png";
if(!file_exists($logoFileName)){
	$logoFileUrl = BASE_URL."images/logo.png";	
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>IceHRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?=BASE_URL?>bootstrap/css/bootstrap.css" rel="stylesheet">
	<!--
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.js"></script>
	-->
	<script type="text/javascript" src="<?=BASE_URL?>jquery.js"></script>
	<script type="text/javascript" src="<?=BASE_URL?>UtilitiesFunction.js"></script>
	<script src="<?=BASE_URL?>js/jquery.jeditable.mini.js"></script>
	
    <script src="<?=BASE_URL?>bootstrap/js/bootstrap.js"></script>
	<script src="<?=BASE_URL?>js/jquery.placeholder.js"></script>
	<script src="<?=BASE_URL?>js/jquery.dataTables.js"></script>
	<script src="<?=BASE_URL?>js/bootstrap-datepicker.js"></script>
	<script src="<?=BASE_URL?>js/jquery.timepicker.js"></script>
    <link href="<?=BASE_URL?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?=BASE_URL?>css/DT_bootstrap.css?v=0.4" rel="stylesheet">
    <link href="<?=BASE_URL?>css/jquery.timepicker.css" rel="stylesheet">
    <link href="<?=BASE_URL?>css/datepicker.css" rel="stylesheet">
    <link href="<?=BASE_URL?>css/style.css?v=<?=$cssVersion?>" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
	<!--
    <script type="text/javascript" src="https://webstalk-js.s3.amazonaws.com/date.js"></script>
	<script type="text/javascript" src="https://webstalk-js.s3.amazonaws.com/json2.js"></script>
	<script type="text/javascript" src="https://webstalk-js.s3.amazonaws.com/CrockfordInheritance.v0.1.js"></script>
-->
<script type="text/javascript" src="<?=BASE_URL?>webstalk/date.js"></script>
	<script type="text/javascript" src="<?=BASE_URL?>webstalk/json2.js"></script>
	<script type="text/javascript" src="<?=BASE_URL?>webstalk/CrockfordInheritance.v0.1.js"></script>

	<script type="text/javascript" src="<?=BASE_URL?>api/Base.js?v=<?=$jsVersion?>"></script>
	<script type="text/javascript" src="<?=BASE_URL?>api/AdapterBase.js?v=<?=$jsVersion?>"></script>
	<script type="text/javascript" src="<?=BASE_URL?>api/FormValidation.js?v=<?=$jsVersion?>"></script>
	<?php include 'modulejslibs.inc.php';?>


    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="bootstrap/ico/favicon.ico">
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script>
			var baseUrl = '<?=CLIENT_BASE_URL?>service.php';
	</script>
	<?php include APP_BASE_PATH.'js/bootstrapDataTable.php';?>
	
	<!--
	<link rel="stylesheet" href="https://webstalk-js.s3.amazonaws.com/tp/lightface/css/LightFace.css?v=0.1" />
	<script src="https://ajax.googleapis.com/ajax/libs/mootools/1.3.0/mootools.js"></script>
	
	<script src="https://webstalk-js.s3.amazonaws.com/tp/lightface/LightFace.js"></script>
	<script src="https://webstalk-js.s3.amazonaws.com/tp/lightface/LightFace.js"></script>
	<script src="https://webstalk-js.s3.amazonaws.com/tp/lightface/LightFace.IFrame.js"></script>
	<script src="https://webstalk-js.s3.amazonaws.com/tp/lightface/LightFace.Image.js"></script>
	<script src="https://webstalk-js.s3.amazonaws.com/tp/lightface/LightFace.Request.js"></script>
	-->
	<link rel="stylesheet" href="<?=BASE_URL?>webstalk/lightface/LightFace.css" />
	<script type="text/javascript" src="<?=BASE_URL?>mootools.js"></script>
	<script type="text/javascript" src="<?=BASE_URL?>webstalk/lightface/LightFace.js"></script>
	<script type="text/javascript" src="<?=BASE_URL?>webstalk/lightface/LightFace.IFrame.js"></script>
	<script type="text/javascript" src="<?=BASE_URL?>webstalk/lightface/LightFace.Image.js"></script>
	<script type="text/javascript" src="<?=BASE_URL?>webstalk/lightface/LightFace.Request.js"></script>
	
  </head>

  <body>
  
  
  	<script type="text/javascript">
		var uploadId="";
		var uploadAttr="";
		var popupUpload = null;
		
		function showUploadDialog(id,msg,group,user,postUploadId,postUploadAttr){
			var ts = Math.round((new Date()).getTime() / 1000);
			uploadId = postUploadId;
			uploadAttr = postUploadAttr;
			var html='<div><iframe src="<?=CLIENT_BASE_URL?>fileupload_page.php?id=_id_&msg=_msg_&file_group=_file_group_&user=_user_" frameborder="0" scrolling="no" width="300px" height="55px"></iframe></div>';
			var html = html.replace(/_id_/g,id);
			var html = html.replace(/_msg_/g,msg);
			var html = html.replace(/_file_group_/g,group);
			var html = html.replace(/_user_/g,user);
	
			popupUpload = new LightFace({
				width: 450,
				title: "Upload File",
			keys: {
				esc: function() { this.close(); box.unfade(); }
			},
				content: html,
			buttons: [
				{ title: 'Close', event: 
					function() {
						this.close();
					}, color: 'black' } 
			]
			});
			popupUpload.open();
			$('.lightface').css({
		    	 'top': 200
		    });
			
		}
	
		function closeUploadDialog(success,error,file){
			if(success == 1){
				popupUpload.close();
				if(uploadAttr == "val"){
					$('#'+uploadId).val(file);
				}else if(uploadAttr == "html"){
					$('#'+uploadId).html(file);
				}else{
					$('#'+uploadId).attr(uploadAttr,file);
				}
				
			}else{
				popupUpload.close();
			}
			
		}
	
		function randomString(length){
			var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');
		    
		    if (! length) {
		        length = Math.floor(Math.random() * chars.length);
		    }
		    
		    var str = '';
		    for (var i = 0; i < length; i++) {
		        str += chars[Math.floor(Math.random() * chars.length)];
		    }
		    return str;	
		}

		 
	</script>
  
  
    <div class="container-fluid topheader" style="height:70px;">
    	<div class="row-fluid" style="height:10px;">
      	</div>

      <div class="row-fluid" style="height:65px;">
        <div class="span7">
        <img src="<?=$logoFileUrl?>" style="margin-right:10px;" class="pull-left"/>
		<?php if($user->user_level == 'Admin'){?>
		<!--
          <button style="margin-right:10px;" class="btn btn-small btn btn-success pull-left" onclick="$('#myModal').modal();" type="button"><span class="icon-user"></span> Switch Employee </button>
        -->
		<?php }?>   
        
        <?php if($user->user_level == 'Admin'){?>
            <!-- Modal -->
            <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;margin-top:75px;top:0;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Switch Employee</h3>
              </div>
              <div class="modal-body">
                <p>Select the emoloyee to Edit</p>
                <p>
                <select id="switch_emp" style="width:100%;">
                <option value="-1">No Employee</option>
                <?php 
                $employees = $baseService->get('Employee');
                foreach($employees as $empTemp){
                ?>
                <option value="<?=$empTemp->id?>"><?=$empTemp->first_name." ".$empTemp->last_name?></option>
                <?php }?>
                </select>
                </p>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary" onclick="modJs.setAdminEmployee($('#switch_emp').val());return false;">Switch</button>
              </div>
            </div>
            <!-- Modal -->
        <?php }?>   
        </div>
        <div class="span5">
          <div class="btn-group pull-right">
            <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">User Menu <span class="icon-user"></span></button>
            <ul class="dropdown-menu">
              <?php if(!empty($employeeCurrent) || !empty($employeeSwitched)){?>
              <li><a href="<?=CLIENT_BASE_URL?>?g=modules&n=employees">My Info</a></li>
              <?php }?>
              <li><a href="<?=CLIENT_BASE_URL?>logout.php">Signout</a></li>
            </ul>
          </div> 
          <div class="btn-group pull-right" style="margin-right:10px;">
          	<?php if($user->user_level == 'Admin'){?>
          	<button style="margin-right:10px;" class="btn btn-small btn pull-left" onclick="$('#myModal').modal();" type="button"><span class="icon-refresh"></span> Switch Employee </button>
        	<?php }?>
        	<!--  
            <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">Switch Employee <span class="icon-wrench"></span></button>
            <ul class="dropdown-menu">
              <li><a href="#">People & Companies</a></li>
              <li><a href="#">Site Settings</a></li>
              <li><a href="#">Subscription</a></li>
            </ul>
            --> 
          </div> 
        </div>
      </div>
    </div>
    <div class="container-fluid bgbody" style="min-height:700px;padding-top:10px;">

	  
      <div class="row-fluid">
        <div class="span3">
        	<?php if(!empty($employeeCurrent) && !empty($employeeSwitched)){?>
        	<div class="row-fluid">
			  <div class="span12 borderBox" style="font-size: 12px;">
			  	<div class="span2">
			  		<div class="row-fluid">
					  	<div class="span12">
					  		<img src="<?=$employeeCurrent->image?>" class="img-rounded">
					  	</div>
					  	<div class="span12" style="margin-top:5px;">
					  		<img src="<?=$employeeSwitched->image?>" class="img-rounded">
					  	</div>
				  	</div>
			  	</div>
			  	<div class="span9" style="margin-left:25px;">
			  		<div>
			  		<span class="label label-ice">Logged In as</span><br/>
			  		<b><?=$employeeCurrent->first_name." ".$employeeCurrent->last_name?></b>
			  		</div>
			  		<div style="margin-top:10px;">
			  		<span class="label label-ice">Updating</span><br/>
			  		<b><?=$employeeSwitched->first_name." ".$employeeSwitched->last_name?></b>
			  		</div>
			  	</div>
			  	
			  </div>
	  		</div>
	  		<?php } else if(!empty($employeeCurrent)){?>
	  		<div class="row-fluid">
			  <div class="span12 borderBox" style="font-size: 12px;">
			  	<div class="span2">
			  		<img src="<?=$employeeCurrent->image?>" class="img-rounded">
			  	</div>
			  	<div class="span9" style="margin-left:25px;">
			  		<span class="label label-ice">Logged In as</span><br/>
			  		<b><?=$employeeCurrent->first_name." ".$employeeCurrent->last_name?></b>
			  	</div>
			  </div>
	  		</div>
	  		<?php } else if(!empty($employeeSwitched)){?>
	  		<div class="row-fluid">
			  <div class="span12 borderBox" style="font-size: 12px;">
			  	<div class="span2">
			  		<div class="row-fluid">
					  	<div class="span12">
					  		<img src="<?=BASE_URL?>images/user_male.png" class="img-rounded">
					  	</div>
					  	<div class="span12" style="margin-top:5px;">
					  		<img src="<?=$employeeSwitched->image?>" class="img-rounded">
					  	</div>
				  	</div>
			  	</div>
			  	<div class="span9" style="margin-left:25px;">
			  		<div>
			  		<span class="label label-ice">Logged In as</span><br/>
			  		<b><?=$user->username?></b>
			  		</div>
			  		<div style="margin-top:10px;">
			  		<span class="label label-info">Updating</span><br/>
			  		<b><?=$employeeSwitched->first_name." ".$employeeSwitched->last_name?></b>
			  		</div>
			  	</div>
			  </div>
	  		</div>
	  		<?php } else {?>
	  		<div class="row-fluid">
			  <div class="span12 borderBox" style="font-size: 12px;">
			  	<div class="span2">
			  		<img src="<?=BASE_URL?>images/user_male.png" class="img-rounded">
			  	</div>
			  	<div class="span9" style="margin-left:25px;">
			  		<span class="label label-ice">Logged In as</span><br/>
			  		<b><?=$user->username?></b>
			  	</div>
			  </div>
	  		</div>
	  		<?php }?>
          <div class="well sidebar-nav leftMenu">
          	<?php if($user->user_level == 'Admin'){?>
            <ul class="nav nav-list">
            <?php foreach($adminModules as $menu){?>
            	<li class="nav-header" style="margin-bottom: 10px;"><?=$menu['name']?></li>
            	<?php foreach ($menu['menu'] as $item){?>
            		<li><a href="<?=CLIENT_BASE_URL?>?g=admin&n=<?=$item['name']?>"><?=$item['label']?></a></li>
            	<?php }?>
            <?php }?>
            </ul>
            <?php }?>
            <?php if(!empty($employeeCurrent) || !empty($employeeSwitched)){?>
            <ul class="nav nav-list">
            <?php foreach($userModules as $menu){?>
            	<li class="nav-header" style="margin-bottom: 10px;"><?=$menu['name']?></li>
            	<?php foreach ($menu['menu'] as $item){?>
            		<li><a href="<?=CLIENT_BASE_URL?>?g=modules&n=<?=$item['name']?>"><?=$item['label']?></a></li>
            	<?php }?>
            <?php }?>
            </ul>
            <?php }?>
          </div><!--/.well -->
        </div><!--/span-->