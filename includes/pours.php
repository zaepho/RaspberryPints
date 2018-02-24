<?php
if (!array_key_exists('API_KEY', $_POST)) {
	#No API Key Passed, Exit
	#TODO: Log Failure
	#TODO: Fail2Ban
	echo 'Invalid API Key';
	print_r($_POST);
	http_response_code(403);
	exit;
}
//Includes the Database and config information
require_once __DIR__ .'/common.php';
require_once __DIR__ .'/../admin/includes/managers/tap_manager.php';

//Unused at the moment will call untappdPHP library to post to Untappd
//include __DIR__."/app/library/UntappdPHP/lib/untappdPHP.php";

// Creates arguments from info passed by python script from Flow Meters
$PIN = $_POST['pin'];
$AMOUNT = $_POST['amount'];
$API_KEY = $_POST['API_KEY'];
//Unused SQL call at the moment
//$sql = "select tapIndex,batchId,PulsesPerLiter from taps where pinAddress = $PIN";

// Get corresponding tapID to pinId.
$tapMananager = new TapManager;
$tap = $tapMananager->GetByPinId($PIN);
//$OzAmount = $PULSE_COUNT / 165;
$amountPoured = 0;
if ($tap) {
	# Temporarily assuming if pinID > 0 then we're using a flowmeter else Passing Oz
	if ($tap->get_pinId() > 0) {
		// Sets the amount to be a fraction of a gallon based on 165 pulses per ounce
		$amountPoured = $AMOUNT / (165*128);
	} else {
		$amountPoured = $AMOUNT / 128;
	}
	$DBO->beginTransaction();
	// Inserts in to the pours table 
	$qry = "INSERT INTO pours(tapId, pinId, amountPoured, pulses) values (?,?,?,?)";
	$stmt = $DBO->prepare($qry);
	$result = $stmt->execute(array(
		$tap->get_id(),	# Tap Number
		$PIN,				# What Pin did this come from
		$amountPoured, 		# Calculated fractions of a gallon to log
		$AMOUNT 			# log ammount passed to allow for recalibration
	));
	if ($result) {
		// keep going!
	} else {
		echo 'failed to log pour';
		$DBO->rollBack();
		http_response_code(500);
		exit;
	}
	$qry = "update taps set currentAmount = currentAmount - ? where id = ?";
	$stmt = $DBO->prepare($qry);
	$result = $stmt->execute(array(
		$amountPoured, 		# Calculated fractions of a gallon to log
		$tap->get_id()	# Tap Number
	));
	if ($result) {
		// keep going!
	} else {
		echo 'failed to Update currentVolume';
		$DBO->rollBack();
		http_response_code(500);
		exit;
	}
	$DBO->commit();
	echo 'Pour registered sucessfully';
} else {
	echo "No Active Taps";
	http_response_code(401);

}
// REFRESHES CHROMIUM BROWSER ON LOCAL HOST ONLY
// COMMENT OUT TO DISABLE
// exec(__DIR__."/refresh.sh");

?>