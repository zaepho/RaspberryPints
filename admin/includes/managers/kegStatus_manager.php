<?php
require_once __DIR__.'/../models/kegStatus.php';

class KegStatusManager{

	function GetAll(){
		global $DBO;
		$sql="SELECT * FROM kegStatuses ORDER BY name";
		$qry = $DBO->query($sql);
		
		$kegStatuses = array();
		foreach($qry as $i) {
			$kegStatus = new KegStatus();
			$kegStatus->setFromArray($i);
			$kegStatuses[$kegStatus->get_code()] = $kegStatus;		
		}
		
		return $kegStatuses;
	}	
		
	function GetByCode($code){
		global $DBO;
		$sql="SELECT * FROM kegStatuses WHERE code = '$code'";
		$qry = $DBO->query($sql);
		
		if( $i = $qry->fetch() ){		
			$kegStatus = new KegStatus();
			$kegStatus->setFromArray($i);
			return $kegStatus;
		}

		return null;
	}
	
}