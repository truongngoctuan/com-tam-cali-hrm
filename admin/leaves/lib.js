/**
 * Author: Thilina Hasantha
 */

function LeaveTypeAdapter(endPoint) {
	this.initAdapter(endPoint);
}

LeaveTypeAdapter.inherits(AdapterBase);



LeaveTypeAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "leave_accrue",
	        "carried_forward",
	        "default_per_year"
	];
});

LeaveTypeAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Leave Name" },
			{ "sTitle": "Leave Accrue Enabled" },
			{ "sTitle": "Leave Carried Forward"},
			{ "sTitle": "Leaves Per Year"}
	];
});

LeaveTypeAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden","validation":""}],
	        [ "name", {"label":"Leave Name","type":"text","validation":""}],
	        [ "supervisor_leave_assign", {"label":"Supervisor can assign leave to employees","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "employee_can_apply", {"label":"Employees can apply for this leave type","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "apply_beyond_current", {"label":"Employees can apply beyond the current leave balance","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "leave_accrue", {"label":"Leave Accrue Enabled","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "carried_forward", {"label":"Leave Carried Forward","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "default_per_year", {"label":"Leaves Per Year","type":"text","validation":"number"}]
	];
});



/*
 * Leave rules
 */

function LeaveRuleAdapter(endPoint) {
	this.initAdapter(endPoint);
}

LeaveRuleAdapter.inherits(AdapterBase);



LeaveRuleAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "leave_type",
	        "job_title",
	        "employment_status",
	        "employee",
	        "default_per_year"
	];
});

LeaveRuleAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Leave Type" },
			{ "sTitle": "Job Title" },
			{ "sTitle": "Employment Status"},
			{ "sTitle": "Employee"},
			{ "sTitle": "Leaves Per Year"}
	];
});

LeaveRuleAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden","validation":""}],
	        [ "leave_type", {"label":"Leave Type","type":"select","allow-null":false,"remote-source":["LeaveType","id","name"]}],
	        [ "job_title", {"label":"Job Title","type":"select","allow-null":true,"remote-source":["JobTitle","id","name"]}],
	        [ "employment_status", {"label":"Employment Status","type":"select","allow-null":true,"remote-source":["EmploymentStatus","id","name"]}],
	        [ "employee", {"label":"Employee","type":"select","allow-null":true,"remote-source":["Employee","id","first_name+last_name"]}],
	        [ "supervisor_leave_assign", {"label":"Supervisor can assign leave to employees","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "employee_can_apply", {"label":"Employees can apply for this leave type","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "apply_beyond_current", {"label":"Employees can apply beyond the current leave balance","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "leave_accrue", {"label":"Leave Accrue Enabled","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "carried_forward", {"label":"Leave Carried Forward","type":"select","source":[["No","No"],["Yes","Yes"]]}],
	        [ "default_per_year", {"label":"Leaves Per Year","type":"text","validation":"number"}]
	];
});


/*
 * Leave periods
 */

function LeavePeriodAdapter(endPoint) {
	this.initAdapter(endPoint);
}

LeavePeriodAdapter.inherits(AdapterBase);



LeavePeriodAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "date_start",
	        "date_end",
	        "status"
	];
});

LeavePeriodAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Period Start" },
			{ "sTitle": "Period End"},
			{ "sTitle": "Status"}
	];
});

LeavePeriodAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden","validation":""}],
	        [ "name", {"label":"Name","type":"text","validation":""}],
	        [ "date_start", {"label":"Period Start","type":"date","validation":""}],
	        [ "date_end", {"label":"Period End","type":"date","validation":""}],
	        [ "status", {"label":"Status","type":"select","source":[["Active","Active"],["Inactive","Inactive"]]}]
	];
});

LeavePeriodAdapter.method('get', function(callBackData) {
	var that = this;
	var callBackData = {"callBack":"checkLeavePeriods"};
	this.uber('get',callBackData);
});

LeavePeriodAdapter.method('checkLeavePeriods', function() {
	var numberOfActiveLeavePeriods = 0;
	for(var i=0;i<this.sourceData.length;i++){
		if(this.sourceData[i].status == 'Active'){
			numberOfActiveLeavePeriods++;
		}
	}
	
	if(numberOfActiveLeavePeriods < 1){
		//$('#LeavePeriod_Error').html("You should have one active leave period");
		//$('#LeavePeriod_Error').show();
		this.showMessage("Error","You should have one active leave period.");
	}else if(numberOfActiveLeavePeriods > 1){
		//$('#LeavePeriod_Error').html("You should have only one active leave period");
		this.showMessage("Error","You should have only one active leave period");
		//$('#LeavePeriod_Error').show();
	}else{
		//$('#LeavePeriod_Error').html("");
		//$('#LeavePeriod_Error').hide();
	}
});

/*
 * Work Days
 */

function WorkDayAdapter(endPoint) {
	this.initAdapter(endPoint);
}

WorkDayAdapter.inherits(AdapterBase);



WorkDayAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "status"
	];
});

WorkDayAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Status" }
	];
});

WorkDayAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden","validation":""}],
	        [ "status", {"label":"Status","type":"select","source":[["Full Day","Full Day"],["Half Day","Half Day"],["Non-working Day","Non-working Day"]]}]
	];
});

