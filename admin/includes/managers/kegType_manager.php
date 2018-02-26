<?php
require_once __DIR__.'/../models/kegType.php';

class KegTypeManager{

	function GetAll(){
		global $DBO;
		$sql="SELECT * FROM kegTypes ORDER BY displayName";
		$qry = $DBO->query($sql);
		
		$kegStatuses = array();
		foreach($qry as $i) {
			$kegType = new KegType();
			$kegType->setFromArray($i);
			$kegTypes[$kegType->get_id()] = $kegType;		
		}
		
		return $kegTypes;
	}
		
	static function GetById($id){
		global $DBO;
		$sql="SELECT * FROM kegTypes WHERE id = $id";
		$qry = $DBO->query($sql);
		
		if( $i = $qry->fetch() ) {	
			$kegType = new KegType();
			$kegType->setFromArray($i);
			return $kegType;
		}

		return null;
	}
}