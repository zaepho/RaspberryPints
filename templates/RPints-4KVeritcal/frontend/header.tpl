<!-- Header with Brewery Logo and Project Name -->
<div class="header clearfix">
    <div class="HeaderLeft">
        {if $config[ConfigNames::UseHighResolution]}
            <a href="admin/admin.php"><img src="<?php echo $config[ConfigNames::LogoUrl] ?>" height="200" alt=""></a>
        {else}
            <a href="admin/admin.php"><img src="<?php echo $config[ConfigNames::LogoUrl] ?>" height="100" alt=""></a>
        {/if}
    </div>
    <div class="HeaderCenter">
        <h1 id="HeaderTitle">{$config[ConfigNames::HeaderText]}</h1>
    </div>
    <div class="HeaderRight">
        {if $config[ConfigNames::UseHighResolution]}
            <a href="http://www.raspberrypints.com"><img src="img/RaspberryPints-4k.png" height="200" alt=""></a>
        {else}
            <a href="http://www.raspberrypints.com"><img src="img/RaspberryPints.png" height="100" alt=""></a>
        {/if}
    </div>
</div>
<!-- End Header Bar -->