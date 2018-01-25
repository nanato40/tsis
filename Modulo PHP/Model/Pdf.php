<?php

class Pdf{

private $id;
private $nomePdf;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNomePdf(){
		return $this->nomePdf;
	}

	public function setNomePdf($nomePdf){
		$this->nomePdf = $nomePdf;
	}


}

 ?>