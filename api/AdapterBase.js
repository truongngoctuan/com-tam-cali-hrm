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


function AdapterBase(endPoint) {

}

this.moduleRelativeURL = null;
this.tableData = new Array();
this.sourceData = new Array();
this.filter = null;
this.orderBy = null;
this.currentElement = null;

AdapterBase.inherits(IceHRMBase);

AdapterBase.method('initAdapter' , function(endPoint,tab,filter,orderBy) {
	this.moduleRelativeURL = baseUrl;
	this.table = endPoint;
	if(tab == undefined || tab == null){
		this.tab = endPoint;
	}else{
		this.tab = tab;
	}
	
	if(filter == undefined || filter == null){
		this.filter = null;
	}else{
		this.filter = filter;
	}
	
	if(orderBy == undefined || orderBy == null){
		this.orderBy = null;
	}else{
		this.orderBy = orderBy;
	}
	
});

AdapterBase.method('setFilter', function(filter) {
	this.filter = filter;
});

AdapterBase.method('getFilter', function() {
	return this.filter;
});

AdapterBase.method('setOrderBy', function(orderBy) {
	this.orderBy = orderBy;
});

AdapterBase.method('getOrderBy', function() {
	return this.orderBy;
});

AdapterBase.method('add', function(object,callBackData) {
	var that = this;
	$(object).attr('a','add');
	$(object).attr('t',this.table);
	$.post(this.moduleRelativeURL, object, function(data) {
		if(data.status == "SUCCESS"){
			that.addSuccessCallBack(callBackData,data.object);
		}else{
			that.addFailCallBack(callBackData,data.object);
		}
	},"json");
});

AdapterBase.method('addSuccessCallBack', function(callBackData,serverData) {
	this.get(callBackData);
});

AdapterBase.method('addFailCallBack', function(callBackData,serverData) {
	
});

AdapterBase.method('deleteObj', function(id,callBackData) {
	//alert('deleteObj');
	var that = this;
	$.post(this.moduleRelativeURL, {'t':this.table,'a':'delete','id':id}, function(data) {
		if(data.status == "SUCCESS"){
			that.deleteSuccessCallBack(callBackData,data.object);
		}else{
			that.deleteFailCallBack(callBackData,data.object);
		}
	},"json");
});

AdapterBase.method('deleteSuccessCallBack', function(callBackData,serverData) {
	this.get(callBackData);
	this.clearDeleteParams();
});

AdapterBase.method('deleteFailCallBack', function(callBackData,serverData) {
	this.clearDeleteParams();
	this.showMessage("Error Occurred while Deleting Item",serverData);
});

AdapterBase.method('get', function(callBackData) {
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
	
	$.post(this.moduleRelativeURL, {'t':this.table,'a':'get','sm':sourceMappingJson,'ft':filterJson,'ob':orderBy}, function(data) {
		if(data.status == "SUCCESS"){
			that.getSuccessCallBack(callBackData,data.object);
		}else{
			that.getFailCallBack(callBackData,data.object);
		}
	},"json");
	
	//var url = this.getDataUrl();
	//console.log(url);
});


AdapterBase.method('getDataUrl', function(columns) {
	var that = this;
	var sourceMappingJson = JSON.stringify(this.getSourceMapping());
	
	var columns = JSON.stringify(columns);
	
	var filterJson = "";
	if(this.getFilter() != null){
		filterJson = JSON.stringify(this.getFilter());
	}
	
	var orderBy = "";
	if(this.getOrderBy() != null){
		orderBy = this.getOrderBy();
	}
	
	var url = this.moduleRelativeURL.replace("service.php","data.php");
	url = url+"?"+"t="+this.table;
	url = url+"&"+"sm="+sourceMappingJson;
	url = url+"&"+"cl="+columns;
	url = url+"&"+"ft="+filterJson;
	url = url+"&"+"ob="+orderBy;
	
	return url;
});

