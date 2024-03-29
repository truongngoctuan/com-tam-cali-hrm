/**
 * Author: Thilina Hasantha
 */


/**
 * SettingAdapter
 */

function SettingAdapter(endPoint) {
	this.initAdapter(endPoint);
}

SettingAdapter.inherits(AdapterBase);



SettingAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "value",
	        "description"
	];
});

SettingAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Value"},
			{ "sTitle": "Details"}
	];
});

SettingAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "value", {"label":"Value","type":"text","validation":"none"}]
	];
});

SettingAdapter.method('getActionButtonsHtml', function(id,data) {
	var html = '<div style="width:80px;"><img class="tableActionButton" src="_BASE_images/edit.png" style="cursor:pointer;" rel="tooltip" title="Edit" onclick="modJs.edit(_id_);return false;"></img></div>';
	html = html.replace(/_id_/g,id);
	html = html.replace(/_BASE_/g,this.baseUrl);
	return html;
});
