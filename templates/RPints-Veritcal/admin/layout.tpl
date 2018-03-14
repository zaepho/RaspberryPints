<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {debug}
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>RaspberryPints Admin</title>
        <link href="styles/layout.css" rel="stylesheet" type="text/css" />
        <link href="styles/wysiwyg.css" rel="stylesheet" type="text/css" />
        <!-- Theme Start -->
        <link href="styles.css" rel="stylesheet" type="text/css" />
        <!-- Theme End -->
        <link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
    </head>
    <body>
        {include file="file:admin/header.tpl"}
        <!-- Top Breadcrumb Start -->
        <div id="breadcrumb">
            <ul>	
                <li><img src="img/icons/icon_breadcrumb.png" alt="Location" /></li>
                <li><strong>Location:</strong></li>
                <li class="current">{$CurrentLocation}</li>
            </ul>
        </div>

        <!-- Right Side/Main Content Start -->
        
        <div id="rightside">
            <div class="contentcontainer lg left">
                {include file="file:admin/$CurrentLocation.tpl"}
            </div>
            <div id="footer">
                {include file="file:admin/footer.tpl"}
            </div>
        </div>
        {include file="file:admin/left-bar.tpl"}
        <script type="text/javascript" src="js/enhance.js"></script>	
        <script type='text/javascript' src='js/excanvas.js'></script>
        <script type='text/javascript' src='js/jquery-1.11.0.min.js'></script>
        <script type='text/javascript' src='js/jquery-ui.min.js'></script>
        <script type='text/javascript' src='js/jquery.validate.js'></script>
        <script type='text/javascript' src='scripts/jquery.wysiwyg.js'></script>
        <script type='text/javascript' src='scripts/visualize.jQuery.js'></script>
        <script type="text/javascript" src='scripts/functions.js'></script>	
    </body>
</html>