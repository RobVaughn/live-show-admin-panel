<?php
  require_once('db-connector.php');

  function getSecret() {
		$conn = dbConnect();
		$sql = 'SELECT pw FROM `passwords` WHERE user="hcaptcha"';
		try {
			$secret = $conn->query($sql);
		} catch (Exception $e) {
			resultsHandler ($conn, "Unable to retrieve h-Captcha settings", "main", "fail");
		}
		$conn->close();
		return (array('secret' => $secret));
	}
?>
