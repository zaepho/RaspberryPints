<?php
require_once __DIR__.'/../models/keg.php';

class KegManager{

	function GetAll(){
		global $DBO;
		$sql="SELECT * FROM kegs ORDER BY label";
		$qry = $DBO->query($sql);
		
		$kegs = array();
		foreach($qry as $i){
			$keg = new Keg();
			$keg->setFromArray($i);
			$kegs[$keg->get_id()] = $keg;
		}
		
		return $kegs;
	}
	
	function GetAllActive(){
		global $DBO;
		$sql="SELECT * FROM kegs WHERE active = 1 ORDER BY label";
		$qry = $DBO->query($sql);
		
		$kegs = array();
		foreach($qry as $i){
			$keg = new Keg();
			$keg->setFromArray($i);
			$kegs[$keg->get_id()] = $keg;
		}
		
		return $kegs;
	}
	
	function GetAllAvailable(){
		global $DBO;
		$sql="SELECT * FROM kegs WHERE active = 1
			AND kegStatusCode != 'SERVING'
			AND kegStatusCode != 'NEEDS_CLEANING'
			AND kegStatusCode != 'NEEDS_PARTS'
			AND kegStatusCode != 'NEEDS_REPAIRS'
		ORDER BY label";
		$qry = $DBO->query($sql);
		
		$kegs = array();
		foreach($qry as $i){
			$keg = new Keg();
			$keg->setFromArray($i);
			$kegs[$keg->get_id()] = $keg;
		}
		
		return $kegs;
	}
			
	static function GetById($id){
		global $DBO;
		$sql="SELECT * FROM kegs WHERE id = $id";
		$qry = $DBO->query($sql);
		
		if( $i = $qry->fetch() ){		
			$keg = new Keg();
			$keg->setFromArray($i);
			return $keg;
		}

		return null;
	}
	
	
	function Save($keg){
		global $DBO;
		$sql = "";
		if($keg->get_id()){
			$sql = 	"UPDATE kegs " .
					"SET " .
						"label = '" . $keg->get_label() . "', " .
						"kegTypeId = " . $keg->get_kegTypeId() . ", " .
						"make = '" . $keg->get_make() . "', " .
						"model = '" . $keg->get_model() . "', " .
						"serial = '" . $keg->get_serial() . "', " .
						"stampedOwner = '" . $keg->get_stampedOwner() . "', " .
						"stampedLoc = '" . $keg->get_stampedLoc() . "', " .
						"weight = '" . $keg->get_weight() . "', " .
						"notes = '" . $keg->get_notes() . "', " .
						"kegStatusCode = '" . $keg->get_kegStatusCode() . "', " .
						"modifiedDate = NOW() ".
					"WHERE id = " . $keg->get_id();
					
		}else{
			$sql = 	"INSERT INTO kegs(label, kegTypeId, make, model, serial, stampedOwner, stampedLoc, weight, notes, kegStatusCode, createdDate, modifiedDate ) " .
					"VALUES(" . 
						"'". $keg->get_label() . "', " . 
						$keg->get_kegTypeId() . ", " . 
						"'". $keg->get_make() . "', " . 
						"'". $keg->get_model() . "', " . 
						"'". $keg->get_serial() . "', " . 
						"'". $keg->get_stampedOwner() . "', " . 
						"'". $keg->get_stampedLoc() . "', " . 
						"'". $keg->get_weight() . "', " . 
						"'". $keg->get_notes() . "', " . 
						"'". $keg->get_kegStatusCode() . "', " . 
						"NOW(), NOW())";
		}
		
		//echo $sql; exit();
		
		$DBO->exec($sql);
	}
	
	function Inactivate($id){
		global $DBO;
		$sql = "SELECT * FROM taps WHERE kegId = $id AND active = 1";
		$qry = $DBO->query($sql);
		
		if( $qry->fetch() ){		
			$_SESSION['errorMessage'] = "Keg is associated with an active tap and could not be deleted.";
			return;
		}
	
		$sql="UPDATE kegs SET active = 0 WHERE id = $id";
		//echo $sql; exit();
		
		$qry = $DBO->exec($sql);
		if ($qry == 1) {
			$_SESSION['successMessage'] = "Keg successfully deleted.";
		} else {
			$_SESSION['errorMessage'] = "Keg failed to delete";
		}
	}
}