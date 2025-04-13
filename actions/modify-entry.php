<?php
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  if (!isset($_POST['entry']))
		resultsHandler (FALSE, "Missing entry to modify listing", 'main', 'fail');

  // Replace if date changed 
  $olddate = date("Y-m-d", (int) $_POST['entry']);
  $newdate = date("Y-m-d", strtotime($_POST['date'])) ?? "";
  $confirmed = isset($_POST['confirmed']) ? "1" : "0";

  $conn = dbConnect();
  $sql = 'UPDATE `liam-live` SET gigdate="'. $newdate .'",location="'. $_POST['location'] .'",venue="'. $_POST['venue'] .'",`venue-link`="'. $_POST['venue_link'] .'",guests="'. $_POST['guests'] .'",confirmed="'. $confirmed .'" WHERE gigdate="'. $olddate .'" LIMIT 1';
  try {
		$update = $conn->query($sql);
		$rows_updated = $conn->affected_rows;
	} catch (Exception $e) {
		resultsHandler ($conn, "Entry update failed.<br>" . $e->getMessage(), 'main', 'fail');
	}

  if ($rows_updated > 1)
		resultsHandler ($conn, "Multiple listings updated", 'main', 'info');
	elseif ($rows_updated == 1)
		resultsHandler ($conn, "Listing updated", 'main', 'success');
	elseif ($rows_updated == 0)
		resultsHandler ($conn, "Listing was not changed", 'main', 'info');
  else
		resultsHandler ($conn, "Database update for listing failed", 'main', 'fail');
?>