AdapterBase.method('preProcessTableData', function(row) {
	return row;
});

AdapterBase.method('getSuccessCallBack', function(callBackData,serverData) {
	var data = [];
	var mapping = this.getDataMapping();
	for(var i=0;i<serverData.length;i++){
		var row = [];
		for(var j=0;j<mapping.length;j++){
			row[j] = serverData[i][mapping[j]];
		}
		data.push(this.preProcessTableData(row));
	}
	this.sourceData = serverData;
	if(callBackData['callBack']!= undefined && callBackData['callBack'] != null){
		if(callBackData['callBackData'] == undefined || callBackData['callBackData'] == null){
			callBackData['callBackData'] = new Array();
		}
		callBackData['callBackData'].push(serverData);
		callBackData['callBackData'].push(data);
		this.callFunction(callBackData['callBack'],callBackData['callBackData']);
	}
	
	this.tableData = data;
	
	if(callBackData['noRender']!= undefined && callBackData['noRender'] != null && callBackData['noRender'] == true){
		
	}else{
		this.createTable(this.getTableName());
		$("#"+this.getTableName()+'Form').hide();
		$("#"+this.getTableName()).show();
	}
	
});

AdapterBase.method('getFailCallBack', function(callBackData,serverData) {
	
});


AdapterBase.method('getElement', function(id,callBackData) {
	var that = this;
	var sourceMappingJson = JSON.stringify(this.getSourceMapping());
	$.post(this.moduleRelativeURL, {'t':this.table,'a':'getElement','id':id,'sm':sourceMappingJson}, function(data) {
		if(data.status == "SUCCESS"){
			that.getElementSuccessCallBack(callBackData,data.object);
		}else{
			that.getElementFailCallBack(callBackData,data.object);
		}
	},"json");
});

AdapterBase.method('getElementSuccessCallBack', function(callBackData,serverData) {
	if(callBackData['callBack']!= undefined && callBackData['callBack'] != null){
		if(callBackData['callBackData'] == undefined || callBackData['callBackData'] == null){
			callBackData['callBackData'] = new Array();
		}
		callBackData['callBackData'].push(serverData);
		this.callFunction(callBackData['callBack'],callBackData['callBackData']);
	}
	this.currentElement = serverData;
	if(callBackData['noRender']!= undefined && callBackData['noRender'] != null && callBackData['noRender'] == true){
		
	}else{
		this.renderForm(serverData);
	}
});

AdapterBase.method('getElementFailCallBack', function(callBackData,serverData) {
	
});


AdapterBase.method('getTableData', function() {
	return this.tableData;
});

AdapterBase.method('getTableName', function() {
	return this.tab;
});

AdapterBase.method('getFieldValues', function(fieldMaster,callBackData) {
	var that = this;
	$.post(this.moduleRelativeURL, {'t':fieldMaster[0],'key':fieldMaster[1],'value':fieldMaster[2],'a':'getFieldValues'}, function(data) {
		if(data.status == "SUCCESS"){
			callBackData['callBackData'].push(data.data);
			that.callFunction(callBackData['callBack'],callBackData['callBackData']);
		}
	},"json");
});

AdapterBase.method('setAdminEmployee', function(empId) {
	var that = this;
	$.post(this.moduleRelativeURL, {'a':'setAdminEmp','empid':empId}, function(data) {
		top.location.href = clientUrl;
	},"json");
});

AdapterBase.method('customAction', function(subAction,module,request,callBackData) {
	var that = this;
	$.post(this.moduleRelativeURL, {'t':this.table,'a':'ca','sa':subAction,'mod':module,'req':request}, function(data) {
		if(data.status == "SUCCESS"){
			callBackData['callBackData'].push(data.data);
			that.callFunction(callBackData['callBackSuccess'],callBackData['callBackData']);
		}else{
			callBackData['callBackData'].push(data.data);
			that.callFunction(callBackData['callBackFail'],callBackData['callBackData']);
		}
	},"json");
});
