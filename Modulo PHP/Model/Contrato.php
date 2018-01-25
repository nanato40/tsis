<?php


class Contrato {
	private $id_contrato;
	private $status;
	private $data;
	private $tipo_id;
	private $pdf_id;
	private $secaoId;
	private $usuarioId;
	
	public function getId_contrato(){
		return $this->id_contrato;
	}

	public function setId_contrato($id_contrato){
		$this->id_contrato = $id_contrato;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getData(){
		return $this->data;
	}

	public function setData($data){
		$this->data = $data;
	}

	public function getTipo_id(){
		return $this->tipo_id;
	}

	public function setTipo_id($tipo_id){
		$this->tipo_id = $tipo_id;
	}

	public function getSecaoId(){
		return $this->secaoId;
	}

	public function setSecaoId($secaoId){
		$this->secaoId = $secaoId;
	}

	public function getUsuarioId(){
		return $this->usuarioId;
	}

	public function setUsuarioId($usuarioId){
		$this->usuarioId = $usuarioId;
	}
	public function getPdf_id(){
		return $this->pdf_id;
	}

	public function setPdf_id($pdf_id){
		$this->pdf_id = $pdf_id;
	}

}

 ?>