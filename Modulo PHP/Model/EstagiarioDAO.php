<?php

class EstagiarioDAO{
    
    public function salvarEstagiario(Estagiario $estagiario){
        
        $SQL = "INSERT INTO estagiario (tipoEnsino,semestre,status,pessoa_id,secao_id,contato) VALUES (";
        $SQL.="?,?,?,?,?,?)";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $pstm->bind_param("sssiss", $estagiario->getTipoEnsino(),$estagiario->getSemestre(),$estagiario->getStatus(),$estagiario->getPessoa_id(),$estagiario->getSecao_id(),$estagiario->getContato());
       
    
        if($pstm->execute()){
            return true;
        }else{
            return false;
        }
        
    }

    public function getAllEstagiario(){
        $SQL = "SELECT  pessoa.id_Pessoa,pessoa.nome , pessoa.sexo, estagiario.id_estagiario, estagiario.tipoEnsino, estagiario.semestre,estagiario.id_estagiario, estagiario.status, estagiario.pessoa_id,estagiario.secao_id, estagiario.contato, secao.nomeSecao FROM pessoa
      inner join estagiario ON estagiario.pessoa_id = pessoa.id_Pessoa inner join secao ON estagiario.secao_id = secao.id_secao";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $array = array();
        
        while($row = $query->fetch_array()){
            $array[] = array($row["id_pessoa"], $row["nome"], $row["sexo"], $row["id_estagiario"], $row["tipoEnsino"], $row["semestre"], $row["status"], $row["pessoa_id"], $row["nomeSecao"], $row["contato"]);
        }
        
        return $array;
    }
    
    
    
    
    public function updateEstagiario(Estagiario $value){
        $SQL = "UPDATE estagiario SET tipoEnsino = ?, semestre = ?, status = ?, secao_id = ?, contato = ? WHERE id_estagiario = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $pstm->bind_param("sssisi", $value->getTipoEnsino(), $value->getSemestre(), $value->getStatus(), $value->getSecao_id(), $value->getContato(), $value->getId_estagiario());
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
    
    public function getByIdEstagiario($id){
    
    	$SQL = "SELECT  pessoa.id_Pessoa,pessoa.nome , pessoa.sexo,estagiario.secao_id, estagiario.id_estagiario, estagiario.tipoEnsino, estagiario.semestre, estagiario.status, estagiario.pessoa_id,estagiario.secao_id, estagiario.contato, secao.nomeSecao FROM pessoa
inner join estagiario ON estagiario.pessoa_id = pessoa.id_Pessoa inner join secao ON estagiario.secao_id = secao.id_secao where id_estagiario = ".addslashes($id);
    
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        
        $vo = new Estagiario();
        
        while($reg = $query->fetch_array(MYSQLI_ASSOC)){
            $vo->setId_estagiario($reg["id_estagiario"]);
            $vo->setPessoa_id($reg["pessoa_id"]);
            $vo->setNome($reg["nome"]);
            $vo->setSexo($reg["sexo"]);
            $vo->setTipoEnsino($reg["tipoEnsino"]);
            $vo->setSemestre($reg["semestre"]);
            $vo->setStatus($reg["status"]);
            $vo->setSecao_id($reg["secao_id"]);
            $vo->setContato($reg["contato"]);
            
        }
        
        return $vo;
    }
    
    
    public function getByEstagiario($value){
        $SQL = "SELECT  pessoa.id_Pessoa,pessoa.nome , pessoa.sexo,estagiario.secao_id, estagiario.id_estagiario, estagiario.tipoEnsino, estagiario.semestre, estagiario.status, estagiario.pessoa_id,estagiario.secao_id, estagiario.contato, secao.nomeSecao FROM pessoa
inner join estagiario ON estagiario.pessoa_id = pessoa.id_Pessoa inner join secao ON estagiario.secao_id = secao.id_secao WHERE (pessoa.nome like '%".$value."%' OR pessoa.sexo like '%".$value."%' OR estagiario.tipoEnsino like '%".$value."%' OR estagiario.semestre like '%".$value."%' OR estagiario.status like '%".$value."%' OR secao.nomeSecao like '%".$value."%') ";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        
        $array = array();
        
        while($row = $query->fetch_array()){
            $array[] = array($row["id_pessoa"], $row["nome"], $row["sexo"], $row["id_estagiario"], $row["tipoEnsino"], $row["semestre"], $row["status"], $row["pessoa_id"], $row["nomeSecao"], $row["contato"]);
        }
        
        return $array;
    }
    
    public function QtdEstagiario(){
        $SQL = "SELECT * FROM estagiario";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $retorno = mysqli_num_rows($query);
        
        	return $retorno;
        
    }
    
    
    
    
}

