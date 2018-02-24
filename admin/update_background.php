<?php 
require_once __DIR__.'/../includes/common.php';
$imgDir = __DIR__.'/../img';
$ok=1; 
/*
echo '<pre>';
print_r($_FILES);
echo '</pre>';
//exit;
*/
//This is our size condition 
if ($_FILES['uploaded']['size'] > 350000) { 
    echo "Your file is too large.<br>"; 
    $ok=0; 
} 

//This is our limit file type condition 
if ($_FILES['uploaded']['type'] == "text/php") { 
    echo "No PHP files<br>"; 
    $ok=0; 
} 

//Here we check that $ok was not set to 0 by an error 
if ($ok==0) { 
    Echo "Sorry your file was not uploaded"; 
} else { 
    $imgName = str_replace(' ', '', $_FILES['uploaded']['name']);
    //If everything is ok we try to upload it 
    $MoveResult = move_uploaded_file($_FILES['uploaded']['tmp_name'], $imgDir .'/'. $imgName);
    if($MoveResult) { 
        //echo "<script>location.href='personalize.php';</script>";
    } else { 
        echo "Sorry, there was a problem uploading your file."; 
        exit;
    } 
    $qry = $DBO->prepare("update config set configValue=? where configName = 'backgroundImgUrl'");
    $target = 'img/'.$imgName;
    $result = $qry->execute(array($target));
    if ($result == 1) {
        //Success
        //echo "Success";
        # Reload config values before continuing
        require __DIR__ . '/../includes/config.php';
        echo "<script>location.href='personalize.php';</script>";
    } else {
        echo "Sorry, there was a problem setting the logo configuration."; 
        exit;
    }
} 
?>
