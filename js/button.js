// Must load BEFORE 'password.js'

function enablePasswordButton() {
	$('.password-button').prop("disabled", false);
	$('.password-button').removeClass("red-button").addClass("green-button");
	$('.password-button').css("text-decoration", "none");
}

function disablePasswordButton() {
	$('.password-button').prop("disabled", true);
	$('.password-button').removeClass("green-button").addClass("red-button");
	$('.password-button').css("text-decoration", "line-through");
}

function disableConfirmButton() {
  $(".confirm-button").prop("disabled", true);
	$('.confirm-button').css("text-decoration", "line-through");
  return true;
}

function enableConfirmButton() {
  $(".confirm-button").prop("disabled", false);
	$('.confirm-button').css("text-decoration", "none");
  return true;
}

function setButton (state) {
	alert("set button");
  if (checkRequiredFields() && state != "disabled") enableConfirmButton();
	else disableConfirmButton();
}
