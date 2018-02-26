<?php
class Tap  
{  
	private $_id;  
	private $_beerId;  
	private $_kegId;
	private $_tapNumber;
	private $_pinId;
	private $_og; 
	private $_fg;  
	private $_srm;  
	private $_ibu;  
	private $_startAmount; 
	private $_currentAmount; 
	private $_active;
	private $_createdDate; 
	private $_modifiedDate;
	private $_beer;
	private $_keg;

	public function __construct(){}

	public function get_id(){ return $this->_id; }
	public function set_id($_id){ $this->_id = $_id; }

	public function get_beerId(){ return $this->_beerId; }
	public function set_beerId($_beerId){ $this->_beerId = $_beerId; }

	public function get_kegId(){ return $this->_kegId; }
	public function set_kegId($_kegId){ $this->_kegId = $_kegId; }

	public function get_tapNumber(){ return $this->_tapNumber; }
	public function set_tapNumber($_tapNumber){ $this->_tapNumber = $_tapNumber; }
	
	public function get_pinId() { return $this->_pinId; }
	public function set_pinId($_pinId){ $this->_pinId = $_pinId; }
	
	public function get_og(){ return $this->_og; } 
	public function set_og($_og){ $this->_og = $_og; }
	
	public function get_fg(){ return $this->_fg; }
	public function set_fg($_fg){ $this->_fg = $_fg;}

	public function get_srm(){ return $this->_srm; }
	public function set_srm($_srm){ $this->_srm = $_srm; }

	public function get_ibu(){ return $this->_ibu; }
	public function set_ibu($_ibu){ $this->_ibu = $_ibu; }

	public function get_startAmount(){ return $this->_startAmount; }
	public function set_startAmount($_startAmount){ $this->_startAmount = $_startAmount; }
	
	public function get_currentAmount(){ return $this->_currentAmount; }
	public function set_currentAmount($_currentAmount){ $this->_currentAmount = $_currentAmount; }
	
	public function get_active(){ return $this->_active; }
	public function set_active($_active){ $this->_active = $_active; }
	
	public function get_createdDate(){ return $this->_createdDate; }
	public function set_createdDate($_createdDate){ $this->_createdDate = $_createdDate; }
	
	public function get_modifiedDate(){ return $this->_modifiedDate; }
	public function set_modifiedDate($_modifiedDate){ $this->_modifiedDate = $_modifiedDate; }
	
	public function get_beer() { return $this->_beer;}
	public function get_keg() { return $this->_keg;}
	
	# Beer functions.  Really doesn't belong here.
	public function get_bitternessRatio(){ 
		return $this->_ibu / (($this->_og - 1) * 1000); 
	}

	public function get_abv() {
		$abv = ($this->_og - $this->_fg) * 131;
		return $abv;
	}

	public function get_calFromAlc(){
		return (1881.22 * ($this->_fg * ($this->_og - $this->_fg))) / (1.775 - $this->_og);
	}
	
	public function get_calFromCarbs() {
		return 3550.0 * $this->_fg * ((0.1808 * $this->_og) + (0.8192 * $this->_fg) - 1.0004);
	}
	
	public function get_totalCal() {
		return $this->get_calFromAlc() + $this->get_calFromCarbs();
	}

	public function get_ozPoured() {
		return ($this->_startAmount - $this->_currentAmount) * 128;
	}
	public function get_percentFull() {
		return $this->_currentAmount / $this->_keg->get_kegType()->get_maxAmount() * 100;
	}
	public function setFromArray($postArr)  
	{  	
		if( isset($postArr['id']) )
			$this->set_id($postArr['id']);
		else
			$this->set_id(null);
			
		if( isset($postArr['beerId']) ) {
			$this->set_beerId($postArr['beerId']);
			$this->_beer = BeerManager::GetById($this->_beerId);
		} else {
			$this->set_beerId(null);
		}

		if( isset($postArr['kegId']) ) {
			$this->set_kegId($postArr['kegId']);
			$this->keg = KegManager::GetById($this->_kegId);
		} else {
			$this->set_kegId(null);
		}

		if( isset($postArr['tapNumber']) )
			$this->set_tapNumber($postArr['tapNumber']);
		else
			$this->set_tapNumber(null);
			
		if( isset($postArr['pinId']) )
			$this->set_pinId($postArr['pinId']);
		else
			$this->set_pinId('0');
			
		if( isset($postArr['og']) )
			$this->set_og($postArr['og']);
		else if( isset($postArr['ogAct']) )
			$this->set_og($postArr['ogAct']);
		else if( isset($postArr['ogEst']) )
			$this->set_og($postArr['ogEst']);
		else
			$this->set_og(null);
			
		if( isset($postArr['fg']) )
			$this->set_fg($postArr['fg']);
		else if( isset($postArr['fgAct']) )
			$this->set_fg($postArr['fgAct']);
		else if( isset($postArr['fgEst']) )
			$this->set_fg($postArr['fgEst']);
		else
			$this->set_fg(null);
			
		if( isset($postArr['srm']) )
			$this->set_srm($postArr['srm']);
		else if( isset($postArr['srmAct']) )
			$this->set_srm($postArr['srmAct']);
		else if( isset($postArr['srmEst']) )
			$this->set_srm($postArr['srmEst']);
		else
			$this->set_srm(null);
			
		if( isset($postArr['ibu']) )
			$this->set_ibu($postArr['ibu']);
		else if( isset($postArr['ibuAct']) )
			$this->set_ibu($postArr['ibuAct']);
		else if( isset($postArr['ibuEst']) )
			$this->set_ibu($postArr['ibuEst']);
		else
			$this->set_ibu(null);
				
		if( isset($postArr['startAmount']) )
			$this->set_startAmount($postArr['startAmount']);
		else
			$this->set_startAmount(null);
				
		if( isset($postArr['currentAmount']) )
			$this->set_currentAmount($postArr['currentAmount']);
		else
			$this->set_currentAmount(null);
		
		if( isset($postArr['active']) )
			$this->set_active($postArr['active']);
		else
			$this->set_active(false);
		
		if( isset($postArr['createdDate']) )
			$this->set_createdDate($postArr['createdDate']);
		else
			$this->set_createdDate(null);
			
		if( isset($postArr['modifiedDate']) )
			$this->set_modifiedDate($postArr['modifiedDate']);
		else
			$this->set_modifiedDate(null);
	}  
}
