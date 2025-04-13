<?php
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  $user = $_POST['username'] ?? "admin";
  if (!isset($_POST['inputPassword1']) && !isset($_GET['inputPassword1']))
		resultsHandler (FALSE, "Password missing", 'main', 'fail');

  $conn = dbConnect();
  $sql = 'SELECT pw FROM `passwords` WHERE user="' . $user . '"';
  try {
		$pw_entry = $conn->query($sql);
	} catch (Exception $e) {
		resultsHandler ($conn, "Cannot retrieve password from database.<br>" . $e->getMessage(), 'main', 'fail');
	}

  if ($pw_entry->num_rows < 1)
		resultsHandler ($conn, "Database error retrieving password", 'main', 'fail');
  $row = $pw_entry->fetch_assoc();
  if (password_verify($_POST['inputPassword1'], $row['pw'])) {
		$_SESSION['user'] = $user;
		$_SESSION['status'] = "logged";
	} else {
		resultsHandler ($conn, "Incorrect password. Access denied", 'main', 'fail');
	}

  resultsHandler ($conn, "Login successful", 'main', 'success');
?>
