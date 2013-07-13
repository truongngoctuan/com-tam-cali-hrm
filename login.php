<?php
include ("include.common.php"); 
include("server.includes.inc.php");
if(empty($user)){
	if(!empty($_REQUEST['username']) && !empty($_REQUEST['password'])){
		$suser = new User();
		$suser->Load("(username = ? or email = ?) and password = ?",array($_REQUEST['username'],$_REQUEST['username'],md5($_REQUEST['password'])));
		if($suser->password == md5($_REQUEST['password'])){
			$user = $suser;
			saveSessionObject('user', $user);
			if($user->user_level == "Admin"){
				header("Location:".CLIENT_BASE_URL."?g=admin&n=company_structure");	
			}else{
				header("Location:".CLIENT_BASE_URL."?g=modules&n=employees");	
			}
		}else{
			header("Location:".CLIENT_BASE_URL."login.php");
		}			
	}
}else{
	if($user->user_level == "Admin"){
		header("Location:".CLIENT_BASE_URL."?g=admin&n=company_structure");	
	}else{
		header("Location:".CLIENT_BASE_URL."?g=modules&n=employees");	
	}
	
}

$tuser = getSessionObject('user');
//check user

$logoFileName = CLIENT_BASE_PATH."data/logo.png";
$logoFileUrl = CLIENT_BASE_URL."data/logo.png";
if(!file_exists($logoFileName)){
	$logoFileUrl = BASE_URL."images/logo.png";	
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>IceHRM Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?=BASE_URL?>bootstrap/css/bootstrap.css" rel="stylesheet">
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.js"></script>
    <script src="<?=BASE_URL?>bootstrap/js/bootstrap.js"></script>
	<script src="<?=BASE_URL?>js/jquery.placeholder.js"></script>
	<script src="<?=BASE_URL?>js/jquery.dataTables.js"></script>
	<script src="<?=BASE_URL?>js/bootstrap-datepicker.js"></script>
    <link href="<?=BASE_URL?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?=BASE_URL?>css/DT_bootstrap.css?v=0.4" rel="stylesheet">
    <link href="<?=BASE_URL?>css/datepicker.css" rel="stylesheet">
    <link href="<?=BASE_URL?>css/style.css?v=<?=$cssVersion?>" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #829AA8;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

	  .login-form {
		margin-left: 65px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }

    </style>
	
	
  </head>

  <body>
	<div class="container">
		<div class="content" style="margin-top:100px;">
			<div class="row">
				<div class="login-form">
					<h2><img src="<?=$logoFileUrl?>"/></h2>
					<form action="">
						<fieldset>
							<div class="clearfix">
								<div class="input-prepend">
								  	<span class="add-on"><i class="icon-user"></i></span>
								  	<input class="span2" id="prependedInput" type="text" id="username" name="username" placeholder="Username">
								</div>
							</div>
							<div class="clearfix">
								<div class="input-prepend">
								  	<span class="add-on"><i class="icon-lock"></i></span>
								  	<input class="span2" id="prependedInput" type="password" id="password" name="password" placeholder="Password">
								</div>
							</div>
							<button class="btn" style="margin-top: 5px;" type="submit">Sign in&nbsp;&nbsp;<span class="icon-arrow-right"></span></button>
						</fieldset> 
					</form>
				</div>
			</div>
		</div>
	</div> <!-- /container -->
</body>
</html>