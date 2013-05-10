<?php session_start(); ?>
<?php include_once "includes/session.php"; ?>
<?php include_once "includes/db.php"; ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Le Cordon Bleu Events</title>
    <meta name="description" content="Events, open houses and chef's tours from the Le Cordon Bleu College of Culinary Arts">

    <link rel="stylesheet" href="css/main.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.pack.js?v=2.1.4"></script>
    
</head>
<body id="<?php if(isset($_SESSION['type'])) { echo $_SESSION['type']; } ?>" class="<?php if(isset($_SESSION['month'])) { echo $_SESSION['month']; } ?>">

<div class="pg-wrapper">
    <header>
        <div class="header-right">
        
            <?php if ($_SESSION['type'] == "CT") {
            		echo "<img src=\"images\chefstour.png\">";
            	} elseif ($_SESSION['type'] == "OH") {
            		echo "<img src=\"images\openhouses.png\">";
            	} else {
            		echo "Events";
            	} ?>
            
            
            <div class="campus-dropdown">
            	<p>Viewing: <span>
            		<?php foreach($schooldata as $schoolname) {
            		if ($schoolname['school_id'] == $_SESSION['campus']) {
            			echo $schoolname['school_shortname']; 
					} } ?> </span></p>
		        <form action="index.php" method="post">
		            <select name="campus">
		                <option disabled="disabled" selected="selected">Choose a different campus</option>
		                <?php foreach($schooldata as $school): ?>
		                    <option value="<?php echo $school['school_id']; ?>"><?php echo $school['school_shortname']; ?></option>
		                <?php endforeach; ?>
		                <input type="submit" id="go" value="">
		            </select>
		        </form>
		    </div>
        
        </div><!-- End .header-right -->
    </header>
    
    <div class="month-row">
    
        <ul class="month-list">
            <li><a href="?month=January">Jan</a></li>
            <li><a href="?month=February">Feb</a></li>
            <li><a href="?month=March">Mar</a></li>
            <li><a href="?month=April">Apr</a></li>
            <li><a href="?month=May">May</a></li>
            <li><a href="?month=June">Jun</a></li>
            <li><a href="?month=July">Jul</a></li>
            <li><a href="?month=August">Aug</a></li>
            <li><a href="?month=September">Sep</a></li>
            <li><a href="?month=October">Oct</a></li>
            <li><a href="?month=November">Nov</a></li>
            <li><a href="?month=December">Dec</a></li>
        </ul>
    
    </div><!-- End .month-row -->

    <section class="events">
    <?php if (isset($events)): ?>
		<?php foreach ($events as $event): ?>
			<?php include "includes/timeformatter.php"; ?>
	        <div class="event">
	            <div class="date-col">
	            	<div class="date-icon">
	                    <span class="month"><?php echo $month; ?></span> 
	                    <span class="day"><?php echo $day; ?></span>
	                </div>
	            
	            </div>
	            <div class="brief-col">
	                
	                <h2><?php echo $event['name']; ?></h2>
	                
	                <p class="date"><strong>Date:</strong> <?php echo $date; ?></p>
	                <p class="time"><strong>Time:</strong> <?php echo $starttime; ?> - <?php echo $endtime . " (" . $event['tz'] . ")"; ?></p>
	                <p class="location"><strong>Location:</strong> <?php echo $event['school_name']; ?><br />
	                <?php echo $event['street']; ?><br /><?php echo $event['city']; ?>, <?php echo $event['state']; ?> <?php echo $event['zip']; ?></p>
	                    
	                <p class="map"><a href="<?php echo $event['map']; ?>" target="_blank">Map</a></p> 
	                            
	            </div>
	            <div class="rsvp-col">
	            
	                <a href="modal.php?eventid=<?php echo $event['event_id']; ?>" class="rsvp-button fancybox.iframe"><span>RSVP</span> for this event</a>
	            
	            </div>
	            <div class="clearfix"></div>
	            
	            <div class="description">
	                <p><strong>Program Description:</strong><br /><?php echo $event['description']; ?></p>
	            </div>
	        </div><!-- End .event -->

        	<?php endforeach; ?>
        <?php endif; ?>
      
      </section><!-- End .events -->


    <p class="request-info"><a href="#">Request More Info</a></p>


</div><!-- End .pg-wrapper -->

    <script src="js/main.js"></script>
</body>
</html>



