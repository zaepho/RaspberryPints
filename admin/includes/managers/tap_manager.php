<?php
require_once __DIR__.'/../../../includes/config_names.php';
require_once __DIR__.'/../models/tap.php';

class TapManager{
	
	function Save($tap){
		global $DBO;
		$sql = "";
		
		$sql="UPDATE kegs k SET k.kegStatusCode = 'SERVING' WHERE id = " . $tap->get_kegId();
		$DBO->query($sql);
	
		$sql="UPDATE taps SET active = 0, modifiedDate = NOW() WHERE active = 1 AND tapNumber = " . $tap->get_tapNumber();
		$DBO->query($sql);		
		
		if($tap->get_id()){
			$sql = 	"UPDATE taps " .
					"SET " .
						"beerId = " . $tap->get_beerId() . ", " .
						"kegId = " . $tap->get_kegId() . ", " .
						"tapNumber = " . $tap->get_tapNumber() . ", " .
						"ogAct = " . $tap->get_og() . ", " .
						"fgAct = " . $tap->get_fg() . ", " .
						"srmAct = " . $tap->get_srm() . ", " .
						"ibuAct = " . $tap->get_ibu() . ", " .
						"startAmount = " . $tap->get_startAmount() . ", " .
						"active = " . $tap->get_active() . ", " .
						"modifiedDate = NOW() ".
					"WHERE id = " . $tap->get_id();
					
		}else{
			$sql = 	"INSERT INTO taps(beerId, kegId, tapNumber, ogAct, fgAct, srmAct, ibuAct, startAmount, currentAmount, active, createdDate, modifiedDate ) " .
					"VALUES(" . $tap->get_beerId() . ", " . $tap->get_kegId() . ", " . $tap->get_tapNumber() . ", " . $tap->get_og() . ", " . $tap->get_fg() . ", " . $tap->get_srm() . ", " . $tap->get_ibu() . ", " . $tap->get_startAmount() . ", " . $tap->get_startAmount() . ", " . $tap->get_active	() . ", NOW(), NOW())";
		}		
		
		//echo $sql; exit();
		
		$DBO->query($sql);
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

	function updateTapNumber($newTapNumber){
		global $DBO;
		$sql="UPDATE config SET configValue = $newTapNumber WHERE configName = '".ConfigNames::NumberOfTaps."'";
		$DBO->query($sql);
		
		$sql="UPDATE taps SET active = 0, modifiedDate = NOW() WHERE active = 1 AND tapNumber > $newTapNumber";
		$DBO->query($sql);
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