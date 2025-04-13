<?php
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  if (!isset($_POST['entry'])) 
		resultsHandler (FALSE, "Missing entry to delete listing", "main", "fail");

  $date = date("Y-m-d", (int) $_POST['entry']);
  $conn = dbConnect();
  $sql = 'DELETE FROM `liam-live` WHERE gigdate="'. $date .'"';
  try {
    $delete = $conn->query($sql);
    $rows_deleted = $conn->affected_rows;
	} catch (Exception $e) {
		resultsHandler ($conn, "Database error for delete", "main", "fail");
	}

  if ($rows_deleted > 1)
		resultsHandler ($conn, "Deleted ". $rows_deleted ." entries", "main", "info");
	elseif ($rows_deleted == 1)
		resultsHandler ($conn, "Deleted entry", "main", "success");
	else
		resultsHandler ($conn, "Failed to delete entry", "main", "fail");
?>
