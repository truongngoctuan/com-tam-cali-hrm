<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.js?v=1.1"></script>
<script type="text/javascript" src="https://webstalk-js.s3.amazonaws.com/date.js"></script>
<script type="text/javascript" src="https://webstalk-js.s3.amazonaws.com/json2.js"></script>

</head>
<body>
<script>
function uploadfile(){
	var form = document.getElementById('upload_data');
	form.submit();
}
</script>
	<div id="upload_form">
	<form id="upload_data" method="post" action="<?=CLIENT_BASE_URL?>fileupload.php" enctype="multipart/form-data">
	<input id="file_name" name="file_name" type="hidden" value="<?=$_REQUEST['id']?>"/>
	<input id="file_group" name="file_group" type="hidden" value="<?=$_REQUEST['file_group']?>"/>
	<input id="user" name="user" type="hidden" value="<?=$_REQUEST['user']?>"/>
	<label id="upload_status"><?=$_REQUEST['msg']?></label><input id="file" name="file"  accept="image/*" type="file" onChange="uploadfile();"></input>
	</form>
	</div>
	<div id="upload_result" style="display:none;text-align: center;">
		<p id="upload_result_header"></p>
		<p id="upload_result_body"></p>
	</div>
<script type="text/javascript">document.body.style.overflow = 'hidden';</script>
</body>
</html>