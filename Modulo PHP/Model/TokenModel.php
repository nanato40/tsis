<?php
ob_start();
class TokenModel{
    
    public function insertTokenModel(Token $value){
        $dao = new TokenDAO();
        
        
      return  $dao->salvarToken($value);
    }
    
    public function deleteModelToken(Token $value){
        $sec = new TokenDAO();
        
        return $sec->deleteToken($value);
    }
      
}

?>