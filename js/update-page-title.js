function updatePageTitle (newtitle) {
	$(document).ready(function() {
		var oldtitle = $(document).attr('title');
		$(document).prop('title', oldtitle + ': ' + newtitle);
	});
}
