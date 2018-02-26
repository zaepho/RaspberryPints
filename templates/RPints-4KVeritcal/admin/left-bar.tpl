<!-- Left Dark Bar Start -->
<div id="leftside">

<!-- Start User Echo -->
<div id="welcome"> Welcome, {$SESSION['UserInfo']['name']}</div>

<!-- End User Echo -->
<div class="user">
	<a href="../index.php"><img src="{$config['adminLogoUrl']}" width="120" height="120" class="hoverimg" alt="Avatar" /></a>
</div>

<!-- Start Navagation -->
<ul id="nav">
	<li>
		<ul class="navigation">
			<li class="heading selected">Welcome</li>
		</ul>
	<li>
	<li>
		<a class="expanded heading">Basic Setup</a>
		<ul class="navigation">
			<li><a href="beer_list.php">My Beers</a></li>
			<li><a href="keg_list.php">My Kegs</a></li>
			<li><a href="tap_list.php">My Taps</a></li>
		</ul>
	</li>
		<li>
		<a class="expanded heading">Personalization</a>
		<ul class="navigation">
			<li><a href="personalize.php#columns">Show/Hide Columns</a></li>
			<li><a href="personalize.php#header">Headers</a></li>
			<li><a href="personalize.php#logo">Brewery Logo</a></li>
			<li><a href="personalize.php#background">Background Image</a></li>
		</ul>
	</li>
	<li>
		<a class="expanded heading">Help!</a>
		<ul class="navigation">
			<li><a href="phpinfo.php" title="phpinfo">PHPInfo</a></li>
			<li><a href="#" title="gpio-pin-layout">GPIO Pin Layout<small>(coming v2.0.0)</small></a></li>
			<li><a href="#" title="flow-calibration">Flow Meters <small>(coming v2.0.0)</small></a></li>
			<li><a href="#" title="rfid-reader">RFID Readers <small>(coming v2.0.0)</small></a></li>
			<li><a href="#" title="temp-probe">Temperature Probes <small>(coming v3.0.0)</small></a></li>
			<li><a href="#" title="solenoid">Solenoids <small>(coming v3.0.0)</small></a></li>
			<li><a href="#" title="motion-sensor">Motion Sensors <small>(coming v3.0.0)</small></a></li>
		</ul>
	</li>
	<li>
		<a class="collapsed heading">Analytics</a>
		<ul class="navigation">
			<li><a href="#" title="temperature-vs-time">Temperature vs Time <small>(coming v2.0.0)</small></a></li>
			<li><a href="#" title="pour-history">Pour history <small>(coming v2.0.0)</small></a></li>
			<li><a href="#" title="tap-history">Tap history <small>(coming v2.0.0)</small></a></li>
			<li><a href="#" title="rank">Beer statistics <small>(coming v2.0.0)</small></a></li>
			<li><a href="#" title="drinker-stats">Drinker statistics <small>(coming v2.0.0)</small></a></li>
			<li><a href="#" title="GPT">Tap statistics <small>(coming v2.0.0+)</small></a></li>
		</ul>
	</li>
	<li>
		<a class="expanded heading">Help</a>
		<ul class="navigation">
			<li><a href="#" title="faq">F.A.Q. <small>(coming soon)</small></a></li>
			<li><a href="https://github.com/zaepho/RaspberryPints/issues" title="faq">Report a Bug</a></li>
			<li><a href="https://github.com/zaepho/RaspberryPints/issues" title="faq">Request a Feature</a></li>
		</ul>	
	</li>
	<li>
		<a class="expanded heading">External Links</a>
		<ul class="navigation">
			<li><a href="http://www.raspberrypints.com/" target="_blank">Official Website</a></li>
			<li><a href="http://www.raspberrypints.com/faq" target="_blank">F.A.Q.</a></li>
			<li><a href="http://www.homebrewtalk.com/f51/initial-release-raspberrypints-digital-taplist-solution-456809" target="_blank">Visit Us on HBT</a></li>
			<li><a href="http://www.raspberrypints.com/contributors" target="_blank">Contributors</a></li>
			<li><a href="http://www.raspberrypints.com/licensing" target="_blank">Licensing</a></li>
		</ul>
	</li>
</ul>

<!-- End Navagation -->
<!-- Left Dark Bar End --> 