WorkDayAdapter.method('getActionButtonsHtml', function(id) {
	var html = '<div style="width:50px;"><img class="tableActionButton" src="_BASE_images/edit.png" style="cursor:pointer;" rel="tooltip" title="Edit" onclick="modJs.edit(_id_);return false;"></img></div>';
	html = html.replace(/_id_/g,id);
	html = html.replace(/_BASE_/g,this.baseUrl);
	return html;
});

WorkDayAdapter.method('getShowAddNew', function() {
	return false;
});

WorkDayAdapter.method('getCustomTableParams', function() {
	return {
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    };
});



/*
 * Holidays
 */

function HoliDayAdapter(endPoint) {
	this.initAdapter(endPoint);
}

HoliDayAdapter.inherits(AdapterBase);



HoliDayAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "dateh",
	        "status"
	];
});

HoliDayAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Date" },
			{ "sTitle": "Status" }
	];
});

HoliDayAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden","validation":""}],
	        [ "name", {"label":"Name","type":"text","validation":""}],
	        [ "dateh", {"label":"Date","type":"date","validation":""}],
	        [ "status", {"label":"Status","type":"select","source":[["Full Day","Full Day"],["Half Day","Half Day"]]}]
	];
});


/**
 * EmployeeLeaveAdapter
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
	        "employee",
	        "leave_type",
	        "date_start",
	        "date_end",
	        "status"
	];
});

EmployeeLeaveAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Employee" },
			{ "sTitle": "Leave Type" },
			{ "sTitle": "Leave Start Date"},
			{ "sTitle": "Leave End Date"},
			{ "sTitle": "Status"}
	];
});

EmployeeLeaveAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "employee", {"label":"Employee","type":"select","allow-null":false,"remote-source":["Employee","id","first_name+last_name"]}],
	        [ "leave_type", {"label":"Leave Type","type":"select","remote-source":["LeaveType","id","name"]}],
	        [ "date_start", {"label":"Leave Start Date","type":"date","validation":""}],
	        [ "date_end", {"label":"Leave Start Date","type":"date","validation":""}],
	        [ "details", {"label":"Reason","type":"textarea","validation":"none"}]
	];
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


EmployeeLeaveAdapter.method('getLeaveDaysReadonly', function(leaveId) {
	var that = this;
	var object = {"leave_id":leaveId};
	var reqJson = JSON.stringify(object);
	
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'getLeaveDaysReadonlySuccessCallBack';
	callBackData['callBackFail'] = 'getLeaveDaysReadonlyFailCallBack';
	
	this.customAction('getLeaveDaysReadonly','admin=leaves',reqJson,callBackData);
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
	html = '<div style="width:80px;"><img class="tableActionButton" src="_BASE_images/info.png" style="cursor:pointer;" rel="tooltip" title="Show Leave Days" onclick="modJs.getLeaveDaysReadonly(_id_);return false;"></img><img class="tableActionButton" src="_BASE_images/run.png" style="cursor:pointer;margin-left:15px;" rel="tooltip" title="Change Leave Status" onclick="modJs.openLeaveStatus(_id_,\'_status_\');return false;"></img><img class="tableActionButton" src="_BASE_images/delete.png" style="margin-left:15px;cursor:pointer;" rel="tooltip" title="Cancel Leave" onclick="modJs.deleteRow(_id_);return false;"></img></div>';

	html = html.replace(/_id_/g,id);
	html = html.replace(/_status_/g,data[4]);
	html = html.replace(/_BASE_/g,this.baseUrl);
	
	return html;
});

EmployeeLeaveAdapter.method('get', function(callBackData) {
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
	
	this.customAction('getSubEmployeeLeaves','admin=leaves',reqJson,callBackData);
	
});

EmployeeLeaveAdapter.method('getCustomSuccessCallBack', function(serverData) {
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



EmployeeLeaveAdapter.method('openLeaveStatus', function(leaveId,status) {
	$('#leaveStatusModel').modal('show');
	$('#leave_status').val(status);
	this.leaveStatusChangeId = leaveId;
});

EmployeeLeaveAdapter.method('closeLeaveStatus', function() {
	$('#leaveStatusModel').modal('hide');
});

EmployeeLeaveAdapter.method('changeLeaveStatus', function() {
	var leaveStatus = $('#leave_status').val();
	object = {"id":this.leaveStatusChangeId,"status":leaveStatus};
	
	var reqJson = JSON.stringify(object);
	
	var callBackData = [];
	callBackData['callBackData'] = [];
	callBackData['callBackSuccess'] = 'changeLeaveStatusSuccessCallBack';
	callBackData['callBackFail'] = 'changeLeaveStatusFailCallBack';
	
	this.customAction('changeLeaveStatus','admin=leaves',reqJson,callBackData);
	
	this.closeLeaveStatus();
	this.leaveStatusChangeId = null;
});

EmployeeLeaveAdapter.method('changeLeaveStatusSuccessCallBack', function(callBackData) {
	this.showMessage("Successful", "Leave status changed successfully");
	this.get([]);
});

EmployeeLeaveAdapter.method('changeLeaveStatusFailCallBack', function(callBackData) {
	this.showMessage("Error", "Error occured while changing leave status");
});










