<?php $startdatetime = strtotime( $event['start'] );
      $date = date( 'F d, Y', $startdatetime ); 
      $starttime = date( 'g:i A', $startdatetime ); 
	  $month = date( 'F', $startdatetime );
	  $day = date( 'd', $startdatetime );
      $enddatetime = strtotime( $event['end'] );
      $endtime = date( 'g:i A', $enddatetime ); 
?>