<?php

class TokenDAO{
    
    public function salvarToken(Token $token){
        
        $SQL = "INSERT INTO token (nomeToken,usuario_Id) VALUES (";
        $SQL.="?,?)";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $nomeToken = $token->getNomeToken();
        $id = $token->getUsuarioId();
        
        
        $pstm->bind_param("si",$nomeToken,$id);
       
    
        if($pstm->execute()){
            return true;
        }else{
            return false;
        }
        
    }
    
     public function deleteToken(Token $value){
        $SQL = "DELETE FROM token WHERE usuario_id = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $id = $value->getIdToken();
        
        $pstm->bind_param("i", $id);
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
    
   
}

?>