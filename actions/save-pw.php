<?php
  require_once('db-connector.php');
  require_once('../globals.php');

  unset($_SESSION['status-msg']);

  $conn = dbConnect();
  $user = isset($_POST['user']) ? $_POST['user'] : "";
  $sql = 'SELECT reset_hash,timestamp FROM `passwords` WHERE user="${user}"';

  try {
		$user_entries = $conn->query($sql);
	} catch (Exception $e) {
		resultsHandler ($conn, "Password lookup failed.<br>" . $e->getMessage(), 'main', 'fail');
	}

  if ($user_entries->num_rows < 1)
		resultsHandler ($conn, "Password update failed" . $e->getMessage(), 'main', 'fail');
  $row = $user_entries->fetch_assoc();
  if (strtotime($row['timestamp']) + (60 * (int) $GLOBAL_RESET_TIME < time())) {
		$sql = 'UPDATE `passwords` SET pw="'. $row['reset_hash'] .'" WHERE user="${user}"';
		try {
			$update = $conn->query($sql);
		} catch (Exception $e) {
			resultsHandler ($conn, "Database update failed.<br>" . $e->getMessage(), 'main', 'fail');
		}

		if (!$update)
			resultsHandler ($conn, "Password update failed", 'main', 'fail');
	}

  $_SESSION['user'] = $user;
	$_SESSION['hash'] = $pw;
	resultsHandler ($conn, "Password updated", 'main', 'success');
?>
