<?php
class ContratoDAO{

public function salvarContrato(Contrato $contrato){
        
        $SQL = "INSERT INTO contrato (status,data,tipo_id,secao_id_secao,usuario_id_usuario,pdf_id) VALUES (";
        $SQL.="?,?,?,?,?,?)";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $status = $contrato->getStatus();
        $data = $contrato->getData();
        $tipo = $contrato->getTipo_id();
        $pdf = $contrato->getPdf_id();
        $secaoId = $contrato->getSecaoId();
        $usuarioId = $contrato->getUsuarioId();
   
        $pstm->bind_param("ssssss",$status,$data,$tipo,$secaoId,$usuarioId,$pdf);
        
        if($pstm->execute()){
            return true;
        }else{
            return false;
        }
        
    }

public function getByIdContrato($id){
        $SQL = "SELECT contrato.id_contrato,pessoa.nome, contrato.status, contrato.data, tipo.tipo, secao.nomeSecao, pdf.nomePdf FROM contrato  inner join secao ON contrato.secao_id_secao = secao.id_secao inner join usuario ON contrato.usuario_id_usuario = usuario.id_usuario inner join pessoa ON pessoa.id_pessoa = usuario.pessoa_id inner join pdf ON contrato.pdf_id = pdf.idPdf inner join tipo ON contrato.tipo_id = tipo.idTipo where contrato.id_contrato = ".  addslashes($id);
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        
        $vo = new Contrato();
        
        while($reg = $query->fetch_array(MYSQLI_ASSOC)){
            $vo->setId_contrato($reg["id_contrato"]);
            $vo->setUsuarioId($reg["nome"]);
            $vo->setStatus($reg["nome"]);
            $vo->setData($reg["data"]);
            $vo->setTipo_id($reg["tipo"]);
            $vo->setPdf_id($reg["nomePdf"]);
            $vo->setSecaoId($reg["nomeSecao"]);
 
        }
        
        return $vo;
    }


	public function getAllContrato(){
        $SQL = "SELECT contrato.id_contrato,pessoa.nome, contrato.status, contrato.data, tipo.tipo, secao.nomeSecao, pdf.nomePdf FROM contrato  inner join secao ON contrato.secao_id_secao = secao.id_secao inner join usuario ON contrato.usuario_id_usuario = usuario.id_usuario inner join pessoa ON pessoa.id_pessoa = usuario.pessoa_id inner join pdf ON contrato.pdf_id = pdf.idPdf inner join tipo ON contrato.tipo_id = tipo.idTipo";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $array = array();
        
        while($row = $query->fetch_array()){
       $array[] = array($row["id_contrato"], $row["nome"], $row["status"], $row["data"], $row["tipo"], $row["nomeSecao"],$row["nomePdf"]);
        }
        
        return $array;
    }
    
    public function getContratoUser($id2){
        $SQL = "SELECT contrato.id_contrato,pessoa.nome, contrato.status, contrato.data, tipo.tipo, secao.nomeSecao, pdf.nomePdf, contrato.usuario_id_usuario FROM contrato  inner join secao ON contrato.secao_id_secao = secao.id_secao inner join usuario ON contrato.usuario_id_usuario = usuario.id_usuario inner join pessoa ON pessoa.id_pessoa = usuario.pessoa_id inner join pdf ON contrato.pdf_id = pdf.idPdf inner join tipo ON contrato.tipo_id = tipo.idTipo WHERE usuario_id_usuario =".$id2." ";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $array = array();
        
        while($row = $query->fetch_assoc()){
            $array[] = $row;
        }
        
        return $array;
    }
    
    public function updateContrato(Contrato $value){
        $SQL = "UPDATE contrato SET status = ? WHERE id_contrato = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $pstm->bind_param("si", $value->getStatus(), $value->getId_contrato());
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
    
     public function getByContrato($value){
       
       $SQL = "SELECT contrato.id_contrato,pessoa.nome, contrato.status, contrato.data, tipo.tipo, secao.nomeSecao, pdf.nomePdf FROM contrato  inner join secao ON contrato.secao_id_secao = secao.id_secao inner join usuario ON contrato.usuario_id_usuario = usuario.id_usuario inner join pessoa ON pessoa.id_pessoa = usuario.pessoa_id inner join pdf ON contrato.pdf_id = pdf.idPdf inner join tipo ON contrato.tipo_id = tipo.idTipo WHERE (pessoa.nome like '%".$value."%' OR contrato.status like '%".$value."%' OR contrato.data like '%".$value."%' OR tipo.tipo like '%".$value."%' OR secao.nomeSecao like '%".$value."%' ) ";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $array = array();
        
        while($row = $query->fetch_array()){
            $array[] = array($row["id_contrato"], $row["nome"], $row["status"], $row["data"], $row["tipo"], $row["nomeSecao"], $row["nomePdf"]);
        }
        
        return $array;
       
    }
    
    
     public function deleteContrato(Contrato $value){
        $SQL = "DELETE FROM contrato WHERE id_contrato = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $id = $value->getId_contrato();
        
        $pstm->bind_param("i", $id);
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
    
    public function QtdContrato(){
        $SQL = "SELECT * FROM contrato WHERE status='Aguardando'";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $retorno = mysqli_num_rows($query);
        
        	return $retorno;
        
    }
    
   
    

}
?>