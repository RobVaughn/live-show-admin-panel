<?php
  require_once('db-connector.php');
  require_once('../globals.php');

  unset($_SESSION['status-msg']);

  $conn = dbConnect();
  if (isset($_GET['entry'])) {
    $date = date("Y-m-d", (int) $_GET['entry']);
    $sql = 'SELECT confirmed FROM `liam-live` WHERE gigdate="' . $date .'"';
		try {
			$confirmed_date = $conn->query($sql);
		} catch (Exception $e) {
			resultsHandler ($conn, "Entry lookup failed.<br>" . $e->getMessage(), 'main', 'fail');
		}

    if ($confirmed_date->num_rows > 0) {
      $row = $confirmed_date->fetch_assoc();
      if ($row['confirmed'] === "1") $confirm = "0";
      else $confirm = "1";
      $sql = 'UPDATE `liam-live` SET confirmed="'. $confirm .'" WHERE gigdate="' . $date .'"';
			try {
				$update = $conn->query($sql);
			} catch (Exception $e) {
				resultsHandler ($conn, "Confirm switch failed.<br>" . $e->getMessage(), 'main', 'fail');
			}
    }
  }
  $conn->close();
  echo json_encode(array('success' => true));
?>
