function setSlider(id) {
	printLog('set ' +id);
	$(id).val("checked");
	$(id).attr("checked", true);
	//$(id).attr("checked", "checked");
  $(id).prop("checked", true);
}

function unsetSlider(id) {
	printLog('unset ' + id);
	$(id).val("");
	$(id).removeAttr("checked");
	$(id).prop("checked", false);
}

function switchSlider(id) {
  id = "#" + id;
	printLog('id=' + id);
	printLog("prop=" + $(id).prop("checked"));
  if ($(id).attr("checked")) {
		printLog('checked > unchecked');
		unsetSlider(id);
	} else {
		printLog('unchecked > checked');
		setSlider(id);
	}
}

function toggleSlider (id, entry) {
  $.ajax({
    'url': 'actions/toggle-confirmed.php', 
    'type': 'GET',
    'dataType': 'json', 
    'cache': false,
    'data': {entry: entry},
    'success': function(data) {
		},
    'error': function(data) {
      alert("toggle failed");
    }
  });
	switchSlider(id);
}

// Tie toggle to submit button to activate.

var confirm_forms = ["delete-entry", "import-listings", "replace-all", "delete-all"];
$(document).ready(function() {
  printLog("onReady name=" + $('form').attr('name'));
  if (confirm_forms.indexOf($('form').attr('name')) > -1) disableConfirmButton();
});

$("#confirm-slider").on("change", function() {
	if (confirm_forms.indexOf($('form').attr('name')) > -1) {
		printLog("onChange name=" + $('form').attr('name'));
		if ($('#confirm-slider').prop("checked")) enableConfirmButton();
		else disableConfirmButton();
	}
});
