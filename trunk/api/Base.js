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

function IceHRMBase() {
	this.deleteParams = {};
	this.createRemoteTable = false;
}

this.fieldTemplates = null;
this.templates = null;
this.customTemplates = null;
this.emailTemplates = null;
this.fieldMasterData = null;
this.sourceMapping = null;
this.currentId = null;


this.baseUrl = null;


IceHRMBase.method('init' , function(appName, currentView, dataUrl, permissions) {
	
});

IceHRMBase.method('setBaseUrl' , function(url) {
	this.baseUrl = url;
});

IceHRMBase.method('initFieldMasterData' , function() {
	if(this.showAddNew == undefined || this.showAddNew == null){
		this.showAddNew = true;
	}
	this.fieldMasterData = {};
	this.sourceMapping = {};
	var fields = this.getFormFields();
	for(var i=0;i<fields.length;i++){
		var field = fields[i];
		if(field[1]['remote-source'] != undefined && field[1]['remote-source'] != null){
			var key = field[1]['remote-source'][0]+"_"+field[1]['remote-source'][1]+"_"+field[1]['remote-source'][2];
			
			this.sourceMapping[field[0]] = field[1]['remote-source'];
			
			var callBackData = {};
			callBackData['callBack'] = 'initFieldMasterDataResponse';
			callBackData['callBackData'] = [key];
			this.getFieldValues(field[1]['remote-source'],callBackData);
		}
	}
});

IceHRMBase.method('setRemoteTable' , function(val) {
	this.createRemoteTable = val;
});

IceHRMBase.method('getRemoteTable' , function() {
	return this.createRemoteTable;
});


IceHRMBase.method('initFieldMasterDataResponse' , function(key,data) {
	this.fieldMasterData[key] = data;
});

IceHRMBase.method('getSourceMapping' , function() {
	return this.sourceMapping ;
});

IceHRMBase.method('setTesting' , function(testing) {
	this.testing = testing;
});

IceHRMBase.method('consoleLog' , function(message) {
	if(this.testing) {
		console.log(message);
	}
});

IceHRMBase.method('setClientMessages', function(msgList) {
	this.msgList = msgList;
});

IceHRMBase.method('setTemplates', function(templates) {
	this.templates = templates;
});


IceHRMBase.method('getWSProperty', function(array, key) {
	if(array.hasOwnProperty(key)) {
		return array[key];
	}
	return null;
});


IceHRMBase.method('getClientMessage', function(key) {
	return this.getWSProperty(this.msgList,key);
});



IceHRMBase.method('getTemplate', function(key) {
	return this.getWSProperty(this.templates, key);
});

IceHRMBase.method('setGoogleAnalytics', function (gaq) {
	this.gaq = gaq;
});


IceHRMBase.method('showView', function(view) {
	if(this.currentView != null) {
		this.previousView = this.currentView;
		$("#" + this.currentView).hide();
	}
	$('#' + view).show();
	this.currentView = view;
	this.moveToTop();
});

IceHRMBase.method('showPreviousView', function() {
	this.showView(this.previousView);	
});


IceHRMBase.method('moveToTop', function () {
	
});


IceHRMBase.method('callFunction', function (callback, cbParams) {
	if($.isFunction(callback)) {
		try{
			callback.apply(document, cbParams);
		} catch(e) {
		}
	} else {
		f = this[callback];
		if($.isFunction(f)) {
			try{
				f.apply(this, cbParams);
			} catch(e) {
			}
		} 
	}
	return ;
});


IceHRMBase.method('createTable', function(elementId) {
	//alert('IceHRMBase.createTable');
	if(this.getRemoteTable()){
		this.createTableServer(elementId);
		return;
	}
	
	
	var headers = this.getHeaders();
	var data = this.getTableData();
	
	headers.push({ "sTitle": "", "sClass": "center" });
	
	for(var i=0;i<data.length;i++){
		data[i].push(this.getActionButtonsHtml(data[i][0],data[i]));
	}
	debugging('headers', headers);
	debugging('data', data);
	var html = "";
	if(this.getShowAddNew()){
		html = '<button style="float:right;" onclick="modJs.renderForm();return false;" class="btn btn-small">Add New <span class="icon-plus-sign"></span></button><table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="grid"></table>';
	}else{
		html = '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="grid"></table>';
	}

	$('#'+elementId).html(html);
	
	var dataTableParams = {
			"sDom": "<'row'<'dataClass1'l><'dataClass2'f>r>t<'row'<'dataClass3'i><'dataClass4'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aaData": data,
			"aoColumns": headers,
			"bSort": false
		};
	
	var customTableParams = this.getCustomTableParams();
	
	$.extend(dataTableParams, customTableParams);
	
	$('#'+elementId+' #grid').dataTable( dataTableParams );
	
	$('.tableActionButton').tooltip();
});

