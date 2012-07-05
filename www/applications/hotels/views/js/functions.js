function setError(obj) {
	$(obj).removeClass("successinput");
	$(obj).addClass("errorinput");
}
	
function setSuccess(obj) {
	$(obj).removeClass("errorinput");
	$(obj).addClass("successinput");
}

function cleanAll(obj) {
	$(obj).removeClass("errorinput");
	$(obj).removeClass("successinput");
}

function testType(type, obj) {
	
	var filter;
	var testResult;
	
	if(type == "url") {
		filter = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	} else {
		filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
	}
	
	return testResult = filter.test(obj);
	
}
