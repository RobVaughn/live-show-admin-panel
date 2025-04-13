$(document).ready(function () {
	let alertNode = $(".alert");
	let alert_timeout = alertNode.attr('data-timeout');
	printLog("results-alert=" + alertNode + ", timeout=" + alert_timeout);
	if (alert_timeout > 0) {
		let alert = bootstrap.Alert.getInstance(alertNode);
		setTimeout(() => {
			$(".alert").slideUp(500); }, (alert_timeout * 0.75));
		setTimeout(() => {
			$('.alert').alert('close'); }, alert_timeout);
	}
});
