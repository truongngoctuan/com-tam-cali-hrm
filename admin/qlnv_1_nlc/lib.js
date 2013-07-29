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
 * Ca22Adapter
 */

function Ca22Adapter(endPoint) {
	this.initAdapter(endPoint);
}

Ca22Adapter.inherits(AdapterBase);



Ca22Adapter.method('getDataMapping', function() {
	return [
	        "MA",
	        "TEN"
	];
});

Ca22Adapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "T\u00ean" }
	];
});

Ca22Adapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
	        [ "TEN", {"label":"T\u00ean","type":"text"}]
	];
});

/**
 * BoPhanAdapter
 */

function BoPhanAdapter(endPoint) {
	this.initAdapter(endPoint);
}

BoPhanAdapter.inherits(AdapterBase);

BoPhanAdapter.method('getDataMapping', function() {
	return [
	        "MA",
	        "TEN"
	];
});

BoPhanAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "T\u00ean" }
	];
});

BoPhanAdapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
	        [ "TEN", {"label":"T\u00ean","type":"text"}]
	];
});

/**
 * NguonAdapter
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
			{ "sTitle": "T\u00ean" },
			{ "sTitle": "Di\u1ec5n gi\u1ea3i" }
	];
});

NguonAdapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
	        [ "TEN", {"label":"T\u00ean","type":"text"}],
			[ "DIEN_GIAI", {"label":"Di\u1ec5n gi\u1ea3i","type":"text"}]
	];
});

/**
 * LoaiNgayAdapter
 */

function LoaiNgayAdapter(endPoint) {
	this.initAdapter(endPoint);
}

LoaiNgayAdapter.inherits(AdapterBase);

LoaiNgayAdapter.method('getDataMapping', function() {
	return [
	        "MA",
	        "TEN"
	];
});

LoaiNgayAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "T\u00ean" }
	];
});

LoaiNgayAdapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
	        [ "TEN", {"label":"T\u00ean","type":"text"}]
	];
});