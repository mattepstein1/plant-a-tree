<?php
  // Placing at the top of the page to suppress any warnings
  session_start();

  function locationGiven() {
    return isset($_GET['location']) && $_GET['location'] != '';
  }

  function locationValid() {
    return strpos($_GET['location'], 'http') === false
      && strpos($_GET['location'], 'www') === false;
      # For the top level domain.
      # FIXME && preg_match('\\.\w{,24}/', $_GET['location']) == false;
  }

	if(isset($_POST['login'])) {
		$errMsg = '';

		// Get data from FORM
		$username = $_POST['username'];
		$password = $_POST['password'];

		if($username == '') {
			$errMsg = 'Enter username';
    } else if($password == '') {
			$errMsg = 'Enter password';
    }

		if($errMsg == '') {
      // Get all users from the JSON data to search for this user
      $string = file_get_contents("../data/accounts.json");
      if ($string == false) {
        $errMsg = "User $username not found. Would you like to <a href=\"register.php\">register</a>?";
      }
      else {
        $json_array = json_decode($string, true);
        if ($json_array === null) {
          $errMsg = "Failed to read data. Please try again.";
        }

        $match = false;
        $valid = false;
        foreach ($json_array as $i => $value) {
          if ($json_array[$i]['username'] == $username) {
            $match = true;
            if ($json_array[$i]['password'] == $password) {
              $valid = true;
              $_SESSION['username'] = $json_array[$i]['username'];
              $_SESSION['first-name'] = $json_array[$i]['first-name'];
              $_SESSION['email'] = $json_array[$i]['email'];
              $_SESSION['post-address'] = $json_array[$i]['post-address'];
              $_SESSION['delivery-address'] = $json_array[$i]['delivery-address'];
              break;
            }
          }
        }

        if ($match && $valid) {
          if (locationGiven() && locationValid()) {
            header('Location: ' . $_GET['location']);
          } else {
            header('Location: /');
          }
        }
        elseif ($match && !$valid) {
              # Error message should be 'Either the username or password is incorrect.' everywhere.
              $errMsg = "$username, the password you entered is incorrect.";
        }
        else {
          $errMsg = "User $username not found. Would you like to <a href=\"register.php\">register</a>?";
        }
      }
		}
	}
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Login | Plant A Tree</title>

  <!-- Bootstrap core CSS -->
  <link href="/gulped_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="/gulped_modules/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Agency theme core CSS -->
  <link href="/css/agency.css" rel="stylesheet">
</head>
<body id="page-top">
  <nav class="navbar navbar-expand-lg navbar fixed-top" id="mainNav">
      <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="/index.html">Tree Store</a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              Menu
              <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav text-uppercase ml-auto">
                  <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="/index.html">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="/shop.html">Products</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="/cart.html">Cart</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/storelocations.html">Store Locations</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>

  <div align="center">
    

    <?php
      if (isset($_SESSION['username'])) {
    ?>
      <h1><b>Logout</b></h1>
      <div class="container" style="margin: 15px">
        <h3>Hello, <?php echo $_SESSION['username']; ?></h3>
        <button class="btn btn-outline-warning" onclick="window.location = '<?php echo "logout.php?location=" . $_GET['location'] ?>';"><h1><b>Logout</b></h1></a>
      </div>
    <?php
      } else {
    ?>
      <h1><b>Login</b></h1>
      <div style="margin: 15px">
        <form method="post">
          <input type="text" class="form-control" name="username" placeholder="Username"/>
          <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off"/>
          <input class="form-control" type="submit" name="login" value="Login" class='submit'/>
        </form>
      </div>
      <?php
        if(isset($errMsg)){
          echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
        }
      ?>
      <p>Not a member? <a href="register.php">Register now!</a></p>
    <?php
      }
    ?>
  </div>

  <script src="/gulped_modules/jquery/jquery.min.js"></script>
  <script src="/gulped_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Plugin JavaScript -->
  <script src="/gulped_modules/jquery-easing/jquery.easing.min.js"></script>
  <!-- Contact form JavaScript -->
  <script src="/js/jqBootstrapValidation.js"></script>
  <script src="/js/contact_me.js"></script>
  <!-- Custom scripts for this template -->
  <script src="/js/agency.min.js"></script>
</body>
</html>

