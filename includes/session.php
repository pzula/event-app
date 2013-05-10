<?php

if (isset($_GET['type'])) {
	$_SESSION['type'] = $_GET['type'];
} 

if(isset($_SESSION['month'])) {
	// do nothing
} else {
	$_SESSION['month'] = date('F');	
}

if(isset($_SESSION['campus'])) {
	// do nothing
} else {
$_SESSION['campus'] = '58';
}

if (isset($_POST['campus'])) {
	$campus = $_POST['campus'];
	$_SESSION['campus'] = $campus;
}

?>