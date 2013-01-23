<?php
	
class sstatus{
	public $prevID;
	public $currID;
	public $nextID;
	public $cmd;
	public $doexecute;

	public function __construct($rID_fname, $currID, $cmd){

		if (file_exists($rID_fname)){
	    		$fp = fopen($rID_fname, "r");
			$this->prevID=fread($fp, 255);
			fclose($fp);
		}
		else {
			$this->prevID="0";
		}

		$this->currID=$currID;
		$this->cmd=$cmd;
		$this->nextID=time();
		if ($this->prevID<$currID){
			$this->doexecute=1;
		}
		else { 
			if (($this->prevID=="")&&($this->currID=="")) {
				$this->doexecute=1;
			}
			else {
				$this->doexecute=0;
			}
		}
		
	}
	public function __destruct(){
		unset ($this->prevID);
		unset ($this->currID);
		unset ($this->nextID);
		unset ($this->cmd);
		unset ($this->doexecute);
	}

	public function dprevID(){
		return $this->prevID;
	}
	
	public function dcurrID(){
		return $this->currID;
	}
	
	public function dnextID(){
		return $this->nextID;
	}

	public function dcmd(){
		return $this->cmd;
	}
	public function ddo(){
		return $this->doexecute;
	}
	public function saveCurrID($fname){
		$fp=fopen($fname,"w");
		fputs($fp,$this->currID);
		fclose($fp);
	}		

}

?>
