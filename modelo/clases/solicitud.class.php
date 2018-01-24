<?php
class Solicitud
{
	private $idSolicitud;
	private $tx_1;
	private $tx_2;
	private $tx_3;
	private $tx_4;
	private $tx_5;
	private $tx_6;
	private $tx_7;	
	private $tx_8;
	private $fecha;
	private $unidad;
	private $tx_lugar;
	private $idUsuario;
	private $verificado;
	
		
		
	//retorna el indicador unico de la solicitud en la intranet
	public function getIdSolicitud(){
		return $this->idSolicitud;
	}
	
	//inicializa el indicador unico de la solicitud en la intranet
	public function setIdSolicitud($idSolicitud){
				$this->idSolicitud=$idSolicitud;
		
	}
	//retorna el indicador unico del usuario en la intranet
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	
	//inicializa el indicador unico del usuario en la intranet
	public function setIdUsuario($idUsuario){
				$this->idUsuario=$idUsuario;
		
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
		$this->tx_5=$tx_5;
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
	
	//inicializa fecha
	public function getFecha(){
		return $this->fecha;
	}
	
	
	public function setFecha($fecha){
		$this->fecha=$fecha;
	}
	
	public function getTx_lugar(){
		return $this->tx_lugar;
	}
	
	
	public function setTx_lugar($Tx_lugar){
		$this->tx_lugar=$Tx_lugar;
	}
	

	public function getUnidad(){
		return $this->unidad;
	}
	//inicializa 
	public function setUnidad($unidad){
		$this->unidad=$unidad;
	}
	
	//inicializa 
	public function setVerificado($verificado){
		$this->verificado=$verificado;
	}
	
	//inicializa 
	public function getVerificado(){
		return $this->verificado;
	}
}
?>