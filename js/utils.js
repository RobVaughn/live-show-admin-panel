/* Utility functions */

var DEBUG = false;
function printLog(s) {
	if (DEBUG) {
		if (typeof(s) === 'object') console.log( JSON.stringify(s) );
    else console.log(s);
	}
}

function includeJavaScript (requiredFunc, file) {
	if (typeof requiredFunc == "undefined")
		document.write('<script type="text/javascript" src="js/' + file + '"></scr' + 'ipt>'); 
}
	
