<?php

class Token{

		private $idToken;
		private $nomeToken;
		private $usuarioId;
		

		public function getIdToken(){
		return $this->idToken;
	}

	public function setIdToken($idToken){
		$this->idToken = $idToken;
	}

	public function getNomeToken(){
		return $this->nomeToken;
	}

	public function setNomeToken($nomeToken){
		$this->nomeToken = $nomeToken;
	}

	public function getUsuarioId(){
		return $this->usuarioId;
	}

	public function setUsuarioId($usuarioId){
		$this->usuarioId = $usuarioId;
	}

}


 ?>