<?php
  require_once('../globals.php');
  unset($_SESSION['status']);
  unset($_SESSION['status-msg']);
  $_SESSION[] = array();
  session_destroy();
  resultsHandler (FALSE, "Logged out", 'login', 'success');
?>
