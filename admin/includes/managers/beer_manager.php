<?php
require_once __DIR__.'/../models/beer.php';

class BeerManager{

	function Save($beer){
		global $DBO;
		$log = Logger::getLogger('RPints');
		$sql = "";
		if($beer->get_id()){
			$sql = 	"UPDATE beers " .
					"SET " .
						"name = '" . encode($beer->get_name()) . "', " .
						"beerStyleId = '" . encode($beer->get_beerStyleId()) . "', " .
						"notes = '" . encode($beer->get_notes()) . "', " .
						"ogEst = '" . $beer->get_og() . "', " .
						"fgEst = '" . $beer->get_fg() . "', " .
						"srmEst = '" . $beer->get_srm() . "', " .
						"ibuEst = '" . $beer->get_ibu() . "', " .
						"modifiedDate = NOW() ".
					"WHERE id = " . $beer->get_id();
			$log->info("Updateing beer " . $beer->get_name() . " (" . $beer->get_id() . ")");
		} else {		
			$sql = 	"INSERT INTO beers(name, beerStyleId, notes, ogEst, fgEst, srmEst, ibuEst, createdDate, modifiedDate ) " .
					"VALUES(" . 
					"'" . encode($beer->get_name()) . "', " .
					$beer->get_beerStyleId() . ", " .
					"'" . encode($beer->get_notes()) . "', " .
					"'" . $beer->get_og() . "', " . 
					"'" . $beer->get_fg() . "', " . 
					"'" . $beer->get_srm() . "', " . 
					"'" . $beer->get_ibu() . "' " .
					", NOW(), NOW())";
			$log->info("Creating new beer: " . $beer->get_name());
		}
		
		$log->info('Beer::Save() SQL: ' . $sql);
		//echo $sql; exit();
		
		return $DBO->exec($sql);
	}
	
	function GetAll(){
		global $DBO;
		$sql="SELECT * FROM beers ORDER BY name";
		$qry = $DBO->query($sql);
		
		$beers = array();
		foreach ($qry as $i ){
			$beer = new Beer();
			$beer->setFromArray($i);
			$beers[$beer->get_id()] = $beer;		
		}
		
		return $beers;
	}
	
	function GetAllActive(){
		global $DBO;
		$sql="SELECT * FROM beers WHERE active = 1 ORDER BY name";
		$qry = $DBO->query($sql);
		
		$beers = array();
		foreach ($qry as $i ){
			$beer = new Beer();
			$beer->setFromArray($i);
			$beers[$beer->get_id()] = $beer;		
		}
		
		return $beers;
	}
		
	function GetById($id){
		global $DBO;
		$sql="SELECT * FROM beers WHERE id = $id";
		$qry = $DBO->query($sql);
		if( $i = $qry->fetch() ){		
			$beer = new Beer();
			$beer->setFromArray($i);
			return $beer;
		}

		return null;
	}
	
	function Inactivate($id){
		global $DBO;
		$sql = "SELECT * FROM taps WHERE beerId = $id AND active = 1";
		$qry = $DBO->query($sql);
		
		if( $qry->fetch() ){		
			$_SESSION['errorMessage'] = "Beer is associated with an active tap and could not be deleted.";
			return;
		}
	
		$sql="UPDATE beers SET active = 0 WHERE id = $id";
		//echo $sql; exit();
		$qry = $DBO->exec($sql);
		
		$_SESSION['successMessage'] = "Beer successfully deleted.";
	}
}