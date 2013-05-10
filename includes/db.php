<?php
// try opening the database connection
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

// CONNECTION SUCCESS uncomment next two lines to enable 
// $output = 'Database connection established.';
// include 'output.php';


try 
{
  $sql = 'SELECT schools.id, events.id AS eventid, name, type, start, end, address1, address2, city, state, zip, map_url, description, tz
          FROM schools INNER JOIN events
            ON school_id = schools.id';
  $schools = 'SELECT id, shortname, address1
          		FROM schools';
  // checks if the session type and campus is set & set to event type of Open House or Chef's Tour, and then queries the DB for only for specified events, else shows all events
if(isset($_SESSION['type']) && $_SESSION['type'] == "OH") {
  $campus = $_SESSION['campus'];
  $sql .= " WHERE type = 'OH' AND school_id = '$campus'";
   $result = $pdo->query($sql);
   $schooloutput = $pdo->query($schools);
   
   // checks for a query string of month (set by links) and then displays appropriate dates
   if(isset($_GET['month'])) {
   		$_SESSION['month'] = $_GET['month'];
   } 
   
   $month = $_SESSION['month'];
	    $numberical = date('n', strtotime($month));
   			$sql .= " AND MONTH(start) = '$numberical'";
			$result = $pdo->query($sql);
  			$schooloutput = $pdo->query($schools);

} elseif(isset($_SESSION['type']) && $_SESSION['type'] == "CT") {
  $campus = $_SESSION['campus'];
  $sql .= " WHERE type = 'CT' AND school_id = '$campus'";
  $result = $pdo->query($sql); 
  $schooloutput = $pdo->query($schools);
  
   // checks for a query string of month (set by links) and then displays appropriate dates
   if(isset($_GET['month'])) {
   		$_SESSION['month'] = $_GET['month'];
   } 
   
   $month = $_SESSION['month'];
	    $numberical = date('n', strtotime($month));
   			$sql .= " AND MONTH(start) = '$numberical'";
			$result = $pdo->query($sql);
  			$schooloutput = $pdo->query($schools);
  
} elseif(isset($_GET['eventid'])) {
  //this query section is for the ical formatter
  $eventid = $_GET['eventid'];
  $sql .= " WHERE events.id = '$eventid'";
  $result = $pdo->query($sql); 
  $schooloutput = $pdo->query($schools);
} else {
  $result = $pdo->query($sql);
  $schooloutput = $pdo->query($schools);
}
}
catch (PDOException $e)
{
  // throw an error if sql queries fail
  $error = 'Error fetching events: ' . $e->getMessage();
  include 'error.php';
  exit();
}

// loop through db results and create an array of info for events listing
foreach ($result as $row) {
	$events[] = array(
    'school_id' => $row['id'],
    'event_id' => $row['eventid'],
    'name' => $row['name'],
    'type' => $row['type'],
    'start' => $row['start'],
    'end' => $row['end'],
    'tz' => $row['tz'],
    'school_name' => $row['address1'],
    'street' => $row['address2'],
    'city' => $row['city'],
    'state' => $row['state'],
    'zip' => $row['zip'],
    'map' => $row['map_url'],
    'description' => $row['description']
  );
}

foreach ($schooloutput as $school) {
	$schooldata[] = array(
    'school_id' => $school['id'],
    'school_name' => $school['address1'],
    'school_shortname' => $school['shortname']
  );
}


?>