IceHRMBase.method('createTableServer', function(elementId) {
	alert('IceHRMBase.createTableServer');
	var that = this;
	var headers = this.getHeaders();
	var data = this.getTableData();
	
	headers.push({ "sTitle": "", "sClass": "center" });
	
	for(var i=0;i<data.length;i++){
		data[i].push(this.getActionButtonsHtml(data[i][0],data[i]));
	}
	var html = "";
	if(this.getShowAddNew()){
		html = '<button style="float:right;" onclick="modJs.renderForm();return false;" class="btn btn-small">Add New <span class="icon-plus-sign"></span></button><table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="grid"></table>';
	}else{
		html = '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="grid"></table>';
	}

	$('#'+elementId).html(html);
	
	var dataTableParams = {
			"sDom": "<'row'<'dataClass1'l><'dataClass2'f>r>t<'row'<'dataClass3'i><'dataClass4'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"bProcessing": true,
		    "bServerSide": true,
		    "sAjaxSource": that.getDataUrl(that.getDataMapping()),
			"aoColumns": headers,
			"bSort": false,
			"parent":that,
			"aoColumnDefs": [ 
     			{
     				"fnRender": that.getActionButtons,
     				"aTargets": [that.getDataMapping().length]
     			}
			]
		};
	
	var customTableParams = this.getCustomTableParams();
	
	$.extend(dataTableParams, customTableParams);
	
	$('#'+elementId+' #grid').dataTable( dataTableParams );
	
	$('.tableActionButton').tooltip();
});

IceHRMBase.method('getHeaders', function() {
	
});

IceHRMBase.method('getTableData', function() {
	
});

IceHRMBase.method('getFormFields', function() {
	
});

IceHRMBase.method('edit', function(id) {
	this.currentId = id;
	this.getElement(id,[]);
});

IceHRMBase.method('renderModel', function(id,header,body) {
	$('#'+id+'ModelLabel').html(header);
	$('#'+id+'ModelBody').html(body);
});

IceHRMBase.method('deleteRow', function(id) {
	this.deleteParams['id'] = id;
	this.renderModel('delete',"Confirm Deletion","Are you sure you want to delete this item ?");
	$('#deleteModal').modal('show');
	
});

IceHRMBase.method('showMessage', function(title,message) {
	this.renderModel('message',title,message);
	$('#messageModal').modal('show');
});

IceHRMBase.method('confirmDelete', function() {
	if(this.deleteParams['id'] != undefined || this.deleteParams['id'] != null){
		this.deleteObj(this.deleteParams['id'],[]);
	}
	$('#deleteModal').modal('hide');
});

IceHRMBase.method('cancelDelete', function() {
	$('#deleteModal').modal('hide');
	this.deleteParams['id'] = null;
});

IceHRMBase.method('closeMessage', function() {
	$('#messageModal').modal('hide');
});

IceHRMBase.method('save', function() {
	var validator = new FormValidation(this.getTableName()+"_submit",true,{'ShowPopup':false,"LabelErrorClass":"error"});
	if(validator.checkValues()){
		var params = validator.getFormParameters();
		
		var msg = this.doCustomValidation(params);
		//alert(params);
		if(msg == null){
			var id = $('#'+this.getTableName()+"_submit #id").val();
			if(id != null && id != undefined && id != ""){
				$(params).attr('id',id);
			}
			this.add(params,[]);
		}else{
			$("#"+this.getTableName()+'Form .label').html(msg);
			$("#"+this.getTableName()+'Form .label').show();
		}
		
	}
});

IceHRMBase.method('doCustomValidation', function(params) {
	return null;
});


IceHRMBase.method('renderForm', function(object) {
	var formHtml = this.templates['formTemplate'];
	var html = "";
	var fields = this.getFormFields();
	for(var i=0;i<fields.length;i++){
		html += this.renderFormField(fields[i]);
	}
	formHtml = formHtml.replace(/_id_/g,this.getTableName()+"_submit");
	formHtml = formHtml.replace(/_fields_/g,html);
	$("#"+this.getTableName()+'Form').html(formHtml);
	$("#"+this.getTableName()+'Form').show();
	$("#"+this.getTableName()).hide();
	
	$("#"+this.getTableName()+'Form .datefield').datepicker({'viewMode':2});
	$("#"+this.getTableName()+'Form .timefield').timepicker({ 'step': 15 });
	
	if(object != undefined && object != null){
		this.fillForm(object);
	}
});

