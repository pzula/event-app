<?php
	
	// escape magic quotes trickery

	if (get_magic_quotes_gpc()) {
	  $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
	  while (list($key, $val) = each($process)) {
	    foreach ($val as $k => $v) {
	      unset($process[$key][$k]);
	      if (is_array($v)) {
	        $process[$key][stripslashes($k)] = $v;
	        $process[] = &$process[$key][stripslashes($k)];
	      } else {
	        $process[$key][stripslashes($k)] = stripslashes($v);
	      }
	    }
	  }
	  unset($process);
	}

	// connect to the database
	
	try
	{
	  $pdo = new PDO('mysql:host=localhost;dbname=lcbevents', 'eventfetcher', '8qWuYNpS28Ar8598');
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $pdo->exec('SET NAMES "utf8"');
	}
	catch (PDOException $e)
	{
	  $output = 'Unable to connect to the database server.';
	  include 'output.php';
	  exit();
	}

	// process the form using placeholders and prepared statements to guard against sql injection

	try
	{
		$sql = 'INSERT INTO registrations SET
			event_id = :event_id,
			name = :name,
			email = :email,
			phone = :phone';
		$s = $pdo->prepare($sql);
		$s->bindValue(':event_id', $_POST['eventid']);
		$s->bindValue(':name', $_POST['name']);
		$s->bindValue(':email', $_POST['email']);
		$s->bindValue(':phone', $_POST['phone']);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error submitting RSVP';
		include 'includes/error.php';
		exit();
	}

	header('Location: ../thankyou.html');
	exit();
?>