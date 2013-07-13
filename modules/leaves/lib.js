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

function EmployeeLeaveAdapter(endPoint,tab,filter,orderBy) {
	this.initAdapter(endPoint,tab,filter,orderBy);
}

EmployeeLeaveAdapter.inherits(AdapterBase);

this.leaveInfo = null;
this.currentLeaveRule = null;

EmployeeLeaveAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "leave_type",
	        "date_start",
	        "date_end",
	        "status"
	];
});

EmployeeLeaveAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Leave Type" },
			{ "sTitle": "Leave Start Date"},
			{ "sTitle": "Leave End Date"},
			{ "sTitle": "Status"}
	];
});

EmployeeLeaveAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "leave_type", {"label":"Leave Type","type":"select","remote-source":["LeaveType","id","name"]}],
	        [ "date_start", {"label":"Leave Start Date","type":"date","validation":""}],
	        [ "date_end", {"label":"Leave Start Date","type":"date","validation":""}],
	        [ "details", {"label":"Reason","type":"textarea","validation":"none"}]
	];
});


EmployeeLeaveAdapter.method('add', function(object,callBackData) {
	var that = this;
	var days = {};
	$('.days').each(function(index) {
		days[$(this).attr('id')]=$(this).val();
	});
	
	var numberOfLeaves = this.calculateNumberOfLeaves(days);
	var availableLeaves = parseFloat(this.leaveInfo['availableLeaves']); 
	
	if(numberOfLeaves > availableLeaves && this.currentLeaveRule.apply_beyond_current == "No"){
		this.showMessage("Error Applying Leave","You are trying to apply "+numberOfLeaves+" leaves. But you are only allowed to apply for "+availableLeaves+" leaves.");
		return;
	}
	
	object['days'] = JSON.stringify(days);
	
	var reqJson = JSON.stringify(object);
	
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'addSuccessCallBack';
	callBackData['callBackFail'] = 'addFailCallBack';
	
	this.customAction('addLeave','modules=leaves',reqJson,callBackData);
});

EmployeeLeaveAdapter.method('addSuccessCallBack', function(callBackData) {
	this.showMessage("Successful", "Leave application successful. You will be notified once your supervisor approve your leaves.");
	this.get([]);
});

EmployeeLeaveAdapter.method('addFailCallBack', function(callBackData) {
	this.showMessage("Error Occured while Applying Leave", callBackData);
});

EmployeeLeaveAdapter.method('calculateNumberOfLeaves', function(days) {
	var sum = 0.0;
	for (var prop in days) {
		if(days.hasOwnProperty(prop)){
			if(days[prop] == "Full Day"){
				sum += 1;
			}else{
				sum += 0.5;
			}
		}
    }
	return sum;
});

EmployeeLeaveAdapter.method('calculateNumberOfLeavesObject', function(days) {
	var sum = 0.0;
	for(var i=0;i<days.length;i++){
		if(days[i].leave_type == "Full Day"){
			sum += 1;
		}else{
			sum += 0.5;
		}
	}
	return sum;
});


EmployeeLeaveAdapter.method('getLeaveDays', function() {
	var that = this;
	var validator = new FormValidation(this.getTableName()+"_submit",true,{'ShowPopup':false,"LabelErrorClass":"error"});
	if(validator.checkValues()){
		var params = validator.getFormParameters();
		
		var msg = this.doCustomValidation(params);
		if(msg == null){
			var id = $('#'+this.getTableName()+"_submit #id").val();
			if(id != null && id != undefined && id != ""){
				$(params).attr('id',id);
			}
			var object = {"start_date":params.date_start,"end_date":params.date_end,"leave_type":params.leave_type};
			var reqJson = JSON.stringify(object);
			
			var callBackData = [];
			callBackData['callBackData'] = [];
			callBackData['callBackSuccess'] = 'getLeaveDaysSuccessCallBack';
			callBackData['callBackFail'] = 'getLeaveDaysFailCallBack';
			
			this.customAction('getLeaveDays','modules=leaves',reqJson,callBackData);
			
		}else{
			$("#"+this.getTableName()+'Form .label').html(msg);
			$("#"+this.getTableName()+'Form .label').show();
		}
		
	}
});


