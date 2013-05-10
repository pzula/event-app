<?php 
	//set correct content-type-header
	header('Content-type: text/calendar; charset=utf-8');
	$Filename = "LeCordonBleu" . $_GET['eventid'] . ".ics";
	header('Content-Disposition: download; filename=' . $Filename);
    
    include_once "db.php";

    //simplify the data
    $location = $row['address1'] . " | " . $row['address2'] . " " . $row['city'] . ", " . $row['state'] . " " . $row['zip'] . " ";
    $name = $row['name'];
    $description = $row['description'];

    $startdatetime = strtotime( $row['start'] );
    $starttime = date( 'Ymd\THi00', $startdatetime ); 
    $enddatetime = strtotime( $row['end'] );
    $endtime = date( 'Ymd\THi00', $enddatetime );  

    $ical = "BEGIN:VCALENDAR" . "\n";
	$ical .= "VERSION:2.0" . "\n";
	$ical .= "PRODID:-//hacksw/handcal//NONSGML v1.0//EN" . "\n";
	$ical .= "BEGIN:VEVENT" . "\n";
	$ical .= "UID:info@chefs.edu" . "\n";
	$ical .= "DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z" . "\n";
	$ical .= "ORGANIZER;CN=Le Cordon Bleu:MAILTO:info@chefs.edu" . "\n";
	$ical .= "LOCATION:" . $location . "\n";
	$ical .= "DESCRIPTION:" . $description . "\n";
	$ical .= "DTSTART:" . $starttime . "\n";
	$ical .= "DTEND:" . $endtime . "\n";
	$ical .= "SUMMARY:" . $name . "\n";
	$ical .= "END:VEVENT" . "\n";
	$ical .= "END:VCALENDAR" . "\n";

	echo $ical;
	exit;

?> 
