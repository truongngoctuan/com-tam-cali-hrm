</div><!--/row-->

      

    </div><!--/.fluid-container-->
  
    <div class="row-fluid" style="height:10px;">
      <div class="span12" style="padding:5px;">
        <p style="text-align:center;font-size: 10px;">
        IceHRM  ver 3.2 &#169; IceHRM Inc. 2012 - 2013 All rights reserved.
    	</p>
      </div>
    </div>
  	<script type="text/javascript">
		
		for (var prop in modJsList) {
			if(modJsList.hasOwnProperty(prop)){
				modJsList[prop].setFieldTemplates(<?=json_encode($fieldTemplates)?>);
				modJsList[prop].setTemplates(<?=json_encode($templates)?>);
				modJsList[prop].setCustomTemplates(<?=json_encode($customTemplates)?>);
				modJsList[prop].setEmailTemplates(<?=json_encode($emailTemplates)?>);
				modJsList[prop].initFieldMasterData();
				modJsList[prop].setBaseUrl('<?=BASE_URL?>');
			}
			
	    }

	   

		$(document).ready(function() {
			$('#modTab a').click(function (e) {
				e.preventDefault();
				$(this).tab('show');
				modJs = modJsList[$(this).attr('id')];
				modJs.get([]);
			});

			modJs.get([]);
		});
		var clientUrl = '<?=CLIENT_BASE_URL?>';
	</script>
	<?php include 'popups.php';?>
  </body>
</html>
