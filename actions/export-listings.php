<?php
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  $export_file = "listings.csv";
  $quote = "";
  $separator = isset($_POST['separator']) ? "'" . trim($_POST['separator']) . "'" : "','";
  $start_date = isset($_POST['start-date']) ? date("Y-m-d", strtotime($_POST['start-date'])) : date("Y-m-d", 0);
  $end_date = isset($_POST['end-date']) ? date("Y-m-d", strtotime($_POST['end-date'])) : "2099-12-31";

  $conn = dbConnect();
  $sql = 'SELECT gigdate,location,venue,`venue-link`,guests,confirmed FROM `liam-live` WHERE gigdate >= "'. $start_date .'" AND gigdate <= "'. $end_date .'"';
  try {
		$export = $conn->query($sql);
	} catch (Exception $e) {
		resultsHandler ($conn, "Listings cannot be retrieved from database.<br>" . $e->getMessage(), 'main', 'fail');
	}

  $count = 0;
  $output = fopen($export_file, 'w');
  while ($row = $export->fetch_assoc()) {
    $count++;
    $line = "'" . implode($separator, $row) . "'\r\n";
		fwrite($output, $line);
  }
  fclose($output);
	resultsHandler ($conn, $count . " listings exported", 'download', 'success');
?>
