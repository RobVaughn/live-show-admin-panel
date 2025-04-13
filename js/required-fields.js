// Requires jquery-form-validation.js via CDN

function checkRequiredFields() {
	$.validator.addMethod("location", function(value, element) {
		return this.optional(element) || /^[A-Za-z]+(?:[ -][A-Za-z]+)*(?:, (?:[A-Za-z]+(?:[ -][A-Za-z]+)*|[A-Z]{2}))(?:, [A-Za-z]+(?:[ -][A-Za-z]+)*)?$/.test(value);
	}, "Location must be common CITY, STATE [COUNTRY] format.");

	$("#listings-form").validate({
		//debug: true,
		ignore: ":hidden",
		rules: {
			date: "required",
			location: {
				required: true,
				location: true,
				minlength: 6
			},
			venue: {
				required: true,
				minlength: 4
			}
		},
		// Specify validation error messages
		messages: {
			date: "Date must follow a standard format like YYYY-MM-DD or MM/DD/YYYY.",
			location: {
				required: "Location should be city and state like CITY, ST.",
				minlength: "Location must be 8 characters or longer."
			},
			venue: {
				required: "Please enter the venue name.",
				minlength: "Venue name must be 4 characters or longer."
			}
		},
		submitHandler: function (form) {
			form.submit();
		},
		// Error handling
		errorPlacement: function(error, element) {
			error.appendTo(element.parent().find(".error-msg"));
			element.find(".error-card").show();
			
		},
		errorLabelContainer: ".error-msg",
		errorElement: "span",
		highlight: function(element, errorClass) {
			$(element).addClass("form-error");
			$(element).attr("placeholder", "Required");
			$(".error-card").show();
    }
	});
}
