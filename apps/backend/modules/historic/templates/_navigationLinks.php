<ul>
	<li><a href="<?php echo url_for('@historic_daily')?>">Hourly activity</a></li>
	<li><a href="<?php echo url_for2('historic_daily_user', array('from'=>date('Y-m-d'), 'to'=>date('Y-m-d')))?>">User Activity</a></li>
	<li><a href="<?php echo url_for2('historic_top_searches', array('from'=>date('Y-m-d'),'to'=>date('Y-m-d')))?>">Top searches</a></li>
	<li><a href="<?php echo url_for2('booking_by_dates', array('from'=>date('Y-m-d'),'to'=>date('Y-m-d')))?>">Bookings</a></li>
	<li><a href="<?php echo url_for2('map_searches_location', array('from'=>date('Y-m-d'),'to'=>date('Y-m-d')))?>">Map of searches</a></li>
</ul>