EmployeeLeaveAdapter.method('getLeaveDaysSuccessCallBack', function(callBackData) {
	var days = callBackData[0];
	this.leaveInfo = callBackData[1];
	this.currentLeaveRule = callBackData[2];
	$('#leave_days_table_body').html('');
	var selectH = '<select id="_id_" class="days"><option value="Half Day - Morning">Half Day - Morning</option><option value="Half Day - Afternoon">Half Day - Afternoon</option></select>';
	var selectF = '<select id="_id_" class="days"><option value="Full Day">Full Day</option><option value="Half Day - Morning">Half Day - Morning</option><option value="Half Day - Afternoon">Half Day - Afternoon</option></select>';
	var row = '<tr><td>_date_</td><td>_select_</td></tr>';
	var select;
	var html = "";
	$.each(days, function(key, value) { 
		
		if(value+''!='2'){
		
			if(value+''=='1'){
				select = selectF;
			}else{
				select = selectH;
			}
			var tkey = key.split("-").join("");
			select = select.replace(/_id_/g, tkey);
			
		}else{
			select = '<span class="label label-info">Non working day</span>';
		}
		var trow = row;
		
		trow = trow.replace(/_date_/g,Date.parse(key).toString('MMM d, yyyy (dddd)'));
		trow = trow.replace(/_select_/g,select);
		html += trow;
	});
	$('#leave_days_table_body').html(html);
	$('#leave_days_table').show();
	$('#EmployeeLeaveAll_submit').hide();
	$('#leave_days_table_cont').show();
	
	$('#pending_leave_count').html(this.leaveInfo['pendingLeaves']);
	$('#available_leave_count').html(this.leaveInfo['availableLeaves']);
	$('#approved_leave_count').html(this.leaveInfo['approvedLeaves']);
});

EmployeeLeaveAdapter.method('getLeaveDaysFailCallBack', function(callBackData) {
	this.showMessage("Error Occured while Applying Leave", callBackData);
});

EmployeeLeaveAdapter.method('doCustomValidation', function(params) {
	try{
		if(params['date_start'] != params['date_end']){
			var ds = new Date(params['date_start']);
			var de = new Date(params['date_end']);
			if(de < ds){
				return "Start date should be earlier than end date of the leave period";
			}
		}
	}catch(e){
		
	}
	return null;
});

EmployeeLeaveAdapter.method('showLeaveView', function() {
	$('#EmployeeLeaveAll_submit').show();
	$('#leave_days_table_cont').hide();
	
});

EmployeeLeaveAdapter.method('getLeaveDaysReadonly', function(leaveId) {
	var that = this;
	var object = {"leave_id":leaveId};
	var reqJson = JSON.stringify(object);
	
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'getLeaveDaysReadonlySuccessCallBack';
	callBackData['callBackFail'] = 'getLeaveDaysReadonlyFailCallBack';
	
	this.customAction('getLeaveDaysReadonly','modules=leaves',reqJson,callBackData);
});

EmployeeLeaveAdapter.method('getLeaveDaysReadonlySuccessCallBack', function(callBackData) {
	
	var table = '<table class="table table-condensed table-bordered table-striped" style="font-size:14px;"><thead><tr><th>Leave Date</th><th>Leave Type</th></tr></thead><tbody>_days_</tbody></table> ';
	var row = '<tr><td>_date_</td><td>_type_</td></tr>';
	
	var days = callBackData[0];
	var leaveInfo = callBackData[1];
	var html = "";
	
	html += '<span class="label label-inverse">Number of Leaves available ('+leaveInfo['availableLeaves']+')</span><br/>';
	
	leaveCount = this.calculateNumberOfLeavesObject(days);
	
	if(leaveCount > leaveInfo['availableLeaves']){
		html += '<span class="label label-important">Number of Leaves requested ('+leaveCount+')</span><br/>';
	}else{
		html += '<span class="label label-success">Number of Leaves requested ('+leaveCount+')</span><br/>';
	}
	
	for(var i=0;i<days.length;i++){
		var trow = row;
		trow = trow.replace(/_date_/g,Date.parse(days[i].leave_date).toString('MMM d, yyyy (dddd)'));
		trow = trow.replace(/_type_/g,days[i].leave_type);
		html += trow;
	}
	table = table.replace('_days_',html);
	this.showMessage("Leave Days",table);
});

EmployeeLeaveAdapter.method('getLeaveDaysReadonlyFailCallBack', function(callBackData) {
	this.showMessage("Error","Error Occured while Reading leave days from Server");
});


EmployeeLeaveAdapter.method('getActionButtonsHtml', function(id,data) {
	var html = "";
	if((this.getTableName() != "EmployeeLeaveAll" && this.getTableName() != "EmployeeLeavePending") || data[4] == "Approved" || data[4] == "Rejected"){
		html = '<div style="width:80px;"><img class="tableActionButton" src="_BASE_images/info.png" style="cursor:pointer;" rel="tooltip" title="Show Leave Days" onclick="modJs.getLeaveDaysReadonly(_id_);return false;"></img></div>';
	}else{
		html = '<div style="width:80px;"><img class="tableActionButton" src="_BASE_images/info.png" style="cursor:pointer;" rel="tooltip" title="Show Leave Days" onclick="modJs.getLeaveDaysReadonly(_id_);return false;"></img><img class="tableActionButton" src="_BASE_images/delete.png" style="margin-left:15px;cursor:pointer;" rel="tooltip" title="Cancel Leave" onclick="modJs.deleteRow(_id_);return false;"></img></div>';
	}
	html = html.replace(/_id_/g,id);
	html = html.replace(/_BASE_/g,this.baseUrl);
	
	return html;
});





