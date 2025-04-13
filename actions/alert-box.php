<?php
  if (!isset($_POST['results']) && (!isset($_GET['results']))) return false;
  if (!isset($_SESSION['status-msg'])) return false;
  $alert_type = ($_GET['results']) ?? ($_POST['results']) ?? "danger";
  switch ($alert_type) {
	  case "fail":
		  $alert_type = "danger";
      break;
    case "success":
      $alert_type = "success";
      break;
    case "info":
      $alert_type = "info";
      break;
    default:
      $alert_type = "warning";
  }
  $data_timeout = ($alert_type === "danger") ? "0" : "5000";
  $alert_title = ($alert_type === "danger") ? "Unknown Error" : ucfirst($alert_type);
  $alert_msg = $_SESSION['status-msg'] ?? "An unknown error has occurred.";
  unset($_SESSION['status-msg']);
?>
    <div id="results-alert" class="results alert alert-<?php echo $alert_type; ?> alert-dismissible fade show" data-timeout="<?php echo $data_timeout; ?>" role="alert">
      <h4 class="alert-heading"><?php echo $alert_title; ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"></span>
      </button><br>
      <span><?php echo $alert_msg; ?></span>
    </div>
