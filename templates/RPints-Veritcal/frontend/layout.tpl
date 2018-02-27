<html>
	<head>
		{debug}
		<title>RaspberryPints</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<!-- Set location of Cascading Style Sheet -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="img/pint.ico">
		<style>
			body {
				background: url({$config['backgroundImgUrl']});
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
			{include file="file:frontend/header.tpl"}
			{*
			{foreach $taps as $tap}
			{$tap->get_tapNumber()}
			{/foreach}
			*}
			{include file="frontend/taplist.tpl"}
		</div>
	</body>
</html>