/*
 * Subordinate Leaves
 */

function SubEmployeeLeaveAdapter(endPoint,tab,filter,orderBy) {
	this.initAdapter(endPoint,tab,filter,orderBy);
}

this.leaveStatusChangeId = null;

SubEmployeeLeaveAdapter.inherits(EmployeeLeaveAdapter);

SubEmployeeLeaveAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "employee",
	        "leave_type",
	        "date_start",
	        "date_end",
	        "status"
	];
});

SubEmployeeLeaveAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Employee" },
			{ "sTitle": "Leave Type" },
			{ "sTitle": "Leave Start Date"},
			{ "sTitle": "Leave End Date"},
			{ "sTitle": "Status"}
	];
});

SubEmployeeLeaveAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "employee", {"label":"Employee","type":"select","allow-null":false,"remote-source":["Employee","id","first_name+last_name"]}],
	        [ "leave_type", {"label":"Leave Type","type":"select","remote-source":["LeaveType","id","name"]}],
	        [ "date_start", {"label":"Leave Start Date","type":"date","validation":""}],
	        [ "date_end", {"label":"Leave Start Date","type":"date","validation":""}],
	        [ "details", {"label":"Reason","type":"textarea","validation":"none"}]
	];
});

SubEmployeeLeaveAdapter.method('get', function(callBackData) {
	var that = this;
	var sourceMappingJson = JSON.stringify(this.getSourceMapping());
	
	var filterJson = "";
	if(this.getFilter() != null){
		filterJson = JSON.stringify(this.getFilter());
	}
	
	var orderBy = "";
	if(this.getOrderBy() != null){
		orderBy = this.getOrderBy();
	}
	
	var object = {'sm':sourceMappingJson,'ft':filterJson,'ob':orderBy};
	var reqJson = JSON.stringify(object);
	
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'getCustomSuccessCallBack';
	callBackData['callBackFail'] = 'getFailCallBack';
	
	this.customAction('getSubEmployeeLeaves','modules=leaves',reqJson,callBackData);
	
});

SubEmployeeLeaveAdapter.method('getCustomSuccessCallBack', function(serverData) {
	var data = [];
	var mapping = this.getDataMapping();
	for(var i=0;i<serverData.length;i++){
		var row = [];
		for(var j=0;j<mapping.length;j++){
			row[j] = serverData[i][mapping[j]];
		}
		data.push(row);
	}
	
	this.tableData = data;
	
	this.createTable(this.getTableName());
	$("#"+this.getTableName()+'Form').hide();
	$("#"+this.getTableName()).show();
	
});



SubEmployeeLeaveAdapter.method('openLeaveStatus', function(leaveId,status) {
	$('#leaveStatusModel').modal('show');
	$('#leave_status').val(status);
	this.leaveStatusChangeId = leaveId;
});

SubEmployeeLeaveAdapter.method('closeLeaveStatus', function() {
	$('#leaveStatusModel').modal('hide');
});

SubEmployeeLeaveAdapter.method('changeLeaveStatus', function() {
	var leaveStatus = $('#leave_status').val();
	object = {"id":this.leaveStatusChangeId,"status":leaveStatus};
	
	var reqJson = JSON.stringify(object);
	
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'changeLeaveStatusSuccessCallBack';
	callBackData['callBackFail'] = 'changeLeaveStatusFailCallBack';
	
	this.customAction('changeLeaveStatus','modules=leaves',reqJson,callBackData);
	
	this.closeLeaveStatus();
	this.leaveStatusChangeId = null;
});

SubEmployeeLeaveAdapter.method('changeLeaveStatusSuccessCallBack', function(callBackData) {
	this.showMessage("Successful", "Leave status changed successfully");
	this.get([]);
});

SubEmployeeLeaveAdapter.method('changeLeaveStatusFailCallBack', function(callBackData) {
	this.showMessage("Error", "Error occured while changing leave status");
});

SubEmployeeLeaveAdapter.method('getActionButtonsHtml', function(id,data) {
	var html = "";
	html = '<div style="width:80px;"><img class="tableActionButton" src="_BASE_images/info.png" style="cursor:pointer;" rel="tooltip" title="Show Leave Days" onclick="modJs.getLeaveDaysReadonly(_id_);return false;"></img><img class="tableActionButton" src="_BASE_images/run.png" style="cursor:pointer;margin-left:15px;" rel="tooltip" title="Change Leave Status" onclick="modJs.openLeaveStatus(_id_,\'_status_\');return false;"></img></div>';

	html = html.replace(/_id_/g,id);
	html = html.replace(/_status_/g,data[4]);
	html = html.replace(/_BASE_/g,this.baseUrl);
	
	return html;
});


