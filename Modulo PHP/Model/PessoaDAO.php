<?php

class PessoaDAO{
    
    public function salvarPessoa(Pessoa $pessoa){
        
        $SQL = "INSERT INTO pessoa(nome,sexo) VALUES (";
        $SQL.="?,?)";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $nome= $pessoa->getNome();
        $sexo= $pessoa->getSexo();
        
        $pstm->bind_param("ss",$nome,$sexo);
        
        
        
        if($pstm->execute()){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function id(){
        $SQL = "SELECT max(id_pessoa) as id_pessoa FROM pessoa";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $array = array();
        
        while($row = $query->fetch_array()){
            $array[] = array($row["id_pessoa"]);
        }
        
        return $array;
    }
    
    public function deletePessoa(Pessoa $value){
        $SQL = "DELETE FROM pessoa WHERE id_pessoa = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        $pess = $value->getId_pessoa();
        
        $pstm->bind_param("i",$pess);
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
    
    public function getByIdPessoa($id){
        $SQL = "SELECT * FROM pessoa WHERE id_pessoa = ".  addslashes($id);
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        
        $vo = new Pessoa();
        
        while($reg = $query->fetch_array(MYSQLI_ASSOC)){
            $vo->setId_pessoa($reg["id_pessoa"]);
            $vo->setNome($reg["nome"]);
            $vo->setSexo($reg["sexo"]);
            
        }
        
        return $vo;
    }
    
    
    
    public function updatePessoa(Pessoa $value){
        $SQL = "UPDATE pessoa SET nome = ?, sexo = ? WHERE id_pessoa = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $nome = $value->getNome();
        $sexo = $value->getSexo();
        $idpessoa = $value->getId_pessoa();
        
        $pstm->bind_param("ssi", $nome,$sexo,$idpessoa );
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
}

