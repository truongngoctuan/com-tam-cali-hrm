/**
 * Author: Thilina Hasantha
 */


/**
 * DocumentAdapter
 */

function DocumentAdapter(endPoint) {
	this.initAdapter(endPoint);
}

DocumentAdapter.inherits(AdapterBase);



DocumentAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "details"
	];
});

DocumentAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Details"}
	];
});

DocumentAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Name","type":"text","validation":""}],
	        [ "details", {"label":"Details","type":"textarea","validation":"none"}]
	];
});
