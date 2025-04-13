<?php // Stores a password hash + timestamp in db, sends email with link
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  $user = isset($_POST['username']) ? $_POST['username'] : "admin";
  $pw = isset($_POST['password1']) ? password_hash($_POST['password1'], PASSWORD_DEFAULT) : "error";
  $email_address = "error";

  if ($pw === "error")
	  resultsHandler (FALSE, "Invalid password", 'forgot-password', 'fail');

  require_once('logout.php');
  $conn = dbConnect();
  $sql = 'SELECT email FROM `passwords` WHERE user="'. $user .'"';
  try {
		$user_entries = $conn->query($sql);
	} catch (Exception $e) {
	  resultsHandler ($conn, "Cannot retrieve email address for account<br>". $e->getMessage(), 'forgot-password', 'fail');
	}

  if ($user_entries->num_rows > 0) {
		$row = $user_entries->fetch_assoc();
		$email_address = $row['email'];
		$sql = 'UPDATE `passwords` SET reset_hash="'. $pw .'",timestamp="'. date("Y-m-d H:i:s"). '" WHERE user="'. $user .'"';
		try {
      $update = $conn->query($sql);
		} catch (Exception $e) {
			resultsHandler ($conn, "Cannot update database with new password<br>". $e->getMessage(), 'forgot-password', 'fail');
		}

		// To send HTML mail, the Content-type header must be set
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "To: ". $user ." <" . $email_address . ">\r\n";
		$headers .= "From: The Sound-O-Mat <info@sound-o-mat.com>\r\n";
		$headers .= "Reply-To: info@sound-o-mat.com\r\n";
		$headers .= "Bcc: Rob V. <RobVaughn@gmail.com>\r\n";
		$subject = "Admin Panel Password Reset";
		$link = '<a href="https://' . $_SERVER['HTTP_HOST'] . '/admin/admin.php?func=reset-password&user=${user}&hash='. $pw . 'Reset Password</a>';
		$message = $subject. "\r\n\r\nReset the password by clicking the following link:\r\n";
		$message .= $link . "\r\n\r\nThis link will expire in " . $GLOBAL_RESET_TIME . " minutes.\r\n";
		$mailed = mail($email_address, $subject, $message, $headers);
		if ((!$mailed) && $DEBUG)
			alert("link:" . $link); $email_address .= ",headers:" . $headers;
		else
			resultsHandler ($conn, "Reset email failed to send", 'forgot-password', 'fail');
	} // get email

  if ($DEBUG) $debug_info = ".<br>user:" . $user . ",pw:" . $pw . ",email:" . $email_address;
  else $debug_info = "";
  resultsHandler ($conn, "Email sent" . $debug_info, 'main', 'success');
?>
