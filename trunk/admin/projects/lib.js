/**
 * Author: Thilina Hasantha
 */

/**
 * ClientAdapter
 */

function ClientAdapter(endPoint,tab,filter,orderBy) {
	this.initAdapter(endPoint,tab,filter,orderBy);
}

ClientAdapter.inherits(AdapterBase);



ClientAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "details",
	        "address",
	        "contact_number"
	];
});

ClientAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID","bVisible":false },
			{ "sTitle": "Name" },
			{ "sTitle": "Details"},
			{ "sTitle": "Address"},
			{ "sTitle": "Contact Number"}
	];
});

ClientAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Name","type":"text"}],
	        [ "description",  {"label":"Details","type":"textarea","validation":"none"}],
	        [ "address",  {"label":"Address","type":"textarea","validation":"none"}],
	        [ "contact_number", {"label":"Contact Number","type":"text","validation":"none"}],
	        [ "contact_email", {"label":"Contact Email","type":"text","validation":"none"}],
	        [ "company_url", {"label":"Company Url","type":"text","validation":"none"}],
	        [ "status", {"label":"Status","type":"select","source":[["Active","Active"],["Inactive","Inactive"]]}],
	        [ "first_contact_date", {"label":"First Contact Date","type":"date","validation":"none"}]
	];
});

/**
 * ProjectAdapter
 */

function ProjectAdapter(endPoint,tab,filter,orderBy) {
	this.initAdapter(endPoint,tab,filter,orderBy);
}

ProjectAdapter.inherits(AdapterBase);



ProjectAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "client"
	];
});

ProjectAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID","bVisible":false },
			{ "sTitle": "Name" },
			{ "sTitle": "Client"},
	];
});

ProjectAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Name","type":"text"}],
	        [ "client", {"label":"Client","type":"select","allow-null":true,"remote-source":["Client","id","name"]}],
	        [ "description",  {"label":"Details","type":"textarea","validation":"none"}],
	        [ "status", {"label":"Status","type":"select","source":[["Active","Active"],["Inactive","Inactive"]]}]
	];
});





