<?php
class Encuesta
{
	private $idEncuesta;
	private $tx_1;
	private $tx_2;
	private $tx_3;
	private $tx_4;
	private $tx_5;
	private $tx_6;
	private $tx_7;	
	private $tx_8;
	
	private $tx_sugerencias;
	
	
		
		
	//retorna el indicador unico del usuario en la intranet
	public function getIdEncuesta(){
		return $this->idEncuesta;
	}
	
	//inicializa el indicador unico del usuario en la intranet
	public function setIdEncuesta($idEncuesta){
				$this->idEncuesta=$idEncuesta;
		
	}
	//retorna la P1  del usuario en la intranet
	public function getTx1(){
		return $this->tx_1;
	}
	//inicializa la P1 del usuario en la intranet
	public function setTx1($tx_1){
	
			$this->tx_1=$tx_1;
						
	}
	//retorna P2 usuario en la intranet
	public function getTx2(){
		return $this->tx_2;
	}
	//inicializa P2 en la intranet
	public function setTx2($tx_2){
		$this->tx_2=$tx_2;
	}
	
	//retorna P3 
	public function getTx3(){
		return $this->tx_3;
	}
	//inicializa la P3
	public function setTx3($tx_3){
		$this->tx_3=$tx_3;
	}
	
	//retorna P4 en
	public function getTx4(){
		return $this->tx_4;
	}
	//inicializa P4
	public function setTx4($tx_4){
		$this->tx_4=$tx_4;
	}
	
	//retorna P5 en 
	public function getTx5(){
		return $this->tx_5;
	}
	
	//inicializa P5 
	public function setTx5($tx_5){
		$this->tx_5= $tx_5;
	}
	
	//retorna P6
	public function getTx6(){
		return $this->tx_6;
	}
	
	//inicializa P6
	public function setTx6($tx_6){
		$this->tx_6=$tx_6;
	}
	
	//retorna P7
	public function getTx7(){
		return $this->tx_7;
	}
	//inicializa P7
	
	public function setTx7($tx_7){
		$this->tx_7=$tx_7;
	}
	//inicializa P8
	public function getTx8(){
		return $this->tx_8;
	}
	
	
	public function setTx8($tx_8){
		$this->tx_8=$tx_8;
	}
	
	
	
	
	public function getTx_sugerencias(){
		return $this->tx_sugerencias;
	}
	
	
	public function setTx_sugerencias($Tx_sugerencias){
		$this->tx_sugerencias=$Tx_sugerencias;
	}
	
		
}
?>