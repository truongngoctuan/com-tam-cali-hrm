<!-- Delete Modal -->
<div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel" aria-hidden="true" style="display:none;margin-top:75px;top:0;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><li class="icon-remove"/></button>
		<h3 id="deleteModelLabel" style="font-size: 17px;"></h3>
	</div>
	<div class="modal-body">
		<p id="deleteModelBody"></p>
	</div>
	<div class="modal-footer">
 		<button class="btn" onclick="modJs.cancelDelete();">Cancel</button>
		<button class="btn btn-primary" onclick="modJs.confirmDelete();">Delete</button>
	</div>
</div>
<!-- Delete Modal -->

<!-- Message Modal -->
<div class="modal" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModelLabel" aria-hidden="true" style="display:none;margin-top:75px;top:0;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><li class="icon-remove"/></button>
		<h3 id="messageModelLabel" style="font-size: 17px;"></h3>
	</div>
	<div class="modal-body">
		<p id="messageModelBody"></p>
	</div>
	<div class="modal-footer">
 		<button class="btn" onclick="modJs.closeMessage();">Ok</button>
	</div>
</div>
<!-- Message Modal -->