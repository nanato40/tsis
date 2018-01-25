<?php

class SecaoModel{
    
    public function insertSecaoModel(Secao $value){
        	$dao = new SecaoDAO();
        	return  $dao->salvarSecao($value);
        	
    }
    
    
    public function getAllSecaoModel(){
        $sec = new SecaoDAO();
        return $sec->getAllSecao();
    }
    
    public function getAllSecaoQtd(){
        $sec = new SecaoDAO();
        return $sec->QtdSecao();
    }
    
    public function getByIdModelSecao($id){
        $sec = new SecaoDAO();
        $vo = $sec->getByIdSecao($id);        
        return $vo;
    
}

    public function getByModelSecao($secao){
        $sec = new SecaoDAO();
        $vo = $sec->getBySecao($secao);        
        return $vo;
    
}

    public function updateModelSecao(Secao $value){
        $sec = new SecaoDAO();
        
        return $sec->updateSecao($value);
    }
    
    public function deleteModelSecao(Secao $value){
        $sec = new SecaoDAO();
        
        return $sec->deleteSecao($value);
    }

}
?>