IceHRMBase.method('fillForm', function(object) {
	var fields = this.getFormFields();
	for(var i=0;i<fields.length;i++) {
		if(fields[i][1].type == 'date'){
			if(object[fields[i][0]] != '0000-00-00'){
				$("#"+this.getTableName()+'Form #'+fields[i][0]+"_date").datepicker('setValue', object[fields[i][0]]);
			}
		}else{
			$("#"+this.getTableName()+'Form #'+fields[i][0]).val(object[fields[i][0]]);
		}
	    
	}
});

IceHRMBase.method('cancel', function() {
	$("#"+this.getTableName()+'Form').hide();
	$("#"+this.getTableName()).show();
});

IceHRMBase.method('renderFormField', function(field) {
	var t = this.fieldTemplates[field[1].type];
	if(field[1].type == 'text' || field[1].type == 'textarea' || field[1].type == 'hidden'){
		t = t.replace(/_id_/g,field[0]);
		t = t.replace(/_label_/g,field[1].label);
	}else if(field[1].type == 'select'){
		t = t.replace(/_id_/g,field[0]);
		t = t.replace(/_label_/g,field[1].label);
		if(field[1]['source'] != undefined && field[1]['source'] != null ){
			t = t.replace('_options_',this.renderFormSelectOptions(field[1].source));
		}else if(field[1]['remote-source'] != undefined && field[1]['remote-source'] != null ){
			var key = field[1]['remote-source'][0]+"_"+field[1]['remote-source'][1]+"_"+field[1]['remote-source'][2];
			t = t.replace('_options_',this.renderFormSelectOptionsRemote(this.fieldMasterData[key],field));
		}
		
	}else if(field[1].type == 'date'){
		t = t.replace(/_id_/g,field[0]);
		t = t.replace(/_label_/g,field[1].label);
		
	}else if(field[1].type == 'time'){
		t = t.replace(/_id_/g,field[0]);
		t = t.replace(/_label_/g,field[1].label);
	}
	
	if(field[1].validation != undefined && field[1].validation != null && field[1].validation != ""){
		t = t.replace(/_validation_/g,'validation="'+field[1].validation+'"');
	}else{
		t = t.replace(/_validation_/g,'');
	}
	return t;
});

IceHRMBase.method('renderFormSelectOptions', function(options) {
	var html = "";
	for(var i=0;i<options.length;i++){
		var t = '<option value="_id_">_val_</option>';
		t = t.replace('_id_', options[i][0]);
		t = t.replace('_val_', options[i][1]);
		html += t;
	}
	return html;
	
});

IceHRMBase.method('renderFormSelectOptionsRemote', function(options,field) {
	var html = "";
	if(field[1]['allow-null'] == true){
		html += '<option value="NULL">Select</option>';
	}
	for (var prop in options) {
		var t = '<option value="_id_">_val_</option>';
		t = t.replace('_id_', prop);
		t = t.replace('_val_', options[prop]);
		html += t;
	}
	return html;
	
});

IceHRMBase.method('setTemplates', function(templates) {
	this.templates = templates;
});

IceHRMBase.method('setCustomTemplates', function(templates) {
	this.customTemplates = templates;
});

IceHRMBase.method('setEmailTemplates', function(templates) {
	this.emailTemplates = templates;
});

IceHRMBase.method('getCustomTemplate', function(file) {
	return this.customTemplates[file];
});

IceHRMBase.method('setFieldTemplates', function(templates) {
	this.fieldTemplates = templates;
});

IceHRMBase.method('getDataMapping', function() {

});

IceHRMBase.method('clearDeleteParams', function() {
	this.deleteParams = {};
});

IceHRMBase.method('getShowAddNew', function() {
	return this.showAddNew;
});

IceHRMBase.method('setShowAddNew', function(showAddNew) {
	this.showAddNew = showAddNew;
});

IceHRMBase.method('getCustomTableParams', function() {
	return {};
});

IceHRMBase.method('getActionButtons', function(obj) {
	return modJs.getActionButtonsHtml(obj.aData[0],obj.aData);
});

IceHRMBase.method('getActionButtonsHtml', function(id,data) {
	var html = '<div style="width:80px;"><img class="tableActionButton" src="_BASE_images/edit.png" style="cursor:pointer;" rel="tooltip" title="Edit" onclick="modJs.edit(_id_);return false;"></img><img class="tableActionButton" src="_BASE_images/delete.png" style="margin-left:15px;cursor:pointer;" rel="tooltip" title="Delete" onclick="modJs.deleteRow(_id_);return false;"></img><div value="3" id="MA"></div></div>';
	html = html.replace(/_id_/g,id);
	html = html.replace(/_BASE_/g,this.baseUrl);
	return html;
});