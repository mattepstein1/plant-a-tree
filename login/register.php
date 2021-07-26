<?php
	if(isset($_POST['register'])) {
    $errMsg = '';

    // Get data from FROM
    $firstname = $_POST['first-name'];
    $lastname = $_POST['last-name'];
    $postaddress = $_POST['post-address'];
    $deliveryaddress = $_POST['delivery-address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($email == '')
      $errMsg = 'Enter email';
    if($username == '')
      $errMsg = 'Enter username';
    if($password == '')
      $errMsg = 'Enter password';

    if($errMsg == '') {
      $string = file_get_contents('../data/accounts.json');
      if ($string == false) {
        $errMsg = "Hey, you're our first account!";
      }

      $json_array = json_decode($string, true);
      if ($json_array == null) {
        $errMsg = 'Something went wrong. Please try again.';
      }

      $found = false;
      foreach ($json_array as $i => $value) {
        if ($username == $value['username']) {
          $errMsg = 'Username already taken. Did you want to <a href="/login/login.php">login</a>?';
          $found = true;
          break;
        }
        elseif ($email == $value['email']) {
          $errMsg = 'An account already exists under that email.';
          $found = true;
          break;
        }
      }

      if (!$found) {
        $account = array(
          'username' => $username,
          'password' => $password,
          'first-name' => $firstname,
          'last-name' => $lastname,
          'email' => $email,
          'post-address' => $postaddress,
          'delivery-address' => $deliveryaddress,
          'phone' => $phone
        );

        array_push($json_array, $account);
        $encoded_json = json_encode($json_array);
        file_put_contents('../data/accounts.json', $encoded_json);

        header('Location: register.php?action=joined');
      }
    }
  }

	if (isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = 'Registration successfull. Now you can <a href="/login/login.php">login</a>';
	}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Register | Plant A Tree</title>

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
<body>
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
                      <a class="nav-link js-scroll-trigger" href="/login/login.php">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/storelocations.html">Store Locations</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
  <h1>Register</h1> <!-- TODO FIXME Navigation bar hides this header -->
  <div class="container">
		<div style=" border: solid 1px #006D9C; " align="left">
			<div style="margin: 15px">
				<form method="post">
          <!-- Echoing the value so that the boxes are auto-filled in-case there is an error -->
        <input class="form-control" type="text" name="first-name" value="<?php if (isset($_POST['first-name'])) { echo $_POST['first-name']; } ?>" placeholder="First Name"/><br /><br />
					<input class="form-control" type="text" name="last-name" value="<?php if (isset($_POST['last-name'])) { echo $_POST['last-name']; } ?>" placeholder="Last Name"/><br /><br />
					<input class="form-control" type="text" name="post-address" value="<?php if (isset($_POST['post-address'])) { echo $_POST['post-address']; } ?>" placeholder="Postal Address"/><br /><br />
					<input class="form-control" type="text" name="delivery-address" value="<?php if (isset($_POST['delivery-address'])) { echo  $_POST['delivery-address']; } ?>" placeholder="Delivery Address"/><br /><br />
					<input class="form-control" type="email" name="email" value="<?php if (isset($_POST['email'])) { echo  $_POST['email']; } ?>" placeholder="Email*" required/><br /><br />
					<input class="form-control" type="text" name="phone" value="<?php if (isset($_POST['phone'])) { echo  $_POST['phone']; } ?>" placeholder="Phone"/><br /><br />
					<input class="form-control" type="text" name="username" value="<?php if (isset($_POST['username'])) { echo  $_POST['username']; } ?>" placeholder="Username*" required/><br /><br />
					<input class="form-control" type="password" name="password" value="<?php if (isset($_POST['password'])) { echo  $_POST['password']; } ?>" placeholder="Password*" autocomplete="off" required/><br/><br />
          <!--TODO Confirm Password text field-->
					<input type="submit" name='register' value="Register" class='btn btn-primary submit'/><br />
				</form>
      <?php
				if(isset($errMsg)){
					echo '<span style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</span>';
				}
      ?>
			</div>
    </div>
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

