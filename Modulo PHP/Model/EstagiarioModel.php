<?php

class EstagiarioModel{
    
    public function insertEstagiarioModel(Estagiario $value){
        $dao = new EstagiarioDAO();
      return  $dao->salvarEstagiario($value);
    }
    
    public function getAllEstagiarioModel(){
        $est = new EstagiarioDAO();
        return $est->getAllEstagiario();
    }
    
    public function getAllEstagiarioQtd(){
        $est = new EstagiarioDAO();
        return $est->QtdEstagiario();
    }

    
    public function getByIdModelEstagiario($id){
        $est = new EstagiarioDAO();
        $vo = $est->getByIdEstagiario($id);        
        return $vo;
    
	}
	
	public function getByModelEstagiario($value){
        $sec = new EstagiarioDAO();
        $vo = $sec->getByEstagiario($value);        
        return $vo;
    
}


	public function updateModelEstagiario(Estagiario $value){
        $est = new EstagiarioDAO();
        
        return $est->updateEstagiario($value);
    }
    
}

?>