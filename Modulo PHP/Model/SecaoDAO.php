<?php


class SecaoDAO{
    
    public function salvarSecao(Secao $secao){
        
       $SQL = "INSERT INTO secao (nomeSecao) VALUES (";
        $SQL.="?)";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        $sec = $secao->getNomeSecao();
        
        $pstm->bind_param("s", $sec);
        
        if($pstm->execute()){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function getAllSecao(){
        $SQL = "SELECT * FROM secao";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $array = array();
        
        if (mysqli_num_rows($query) <= 0)
        {
        	return false;
        }
        else
        
        {
        
        while($row = $query->fetch_assoc()){
            $array[] = $row;
        }
        
        return $array;
    }
    }
    
     public function getByIdSecao($id){
        $SQL = "SELECT * FROM secao WHERE id_secao = ".  addslashes($id);
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        
        $vo = new Secao();
        
        while($reg = $query->fetch_array(MYSQLI_ASSOC)){
            $vo->setId_secao($reg["id_secao"]);
            $vo->setNomeSecao($reg["nomeSecao"]);
            
        }
        
        return $vo;
    }
    
    public function getBySecao($value){
        $SQL = "SELECT * FROM secao WHERE nomeSecao like '%".$value."%' ";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        
        $array = array();
        
        if (mysqli_num_rows($query) <= 0)
        {
        	return false;
        }
        else
        
        {
        
        while($row = $query->fetch_assoc()){
            $array[] = $row;
        }
        
        return $array;
    }
    }
    
    
    
    public function updateSecao(Secao $value){
        $SQL = "UPDATE secao SET nomeSecao = ? WHERE id_secao = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $pstm->bind_param("si", $value->getNomeSecao(), $value->getId_secao());
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
    
    
     public function deleteSecao(Secao $value){
        $SQL = "DELETE FROM secao WHERE id_secao = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $pstm->bind_param("i", $value->getId_secao());
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
    
    
    public function QtdSecao(){
        $SQL = "SELECT * FROM secao";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $retorno = mysqli_num_rows($query);
        
        	return $retorno;
        
    }
    
    
    }
    


?>
