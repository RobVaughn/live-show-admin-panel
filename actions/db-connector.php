<?php
  function dbConnect() {
    $servername = "localhost";
    $username = "austsadx_sound-o-mat";
    $password = "_8gL5KG7EpNqRRq";
    $db = "austsadx_sound-o-mat";

    // Create connection
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    return($conn);
  }
?>
