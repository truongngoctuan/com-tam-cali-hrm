/**
 * Author: Thilina Hasantha
 */
 
 /**
 * NhanVienAdapter
 */

function NhanVienAdapter(endPoint) {
	this.initAdapter(endPoint);
}

NhanVienAdapter.inherits(AdapterBase);

NhanVienAdapter.method('getDataMapping', function() {
	return [
	        "MA",
			"MA_BP",
			"MA_NGUON",
			"MA_CN",
			"MA_NV_STATE",
			"NGAY_PHONG_VAN",
			"NGAY_VAO_LAM",
			"LY_DO_KHONG_NHAN",
			"B_KINH_NGHIEM",
			"GHI_CHU_NHAN_NV",
			"MA_NV_CHINH_THUC",
			"NGAY_SINH",
			"DIA_CHI_HIEN_TAI",
			"HO_KHAU",
			"SDT",
			"CMND",
			"NGAY_CAP",
			"NOI CAP",
			"HO_SO",
			"GHI_CHU"
	];
});

NhanVienAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "M\u00e3", "bVisible":false},
			{ "sTitle": "MA_BP" },
			{ "sTitle": "MA_NGUON" },
			{ "sTitle": "MA_CN" },
			{ "sTitle": "MA_NV_STATE" },
			{ "sTitle": "Ng\u00e0y ph\u1ecfng v\u1ea5n" },
			{ "sTitle": "Ng\u00e0y v\u00e0o l\u00e0m" },
			{ "sTitle": "L\u00fd do kh\u00f4ng nh\u1eadn" },
			{ "sTitle": "C\u00f3 kinh nghi\u1ec7m" },
			{ "sTitle": "Ghi ch\u00fa" },
			{ "sTitle": "Ghi ch\u00fa nh\u1eadn" },
			{ "sTitle": "M\u00e3 NV" },
			{ "sTitle": "Ng\u00e0y sinh" },
			{ "sTitle": "\u0110\u1ecba ch\u1ec9" },
			{ "sTitle": "H\u1ed9 kh\u1ea9u" },
			{ "sTitle": "SDT" },
			{ "sTitle": "CMND" },
			{ "sTitle": "Ng\u00e0y c\u1ea5p" },
			{ "sTitle": "H\u1ed3 s\u01a1" },
			{ "sTitle": "Ghi ch\u00fa" }
	];
});

NhanVienAdapter.method('getFormFields', function() {
	return [
	        [ "MA", {"label":"ID","type":"hidden"}],
			[ "MA_BP", {"label":"MA_BP","type":"select","remote-source":["BoPhan","MA","TEN"]}],
			[ "MA_NGUON", {"label":"MA_NGUON","type":"select","remote-source":["Nguon","MA","TEN"]}],
			[ "MA_CN", {"label":"MA_CN","type":"select","remote-source":["ChiNhanh","MA","TEN_NGAN"]}],
			[ "MA_NV_STATE", {"label":"MA_NV_STATE","type":"select","remote-source":["NVState","MA","TEN"]}],
			[ "NGAY_PHONG_VAN", {"label":"Ng\u00e0y ph\u1ecfng v\u1ea5n","type":"date","validation":""}],
			[ "NGAY_VAO_LAM", {"label":"Ng\u00e0y v\u00e0o l\u00e0m","type":"date","allow-null":true,"validation":"none"}],
			[ "LY_DO_KHONG_NHAN", {"label":"L\u00fd do kh\u00f4ng nh\u1eadn","type":"text","allow-null":true,"validation":"none"}],
			[ "B_KINH_NGHIEM", {"label":"C\u00f3 kinh nghi\u1ec7m","type":"text"}],
			[ "GHI_CHU_NHAN_NV", {"label":"Ghi ch\u00fa nh\u1eadn","type":"text","allow-null":true,"validation":"none"}],
			[ "MA_NV_CHINH_THUC", {"label":"M\u00e3 NV","type":"text","allow-null":true,"validation":"none"}],
			[ "NGAY_SINH", {"label":"Ng\u00e0y sinh","type":"date","validation":""}],
			[ "DIA_CHI_HIEN_TAI", {"label":"\u0110\u1ecba ch\u1ec9","type":"text","allow-null":true,"validation":"none"}],
			[ "HO_KHAU", {"label":"H\u1ed9 kh\u1ea9u","type":"text","allow-null":true,"validation":"none"}],
			[ "SDT", {"label":"SDT","type":"text","allow-null":true,"validation":"none"}],
			[ "CMND", {"label":"CMND","type":"text","allow-null":true,"validation":"none"}],
			[ "NGAY_CAP", {"label":"Ng\u00e0y c\u1ea5p","type":"date","allow-null":true,"validation":"none"}],
			[ "NOI CAP", {"label":"Nơi cấp","type":"text","allow-null":true,"validation":"none"}],
			[ "HO_SO", {"label":"H\u1ed3 s\u01a1","type":"text","allow-null":true,"validation":"none"}],
			[ "GHI_CHU", {"label":"Ghi ch\u00fa","type":"text","allow-null":true,"validation":"none"}]
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

NVStateAdapter.method('createTable', function(elementId) {
	//alert('NVStateAdapter.createTable');
	
	if(this.getRemoteTable()){
		this.createTableServer(elementId);
		return;
	}
	
	
	var headers = this.getHeaders();
	var data = this.getTableData();
	//debugging("headers", headers);
	headers.push({ "sTitle": "", "sClass": "center" });
	
	for(var i=0;i<data.length;i++){
		data[i].push(this.getActionButtonsHtml(data[i][0],data[i]));
	}
	var html = "";
	if(this.getShowAddNew()){
		html = '<button style="float:right;" onclick="modJs.renderForm();return false;" class="btn btn-small">Add New <span class="icon-plus-sign"></span></button><table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="grid"></table>';
	}else{
		html = '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="grid"></table>';
	}

	$('#'+elementId).html(html);
	
	var dataTableParams = {
			"sDom": "<'row'<'dataClass1'l><'dataClass2'f>r>t<'row'<'dataClass3'i><'dataClass4'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aaData": data,
			"aoColumns": headers,
			"bSort": false
		};
	
	var customTableParams = this.getCustomTableParams();
	
	$.extend(dataTableParams, customTableParams);
	
	var oTable = $('#'+elementId+' #grid').dataTable( dataTableParams );
	
	$('.tableActionButton').tooltip();
	
	//var oTable = $('#'+elementId+' #grid');
	//debugging("oTable", oTable);
     
    /* Apply the jEditable handlers to the table */
    oTable.$('td').editable( '../examples_support/editable_ajax.php', {
        "callback": function( sValue, y ) {
            var aPos = oTable.fnGetPosition( this );
            oTable.fnUpdate( sValue, aPos[0], aPos[1] );
        },
        "submitdata": function ( value, settings ) {
            return {
                //"row_id": this.parentNode.getAttribute('id'),
				"row_id": $('#'+elementId+' #grid'+ ' #id')
                "column": oTable.fnGetPosition( this )[2]
            };
        },
        "height": "14px",
        "width": "100%"
    } );
	
});