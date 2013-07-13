/**
 * Author: Thilina Hasantha
 */

function CompanyStructureAdapter(endPoint) {
	this.initAdapter(endPoint);
}

CompanyStructureAdapter.inherits(AdapterBase);



CompanyStructureAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "title",
	        "address",
	        "type",
	        "country",
	        "parent"
	];
});

CompanyStructureAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID","bVisible":false },
			{ "sTitle": "Name" },
			{ "sTitle": "Address"},
			{ "sTitle": "Type"},
			{ "sTitle": "Country", "sClass": "center" },
			{ "sTitle": "Parent Structure"}
	];
});

CompanyStructureAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden","validation":""}],
	        [ "title", {"label":"Name","type":"text","validation":""}],
	        [ "description", {"label":"Details","type":"textarea","validation":""}],
	        [ "address", {"label":"Address","type":"textarea","validation":"none"}],
	        [ "type", {"label":"Type","type":"select","source":[["Company","Company"],["Head Office","Head Office"],["Regional Office","Regional Office"],["Department","Department"],["Unit","Unit"],["Sub Unit","Sub Unit"],["Other","Other"]]}],
			[ "country", {"label":"Country","type":"select","remote-source":["Country","code","name"]}],
			[ "parent", {"label":"Parent Structure","type":"select","allow-null":true,"remote-source":["CompanyStructure","id","title"]}]
	];
});


/*
 * Company Graph
 */


function CompanyGraphAdapter(endPoint) {
	this.initAdapter(endPoint);
}

CompanyGraphAdapter.inherits(CompanyStructureAdapter);

CompanyGraphAdapter.method('createTable', function(elementId) {

	var sourceData = this.sourceData;

	if(modJs['r'] == undefined || modJs['r'] == null){
		modJs['r'] = Raphael("CompanyGraph", 800, 1000);
	}else{
		return;
	}

	var r = modJs['r'];

	for(var i=0; i< sourceData.length; i++){
		sourceData[i].parent = sourceData[i]._original[6];
	}
	
	var hierarchy = new HierarchyJs();
	var nodes = hierarchy.createNodes(sourceData);
	hierarchy.createHierarchy(nodes, r);
	
	
});




