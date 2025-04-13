<?php
  require_once('../globals.php');
  require_once('db-connector.php');

  unset($_SESSION['status-msg']);

  $separator = (!isset($_POST['separator'])) ? trim($_POST['separator']) : ",";
  $error = $_FILES['import-file']['error'];
  $filename = $_FILES['import-file']['name'];
  $folder = "/tmp/";
  move_uploaded_file ($_FILES['import-file']['tmp_name'], $folder . $filename);
  $file = $folder . $filename ;

  $errors = array();
  if (empty($file)) $errors[] = "File is empty.<br>";
  if ($error == 2) $errors[] = "File too large.<br>";
  if ($error > 0) $errors[] = "Issue with uploading.<br>";
  if (!empty ($errors))
		resultsHandler (FALSE, implode(' ', $errors) . 'File "'. $file .'" cannot be imported.', 'main', 'fail');

  $conn = dbConnect();
  ini_set('auto_detect_line_endings',TRUE);
  if (($input = fopen($file, 'r')) === FALSE)
		resultsHandler ($conn, "Cannot open ". $filename . " to import", 'main', 'fail');
		
  $count = 0;
  while (($line = fgets($input)) != FALSE) {
		$line = substr (trim($line), 1, -1);
		$row = explode ("'". $separator ."'", $line);
		//$row = array_map('trim', $row);
    $sql = "INSERT INTO `liam-live` (`gigdate`, `location`, `venue`, `venue-link`, `guests`, `confirmed`) VALUES ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]')";
		$count++;
		try {
      $insert = $conn->query($sql);
    } catch (Exception $e) {
			resultsHandler ($conn, "Failed: ". $sql ."<br>". $e->getMessage(), 'main', 'fail');
		}
	}

  fclose($input);
  resultsHandler ($conn, "Imported ". $count ." rows successfully", 'main', 'success');
?>
