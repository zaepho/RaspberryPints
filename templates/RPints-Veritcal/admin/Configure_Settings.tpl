    <div class="headings alt"><h2>Personalize</h2></div>
    <div class="contentbox">
    <a name="columns"></a>
    <h2>Show/Hide Columns</h2><br /> 
    <form method="post" action="admin.php?action=personalize">
        {foreach $PanelConfig as $row}
            <h3>{$row['displayName']}:</h3>
            {html_radios name=$row['id'] selected=$row['configValue'] options=$ConfigOnOff}<br />
        {/foreach}
        <input type="hidden" name="process" value="panelconfig" />
        <input type="submit" class="btn" value="Save" />
    </form>

    <hr />

    <a name="header"></a> 
    <h2>Taplist Header</h2><br><br>
    
    <form method="post" action="admin.php?action=personalize">
        <p>
            <b>Text to Display:</b>
            <input type="text" class="largebox" value="{$config[ConfigNames::HeaderText]}" name="header_text">
        </p>
        <p>
            <b>Truncate To:</b> (# characters): 
            <input type="text" class="smallbox" value="{$config['headerTextTruncLen']}" name="header_text_trunclen">
        </p>
        <input type="hidden" name="process" value="updateheader" />
        <input type="submit" class="btn" name="Submit" value="Submit">
    </form>
    <hr />
    
<a name="logo"></a> 
    <h2>Taplist Logo</h2>
    <p>This logo appears on the taplist.</p>
        <b>Current image: <br />
        <img src="{$config['logoUrl']}" height="100" alt="Brewery Logo" style="border-style: solid; border-width: 2px; border-color: #d6264f;" /><br />
        <form enctype="multipart/form-data" method="POST" action="admin.php?action=personalize" ><!-- action="update_logo.php" method="POST"> -->
            <input type="hidden" name="process" value="updateimages" />
            <input name="logoUrl" id="logoUrl" type="file" accept="image/gif, image/jpg, image/png"/>
        <hr />
<a name="adminlogo"></a> 
    <h2>Admin Logo</h2>
    <p>This logo appears on the admin panel.</p>
        <b>Current image:</b><br /><br />
            <img src="{$config['adminLogoUrl']}" height="100" alt="Brewery Logo" style="border-style: solid; border-width: 2px; border-color: #d6264f;" /><br />
        <!-- <form enctype="multipart/form-data" action="updateAdminLogo.php" method="POST"> -->
            <input name="adminLogoUrl" id="adminLogoUrl" type="file" accept="image/gif, image/jpg, image/png"/>

    <hr />
<a name="background"></a> 
    <h2>Background Image</h2>
    <p>This background appears on the taplist.</p>
        <b>Current image:</b><br /><br />
            <img src="{$config['backgroundImgUrl']}" width="200" alt="Background" style="border-style: solid; border-width: 2px; border-color: #d6264f;" /><br />
        <!-- <form enctype="multipart/form-data" action="update_background.php" method="POST"> -->
            <input name="backgroundImgUrl" id="backgroundImgUrl" type="file" accept="image/gif, image/jpg, image/png"/>
            <input type="submit" class="btn" value="Upload" /><br /><br />
        </form>
        <form action="restore_background.php" method="POST">
            <input type="submit" class="btn" value="Restore Default Background" />
        </form> 
</div>