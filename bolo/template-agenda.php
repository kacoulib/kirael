<?php

	/*

	Template Name: agenda

	*/

	get_header();
	require	'api/calendar/class.iCalReader.php';
	$feed	= 'https://calendar.google.com/calendar/ical/coulibaly91karim%40gmail.com/private-d100100dc20a53acf0d4183ea309fad2/basic.ics';
	$rss	= file_get_contents($feed);

	$ical	= new ical($feed);
	$events	= $ical->events();

	$print_event = [];
	for ($i = 0; $i < count($events); $i++) {
	  $date = $events[$i]['DTSTART'];
	  $timestamp = $ical->iCalDateToUnixTimestamp($date);
	  $events[$i]['real_timestamp'] = $timestamp;
	  if ($timestamp > time())
	    array_push($print_event, $events[$i]);
	}
	asort($print_event);
?>
	<div class="col-md-1"></div>

	<div class="col-md-10">
		<?php 
			$txt = '';
			$i = 0;
			$date_name = ['Mon' => 'Lundi', 'Tue' => 'Mardi', 'Wed' => 'Mercredi', 'Thu' => 'Jeudi', 'Fri' => 'Vendredi', 'Sat' => 'Samedi','Sun' => 'Dimanche'];
			foreach ($print_event as $key => $v)
			{
				if (empty($v['SUMMARY']))
					continue;
				$jour = $date_name[date('D', $v['real_timestamp'])];
				$date = date('d M', $v['real_timestamp']);
				$txt .= "<tr><td>$jour $date</td>";
				$txt .= '<td>'.$v['SUMMARY'].'</td></tr>';
				$i++;
				if($i == 2)
					break;
			}
			echo "<table class='table table-condensed'>".$txt."</table>";
		?>
	</div>
	<div class="col-md-1"></div>
	<span class="clearfix"></span>
	<div class="col-md-1"></div>
	<div class="col-md-10 no_padding">
		<!-- calendar -->
		<?php get_template_part('calendar');?>
	</div>
	<div id="col-md-1"></div>


<?php	get_footer(); ?>
