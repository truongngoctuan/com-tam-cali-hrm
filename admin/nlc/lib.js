/**
 * Author: Thilina Hasantha
 */
/**
 * CaAdapter
 */

function CaAdapter(endPoint) {
	this.initAdapter(endPoint);
}

CaAdapter.inherits(AdapterBase);



CaAdapter.method('getDataMapping', function() {
	return [
	        "MA",
	        "TEN"
	];
});

CaAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Code" }
	];
});

CaAdapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
	        [ "TEN", {"label":"Code","type":"text"}]
	];
});

/**
 * CaAdapter
 */

function NguonAdapter(endPoint) {
	this.initAdapter(endPoint);
}

NguonAdapter.inherits(AdapterBase);



NguonAdapter.method('getDataMapping', function() {
	return [
	        "MA",
	        "TEN",
			"DIEN_GIAI"
	];
});

NguonAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Code" },
			{ "sTitle": "DIEN GIAI" }
	];
});

NguonAdapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
	        [ "TEN", {"label":"Code","type":"text"}],
			[ "DIEN_GIAI", {"label":"Code","type":"text"}]
	];
});
