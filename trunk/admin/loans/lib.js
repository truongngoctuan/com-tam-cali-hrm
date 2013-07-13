/**
 * Author: Thilina Hasantha
 */


/**
 * CompanyLoanAdapter
 */

function CompanyLoanAdapter(endPoint) {
	this.initAdapter(endPoint);
}

CompanyLoanAdapter.inherits(AdapterBase);



CompanyLoanAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "details"
	];
});

CompanyLoanAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Details"}
	];
});

CompanyLoanAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Name","type":"text","validation":""}],
	        [ "details", {"label":"Details","type":"textarea","validation":"none"}]
	];
});
