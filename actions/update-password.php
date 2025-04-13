<?php
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  $user = isset($_POST['username']) ? $_POST['username'] : "admin";
  $old_pw = isset($_POST['old-password']) ? $_POST['old-password'] : "error";
  $new_pw = isset($_POST['password1']) ? password_hash($_POST['password1'], PASSWORD_DEFAULT) : "error";

  if (($old_pw === "error") || ($new_pw === "error"))
		resultsHandler (FALSE, "Invalid password", "change-password", "fail");

  $conn = dbConnect();
	$sql = 'SELECT pw FROM `passwords` WHERE user="'. $user .'"';
	echo "<pre>sql=" . $sql . "</pre>";
	try {
		$user_entries = $conn->query($sql);
	} catch (Exception $e) {
		resultsHandler ($conn, $e->getMessage(), 'change-password', 'fail');
	}

	if ($user_entries->num_rows < 1)
		resultsHandler ($conn, "Account not found", 'change-password', 'fail');
		
	try {
		$pw = $user_entries->fetch_assoc()['pw'];
	} catch (Exception $e) {
		resultsHandler ($conn, $e->getMessage(), 'change-password', 'fail');
	}

  if (!password_verify ($old_pw, $pw))
		resultsHandler ($conn, "old pw=". $old_pw .", pw=". $pw ."<br>Password does not match", 'change-password', 'fail');

	$sql = 'UPDATE `passwords` SET pw="'. $new_pw .'" WHERE user="'. $user .'"';
	try {
		$update = $conn->query($sql);
	} catch (Exception $e) {
		resultsHandler ($conn, "Password not updated.<br>" . $e->getMessage(), 'change-password', 'fail');
	}

	resultsHandler ($conn, "Password changed.", 'main', 'success');
?>
