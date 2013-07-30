/**
 * Author: Thilina Hasantha
 */
 /**
 * ChiNhanhAdapter
 */

function ChiNhanhAdapter(endPoint) {
	this.initAdapter(endPoint);
}

ChiNhanhAdapter.inherits(AdapterBase);

ChiNhanhAdapter.method('getDataMapping', function() {
	return [
	        "MA",
	        "TEN_NGAN",
			"TEN_DAI",
			"DIA_CHI",
			"DIEN_THOAI"
	];
});

ChiNhanhAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "T\u00ean ng\u1eafn" },
			{ "sTitle": "T\u00ean d\u00e0i" },
			{ "sTitle": "\u0110\u1ecba ch\u1ec9" },
			{ "sTitle": "\u0110i\u1ec7n tho\u1ea1i" }
	];
});

ChiNhanhAdapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
	        [ "TEN_NGAN", {"label":"T\u00ean ng\u1eafn","type":"text"}],
			[ "TEN_DAI", {"label":"T\u00ean d\u00e0i","type":"text"}],
			[ "DIA_CHI", {"label":"\u0110\u1ecba ch\u1ec9","type":"text"}],
			[ "DIEN_THOAI", {"label":"\u0110i\u1ec7n tho\u1ea1i","type":"text"}]
	];
});

/**
 * NVStateAdapter
 */

function NVStateAdapter(endPoint) {
	this.initAdapter(endPoint);
}

NVStateAdapter.inherits(AdapterBase);

NVStateAdapter.method('getDataMapping', function() {
	return [
	        "MA",
	        "TEN"
	];
});

NVStateAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "T\u00ecnh tr\u1ea1ng" }
	];
});

NVStateAdapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
	        [ "TEN", {"label":"T\u00ecnh tr\u1ea1ng","type":"text"}]
	];
});