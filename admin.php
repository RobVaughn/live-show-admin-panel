<?php require_once('globals.php'); ?>
<!DOCTYPE html>
<html>
<?php readfile('../header.html'); ?>
  <meta name="description" content="Liam Grant Admin Panel">
  <meta name="robots" content="noindex">
  <title>Liam Grant Admin Panel</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type='text/javascript' src='js/update-page-title.js'></script>
</head>
<body class="sidebar-mini">
<?php
  $main = "login.html";
  $func = (isset($_GET['func'])) ? $_GET['func'] : ((isset($_SESSION['func'])) ? $_SESSION['func'] : "");
  $logged = false;
  if (isset($_SESSION['status'])) $logged = true;

  // Functions that do not require login
  switch ($func) {
    case 'login':
      execJS("updatePageTitle", ["Login"]);
      $main = "login.html";
      break;
    case 'forgot-password':
      execJS("updatePageTitle", ["Forgot Password"]);
      $main = "forgot-password.html";
      break;
    case 'change-password':
      execJS("updatePageTitle", ["Change Password"]);
      $main = "change-password.html";
      break;
    case 'reset-password':
      execJS("updatePageTitle", ["Reset Password"]);
      $main = "reset-password.html";
      break;
    case '':
    case 'main':
      if ($logged) {
        $main = "main.html";
        execJS("updatePageTitle", ["Main"]);
      } else {
        execJS("updatePageTitle", ["Login"]);
        $main = "login.html";
      }
      break;
  }
  // Modules that require login
  if ($logged) {
    switch ($func) {
			case "download":
      case "main":
        execJS("updatePageTitle", ["Main"]);
        $main = "main.html";
        break;
      case "add":
        execJS("updatePageTitle", ["Add"]);
        $main = "add.html";
        break;
      case "modify":
        execJS("updatePageTitle", ["Modify"]);
        $main = "modify.html";
        break;
      case "delete-all":
        execJS("updatePageTitle", ["Delete Range"]);
        $main = "delete-all.html";
        break;
      case "delete":
        execJS("updatePageTitle", ["Delete"]);
        $main = "delete.html";
        break;
      case "export":
        execJS("updatePageTitle", ["Export"]);
        $main = "export.html";
        break;
      case "import":
        execJS("updatePageTitle", ["Import"]);
        $main = "import.html";
        break;
      case "replace-all":
        execJS("updatePageTitle", ["Replace"]);
        $main = "replace-all.html";
        break;
    }
  }
?>

  <section data-bs-version="5.1" class="cid-admin cid-live" id="admin">
    <iframe class="download-frame"></iframe>
    <div class="wrapper">
      <div class="main-header bg-grey-light justify-content-center">
        <h2>Admin Panel</h2>
      </div>
      <main class="app-main">
      <?php require_once('apps/' . $main); ?>
      </main>
      <?php require_once('sidebar-menu.php'); ?>
    </div>
    <?php require_once('actions/alert-box.php'); ?>
  </section>
      
<?php // Load JS files as needed vs. always
  readfile('../footer.html');
  echo "<script type='text/javascript' src='js/utils.js'></script>";
  echo "<script type='text/javascript' src='js/alerts.js'></script>";
  switch ($func) {
    case '':
    case 'login':
    case 'forgot-password':
    case 'change-password':
      echo "<script type='text/javascript' src='../assets/hcaptcha/js/hcaptcha.js'></script>";
      echo "<script type='text/javascript' src='https://js.hcaptcha.com/1/api.js' async defer></script>";
      echo "<script type='text/javascript' src='js/button.js'></script>";
      echo "<script type='text/javascript' src='js/password.js'></script>";
      break;
	  case 'download':
      echo "<script type='text/javascript' src='js/export.js'></script>";
    case 'add':
    case 'modify':
      echo "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js'></script>";
      echo "<script type='text/javascript' src='js/required-fields.js'></script>";
	  case 'import':
	  case 'replace-all':
      echo "<script type='text/javascript' src='js/required-file.js'></script>";
    case 'main':
    case 'add':
    case 'modify':
    case 'delete':
    case 'import':
	  case 'replace-all':
	  case 'delete-all':
      echo "<script type='text/javascript' src='js/button.js'></script>";
      echo "<script type='text/javascript' src='js/slider.js'></script>";
      break;
  } // switch

  // Clear up settings, etc. incase of reload or back buttons
  $func = "main";
  unset($_SESSION['status-msg']);
?>
</body>
</html>
