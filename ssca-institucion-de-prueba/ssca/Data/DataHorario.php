<?php
	class DataHorario {
		
		private $idHorario;
		private $horaEntrada;	
		private $horaSalida;
		private $titulo;
		
		public function __construct(){
			
		}
		
		public function setIdHorario($idHorario){
			$this->idHorario = $idHorario;
		}
		public function getIdHorario(){
			return $this->idHorario;
		}
		
		public function setHoraEntrada($horaEntrada){
			$this->horaEntrada = $horaEntrada;
		}
		public function getHoraEntrada(){
			return $this->horaEntrada;
		}
		
		public function setHoraSalida($horaSalida){
			$this->horaSalida = $horaSalida;
		}
		public function getHoraSalida(){
			return $this->horaSalida;
		}
		
		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}
		public function getTitulo(){
			return $this->titulo;
		}		
	}
?>