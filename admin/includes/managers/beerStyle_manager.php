<?php
require_once __DIR__.'/../models/beerStyle.php';

class BeerStyleManager{

	function GetAll(){
		global $DBO;
		$sql="SELECT * FROM beerStyles ORDER BY name";
		$qry = $DBO->query($sql);
		
		$beerStyles = array();
		foreach($qry as $i) {
			$beerStyle = new beerStyle();
			$beerStyle->setFromArray($i);
			$beerStyles[$beerStyle->get_id()] = $beerStyle;
		}
		
		return $beerStyles;
	}



	function GetById($id){
		global $DBO;
		$sql="SELECT * FROM beerStyles WHERE id = $id";
		$qry = $DBO->query($sql);
		
<<<<<<< HEAD
		if( $i = $qry->fetch(PDO::FETCH_ASSOC) ){		
=======
		if( $i = mysql_fetch_array($qry) ){
>>>>>>> Version2
			$beerStyle = new beerStyle();
			$beerStyle->setFromArray($i);
			return $beerStyle;
		}
		
		return null;
	}
}