$(".upload-form").submit(function(e) {
  if ($('#uploadFile').val().length < 2) {
		e.preventDefault();
		return false;
	}
	return true;
});	
