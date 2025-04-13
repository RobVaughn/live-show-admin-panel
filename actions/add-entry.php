<?php
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  $gigdate = date("Y-m-d", strtotime($_POST['date'])) ?? "";
  $confirmed = isset ($_POST['confirmed']) ? "1" : "0";
  $row = array_map('trim', $_POST);

  $conn = dbConnect();
  $sql = "INSERT INTO `liam-live` (`gigdate`, `location`, `venue`, `venue-link`, `guests`, `confirmed`) VALUES ('$gigdate', '". $row['location'] ."','". $row['venue'] ."','". $row['venue_link'] ."','". $row['guests'] ."','". $confirmed ."')";
	try {
		$insert = $conn->query($sql);
	} catch (Exception $e) {
		resultsHandler ($conn, "Password not updated.<br>" . $e->getMessage(), 'change-password', 'fail');
	}

  if ($insert)
		resultsHandler ($conn, "New listing added", 'main', 'success');
  else
		resultsHandler ($conn, "Cannot add New listing", 'main', 'fail');
?>
