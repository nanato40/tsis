<?php



class Estagiario extends Pessoa{
    private $id_estagiario;
    private $tipoEnsino;
    private $semestre;
    private $status;
    private $pessoa_id;
    private $secao_id;
    private $contato;
    
    	public function getId_estagiario(){
		return $this->id_estagiario;
	}

	public function setId_estagiario($id_estagiario){
		$this->id_estagiario = $id_estagiario;
	}

	public function getTipoEnsino(){
		return $this->tipoEnsino;
	}

	public function setTipoEnsino($tipoEnsino){
		$this->tipoEnsino = $tipoEnsino;
	}

	public function getSemestre(){
		return $this->semestre;
	}

	public function setSemestre($semestre){
		$this->semestre = $semestre;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getPessoa_id(){
		return $this->pessoa_id;
	}

	public function setPessoa_id($pessoa_id){
		$this->pessoa_id = $pessoa_id;
	}

	public function getSecao_id(){
		return $this->secao_id;
	}

	public function setSecao_id($secao_id){
		$this->secao_id = $secao_id;
	}

	public function getContato(){
		return $this->contato;
	}

	public function setContato($contato){
		$this->contato = $contato;
	}
    
}
?>
