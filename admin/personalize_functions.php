<?php
if(!isset( $_SESSION['myusername'] )){
	header("location:index.php");
}
require_once __DIR__.'/../includes/common.php';

function updateHeader() {
    global $log;
    global $config;
    global $DBO;

    $sql="UPDATE config SET configValue=? WHERE configName =?";
    $query=$DBO->prepare($sql);
    
    $header_text_trunclen=$_POST['header_text_trunclen'];
    $query->execute(array($header_text_trunclen, 'headerTextTruncLen'));

    $header_text = $_POST['header_text'];
    $query->execute(array($header_text, 'headerText'));
    return;
}

function updatePanelConfig() {
    global $log;
    global $config;
    global $DBO;

    foreach(array_keys($_POST) as $key){
        // update data in mysql database
        $stmt = $DBO->prepare("UPDATE config SET configValue=:configValue WHERE id=:id");
        $stmt->bindParam(':configValue', $_POST[$key], PDO::PARAM_INT);
        $stmt->bindParam(':id', $key, PDO::PARAM_INT);
        $result = $stmt->execute();
    }
    return;
}

function updateImage($Image) {
    global $log;
    global $config;
    global $DBO;

    if ( !isset($_FILES[$Image]['error']) ||
        is_array($_FILES[$Image]['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }
    // Check $_FILES[$Image]['error'] value.
    switch ($_FILES[$Image]['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }
    // You should also check filesize here.
    if ($_FILES[$Image]['size'] > 350000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }
    // DO NOT TRUST $_FILES[$Image]['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES[$Image]['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }
    // You should name it uniquely.
    // DO NOT USE $_FILES['uploaded']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    $imgDir = __DIR__.'/../img';
    $target = realpath($imgDir) . '/' . pathinfo($_FILES[$Image]['tmp_name'], PATHINFO_BASENAME) . '';
    $httptarget = 'img/' . pathinfo($_FILES[$Image]['tmp_name'], PATHINFO_BASENAME);
    if (!move_uploaded_file(
        $_FILES[$Image]['tmp_name'],
        $target
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    # change DB value
    $qry = $DBO->prepare("update config set configValue=?, modifiedDate = NOW() where configName = ?");
    $result = $qry->execute(array($httptarget, $Image));
    if ($result == 1) {
        //Success
        // Delete old file
        $oldFile = __DIR__ . '/../' . $config[$Image];
        $log->debug("Deleting old file: " . $oldFile);
        //unlink($oldFile);
    } else {
        
        throw new RuntimeException('Failed to update configuration value. (' . $qry->errorInfo()[2] . ')');
    }
    
    # Delete Old file
    

    return TRUE;
}

?>