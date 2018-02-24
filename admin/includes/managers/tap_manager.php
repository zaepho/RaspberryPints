<?php
require_once __DIR__.'/../../../includes/config_names.php';
require_once __DIR__.'/../models/tap.php';

class TapManager{
	
	function Save($tap){
		global $DBO;
		$log = Logger::getCurrentLoggers()[0];
		$sql = "";
		$DBO->beginTransaction();
		$sql="UPDATE kegs k SET k.kegStatusCode = 'SERVING', modifiedDate = NOW() WHERE id = " . $tap->get_kegId();
		$log->debug('Updating Keg ' . $tap->get_kegId() . ' Status to SERVING');
		$result = $DBO->exec($sql);
		if ($result===false) {
			$log->warn('Failed to update Keg ' . $tap->get_kegId());
			$DBO->rollBack();
		} else {
			//success
		}
		$sql="UPDATE taps SET active = 0, modifiedDate = NOW() WHERE active = 1 AND tapNumber = " . $tap->get_tapNumber();
		$log->debug('Updating Tap ' . $tap->get_tapNumber() . ' to Inactive');
		$result = $DBO->exec($sql);		
		if ($result===false) {
			$log->warn('Failed to update Tap ' . $tap->get_tapNumber());
			$DBO->rollBack();
		} else {
			// Success
		}
		if($tap->get_id()){
			$sql = 	"UPDATE taps " .
					"SET " .
						"beerId = " . $tap->get_beerId() . ", " .
						"kegId = " . $tap->get_kegId() . ", " .
						"tapNumber = " . $tap->get_tapNumber() . ", " .
						"pinId = " . $tap->get_pinId() . "," .
						"ogAct = " . $tap->get_og() . ", " .
						"fgAct = " . $tap->get_fg() . ", " .
						"srmAct = " . $tap->get_srm() . ", " .
						"ibuAct = " . $tap->get_ibu() . ", " .
						"startAmount = " . $tap->get_startAmount() . ", " .
						"active = " . $tap->get_active() . ", " .
						"modifiedDate = NOW() ".
					"WHERE id = " . $tap->get_id();
					
		}else{
			$sql = 	"INSERT INTO taps(beerId, kegId, tapNumber,pinId, ogAct, fgAct, srmAct, ibuAct, startAmount, currentAmount, active) " .
					"VALUES(" . $tap->get_beerId() . ", " . $tap->get_kegId() . ", " . $tap->get_tapNumber() . "," . $tap->get_pinId() . ", " . $tap->get_og() . ", " . $tap->get_fg() . ", " . $tap->get_srm() . ", " . $tap->get_ibu() . ", " . $tap->get_startAmount() . ", " . $tap->get_startAmount() . ", " . $tap->get_active	() . ")";
		}		
		
		$log->debug('Tapping Keg: ' . $sql);
		$result = $DBO->exec($sql);		
		if ($result===false) {
			$log->warn('Failed to update Tap ' . $tap->get_tapNumber());
			$DBO->rollBack();
			return null;
		} else {
			
			// Success
		}
		$DBO->commit();
		return $tap;
	}
	
	function GetById($id){
		global $DBO;
		$id = (int) preg_replace('/\D/', '', $id);
	
		$sql="SELECT * FROM taps WHERE id = $id";
		$qry = $DBO->query($sql);
		
		if( $qry ){
			$tap = new Tap();
			$tap->setFromArray($qry->fetch(PDO::FETCH_ASSOC));
			return $tap;
		}
		
		return null;
	}
	function GetByPinId($id){
		global $DBO;
		$id = (int) preg_replace('/\D/', '', $id);
	
		$sql="SELECT * FROM taps WHERE pinId = $id";
		$qry = $DBO->query($sql);
		
		if( $qry ){
			$tap = new Tap();
			$tap->setFromArray($qry->fetch(PDO::FETCH_ASSOC));
			return $tap;
		}
		
		return null;
	}
	function updateTapNumber($newTapNumber){
		global $DBO;
		$sql="UPDATE config SET configValue = $newTapNumber, modifiedDate = NOW() WHERE configName = '".ConfigNames::NumberOfTaps."'";
		$DBO->exec($sql);
		
		$sql="UPDATE kegs SET kegStatusCode = 'SANITIZED', modifiedDate = NOW() WHERE id IN (SELECT kegId FROM Taps WHERE tapNumber > $newTapNumber AND active = 1) ";
		$DBO->exec($sql);
		
		$sql="UPDATE taps SET active = 0, modifiedDate = NOW() WHERE active = 1 AND tapNumber > $newTapNumber";
		$DBO->exec($sql);
	}

	function getTapNumber(){
		global $DBO;
		$sql="SELECT configValue FROM config WHERE configName = '".ConfigNames::NumberOfTaps."'";

		$qry = $DBO->query($sql, PDO::FETCH_ASSOC);
		$config = $qry->fetch();
		# $config = $qry['configValue'];
		
		if( $config ){
			return $config['configValue'];
		}
	}

	function getActiveTaps(){
		global $DBO;
		$sql="SELECT * FROM taps WHERE active = 1";
		$qry = $DBO->query($sql);
		
		$taps = array();
		foreach ($qry as $i){
			$tap = new Tap();
			$tap->setFromArray($i);
			$taps[$tap->get_tapNumber()] = $tap;
		}
		
		return $taps;
	}
	
	function closeTap($id){
		global $DBO;
		$sql="UPDATE taps SET active = 0, modifiedDate = NOW() WHERE id = $id";
		$DBO->query($sql);
		
		$sql="UPDATE kegs k, taps t SET k.kegStatusCode = 'NEEDS_CLEANING' WHERE t.kegId = k.id AND t.Id = $id";
		$DBO->query($sql);
	}
}