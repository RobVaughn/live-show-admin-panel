<?php
  error_reporting(E_ALL);
  $GLOBAL_DEBUG = FALSE;
  $GLOBAL_RESET_TIME = 20;
  $GLOBAL_MANDATORY_FIELDS = array('entry', 'date', 'location', 'venue', 'confirmed');
  function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
    echo "<script>console.log('$msg');</script>";
  }

  if (session_status() === PHP_SESSION_NONE) {
    $cookie_lifetime = 60*60*24*180; // 180 days
    ini_set('session.gc_maxlifetime', $cookie_lifetime);
    session_set_cookie_params(time() + $cookie_lifetime);
    //session_set_cookie_params(0);
	}
  session_start();
  //setcookie(session_name(), session_id(), time() + $cookie_lifetime);

  function execJS($func, $vars = array()) {
    $count = 0;
    $args = "";
  	foreach ($vars as $var) {
      if ($count > 0) $args .= ", ";
      $args .= $var;
      $count++;
		}
		$exec = $func ."('". $args ."');";
		echo "<script type='text/javascript'>". $exec ."</script>";
  }

  function resultsHandler ($conn = FALSE, $msg = "Unknown error.", $func = "main", $results = "fail") {
		if ($conn) $conn->close();
    $_SESSION['status-msg'] = $msg . ".";
		header("Location: /admin/admin.php?func=". $func . "&results=" . $results);
    exit;
  }
?>
