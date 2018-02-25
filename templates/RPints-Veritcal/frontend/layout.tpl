<html>
	<head>
		<title>RaspberryPints</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<!-- Set location of Cascading Style Sheet -->
		<link rel="stylesheet" type="text/css" href="style.css">

		{if $config[ConfigNames::UseHighResolution]}
			<link rel="stylesheet" type="text/css" href="high-res.css">
		{/if}

		<link rel="shortcut icon" href="img/pint.ico">
		<style>
			body {
				background: url(<?php echo $config['backgroundImgUrl'] ?>);
				background-color: #000000;
				background-size: cover;
				background-repeat:no-repeat;
				/*overflow: hidden;*/
				font: 1.5em Gerorgia, arial, verdana, sans-serif;
				margin:5px;
			}
		</style>
	</head>

	<body>
		<div class="bodywrapper">