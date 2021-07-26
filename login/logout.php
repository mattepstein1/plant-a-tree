<?php
  function locationGiven() {
    return isset($_GET['location']) && $_GET['location'] != '';
  }

  function locationValid() {
    return strpos($_GET['location'], 'http') === false
      && strpos($_GET['location'], 'www') === false;
      # For the top level domain.
      # FIXME && preg_match('\\.\w{,24}/', $_GET['location']) == false;
  }

  // Resume an existing session to be able to free all its variables
  session_start();
	session_unset();
  if (locationGiven() && locationValid()) {
    header('Location: ' . $_GET['location']);
  } else {
    header('Location: /');
  }
?>
