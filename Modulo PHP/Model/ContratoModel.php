<?php

class ContratoModel{

    public function getAllContratoModel(){
        $est = new ContratoDAO();
        return $est->getAllContrato();
    }
    
    public function getContratoUserModel($id2){
        $est = new ContratoDAO();
        return $est->getContratoUser($id2);
    }
    
     public function getByIdModelContrato($id){
        $sec = new ContratoDAO();
        $vo = $sec->getByIdContrato($id);        
        return $vo;
    
}
	public function updateModelContrato(Contrato $value){
        $sec = new ContratoDAO();
        
        return $sec->updateContrato($value);
    }
    
    public function getByModelContrato($value){
        $sec = new ContratoDAO();
        $vo = $sec->getByContrato($value);        
        return $vo;
    
}

	public function insertContratoModel(Contrato $value){
        	$dao = new ContratoDAO();
        	return  $dao->salvarContrato($value);
        	
    }

	    public function getAllContratoQtd(){
        $sec = new ContratoDAO();
        return $sec->QtdContrato();
    	}

	 public function deleteModelContrato(Contrato $value){
        $sec = new ContratoDAO();
        
        return $sec->deleteContrato($value);
    }
    
    
}

?>