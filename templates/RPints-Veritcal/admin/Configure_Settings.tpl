    <div class="headings alt"><h2>Personalize</h2></div>
    <div class="contentbox">
    <a name="columns"></a>
    <h2>Show/Hide Columns</h2><br /> 

    <form method="post" action="update_column.php">
        {foreach $PanelConfig as $row}
            <h3>{$row['displayName']}:</h3>
            {html_radios name=$row['id'] selected=$row['configValue'] options=$ConfigOnOff}<br />
        {/foreach}
        <input type="submit" class="btn" value="Save" />
    </form>

    <hr />

<a name="header"></a> 
    <h2>Taplist Header</h2><br><br>
    <p><b>Text to Display:</b></p>
        <form method="post" action="update_header_text.php">
            <input type="text" class="largebox" value="{$config[ConfigNames::HeaderText]}" name="header_text"> &nbsp 
            <input type="submit" class="btn" name="Submit" value="Submit">
        </form><br><br>{*
    <p><b>Truncate To:</b> (# characters)</p>
        <form method="post" action="update_header_text_trunclen.php">
            <input type="text" class="smallbox" value="<?php echo $config['headerTextTruncLen']; ?>" name="header_text_trunclen"> &nbsp 
            <input type="submit" class="btn" name="Submit" value="Submit">
        </form>
    <hr />
<a name="logo"></a> 
    <h2>Taplist Logo</h2>
    <p>This logo appears on the taplist.</p>
        <b>Current image:</b><br /><br />
            <img src="<?php echo '../'.$config['logoUrl'] ?>" height="100" alt="Brewery Logo" style="border-style: solid; border-width: 2px; border-color: #d6264f;" />
        <form enctype="multipart/form-data" action="update_logo.php" method="POST"><br />
            <input name="uploaded" type="file" accept="image/gif, image/jpg, image/png"/>
            <input type="submit" class="btn" value="Upload" />
        </form> 
        <hr />
<a name="logo"></a> 
    <h2>Admin Logo</h2>
    <p>This logo appears on the admin panel.</p>
        <b>Current image:</b><br /><br />
            <img src="<?php echo '../'.$config['adminLogoUrl'] ?>" height="100" alt="Brewery Logo" style="border-style: solid; border-width: 2px; border-color: #d6264f;" />
        <form enctype="multipart/form-data" action="updateAdminLogo.php" method="POST"><br />
            <input name="uploaded" type="file" accept="image/gif, image/jpg, image/png"/>
            <input type="submit" class="btn" value="Upload" />
        </form> 

    <hr />
<a name="background"></a> 
    <h2>Background Image</h2>
    <p>This background appears on the taplist.</p>
        <b>Current image:</b><br /><br />
            <img src="<?php echo '../'.$config['backgroundImgUrl'] ?>" width="200" alt="Background" style="border-style: solid; border-width: 2px; border-color: #d6264f;" />
        <form enctype="multipart/form-data" action="update_background.php" method="POST">
            <input name="uploaded" type="file" accept="image/gif, image/jpg, image/png"/>
            <input type="submit" class="btn" value="Upload" /><br /><br />
        </form>
        <form action="restore_background.php" method="POST">
            <input type="submit" class="btn" value="Restore Default Background" />
        </form> 
*}
</div>