<?php
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  $start_date = isset($_POST['start-date']) ? date("Y-m-d", strtotime($_POST['start-date'])) : date("Y-m-d", 0);
  $end_date = isset($_POST['end-date']) ? date("Y-m-d", strtotime($_POST['end-date'])) : "2099-12-31";

  $conn = dbConnect();
  $sql = 'DELETE FROM `liam-live` WHERE gigdate >= "'. $start_date .'" AND gigdate <= "'. $end_date .'"';
  try {
		$delete = $conn->query($sql);
	} catch (Exception $e) {
		resultsHandler ($conn, "Failed: ". $sql ."<br>". $e->getMessage(), 'main', 'fail');
	}

  if (!$delete)
		resultsHandler ($conn, "Failed to delete listings", 'main', 'fail');

  $rows_deleted = $conn->affected_rows;
  if ($rows_deleted == 0)
		resultsHandler ($conn, $rows_deleted . " rows deleted", 'main', 'info');
  else
		resultsHandler ($conn, $rows_deleted . " rows deleted.", 'main', 'success');
?>
