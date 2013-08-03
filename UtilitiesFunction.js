function debugging(obj){
	if(console && console.log) { console.log(obj); }	
}
function debugging(str, obj){
	if(console && console.log) { 
		//console.log(str + ": ");
		//console.log(obj); 
		console.log(str + ": " + JSON.stringify(obj, null, 4));}	
}
