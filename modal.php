<?php include_once "includes/db.php";
    //simplify the data
    $eventid = $_GET['eventid'];
    $campusname = $row['address1'];
	$street =  $row['address2'];
	$city = $row['city'];
	$state = $row['state'];
	$zip = $row['zip'];
    $name = $row['name'];
    $description = $row['description'];

    $startdatetime = strtotime( $row['start'] );
	$date = date( 'F d, Y', $startdatetime ); 
    $starttime = date( 'g:i A', $startdatetime );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RSVP</title>

	<link rel="stylesheet" href="css/main.css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/validate_form_fields.js"></script>

</head>

<body>

	<div id="event1details" class="event-modal">
		<div class="modal-content">
		
			<h2>RSVP Registration</h2>

			<h3><?php echo $name; ?></h3>
			
			<p class="date"><strong>Date:</strong> <?php echo $date; ?></p>
			<p class="time"><strong>Time:</strong> <?php echo $starttime; ?></p>
			<p class="location"><strong>Location:</strong> <?php echo $campusname; ?> <br>
			<?php echo $street; ?><br /><?php echo $city . ', ' . $state . " " . $zip; ?></p>

			
			<form action="includes/post.php" method="post" class="rsvp-form" id="rsvp-form" name="rsvp-form">
					<input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
				<div class="form-fields">
					<input type="text" name="name" id="name" value="Name" class="clear-default" />
					<input type="text" name="email" id="email" value="Email" class="clear-default" />
					<input type="text" name="phone" id="phone" value="Phone" class="clear-default" />
				</div>
				<div class="form-right">
					<input type="submit" value="RSVP" class="submit-btn" />
					
					<a href="includes/createical.php?eventid=<?php echo $eventid; ?>" class="small-cal">Add to Calendar</a>
					
				</div>
				<div class="clearfix"></div>
			</form>
			
			<p class="required"><em>All fields are required.</em></p>	
			
		</div><!-- End .modal-content -->
	</div><!-- End #event1details -->


</body>
</html>
