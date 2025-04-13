// Must load AFTER 'button.js'

includeJavaScript ('enablePasswordButton', 'button.js');

var old_pw = $("#oldPassword");
var pw1 = $("#inputPassword1");
var pw2 = $("#inputPassword2");
var enable1 = false;
var enable2 = true;

// Enable password field(s) after captcha completed successfully
function enablePasswordField() {
  $(".h-captcha-msg").removeClass("h-captcha-msg");
  $("#captcha").remove();
  pw1.attr("placeholder", "Password");
  pw1.prop("disabled", false);
  if (pw2) {
    pw2.attr("placeholder", "Confirm Password");
    pw2.prop("disabled", false);
  }
  setTimeout(function() {
		if (old_pw.length) old_pw.focus();
    else pw1.focus();
  }, 200);
  return true;
}

// Returns a maximum of 6 points
function testStrength (password) {
  let points = 0;
  let value = password.val();

  if (password.length >= 8) points++;
  printLog("Testing: " + value);
  let arrayTest = [/^\S+$/, /[0-9]/, /[a-z]/, /[A-Z]/, /[^0-9a-zA-Z]/];
  arrayTest.forEach((item) => {
    if (item.test(value)) points++;
  });
  // If confirm pw field exists, subtract a point if they don't match
	if (pw2.length)
		if (pw1.val() != pw2.val()) points--;
  printLog("Password strength: " + points.toString());
  return(points);
}
  
// Test password strength
pw1.add(pw2).on("propertychange change keyup paste input", function() {
  let bar = $("#strength-bar");
  let widthPower = ["1%", "10%", "25%", "50%", "75%", "100%"];
  let colorPower =  ["#c72F30", "#D73F40", "#DC6551", "#F2B84F", "#BDE952", "#3ba62f"];
  let points = testStrength(pw1);
  printLog("points=" + points.toString());
  bar.width(widthPower[points]);
  bar.css("background-color", colorPower[points]);
  if (points > 4) enable1 = true;
	else enable1 = false;
});

// If there's a confirm password field
if (pw2.length) {
  printLog("pw2=" + pw2.val());
  pw2.on("propertychange change keyup paste input", function() {
    if (pw1.val() === pw2.val()) enable2 = true;
		else enable2 = false;
  });
}

// Enable submit button when tests pass
$(document).on('keyup', [pw1, pw2], function() {
	printLog("enable1=" + enable1 + ", enable2=" + enable2);
  if (enable1 && enable2) enablePasswordButton();
  else disablePasswordButton();
});
