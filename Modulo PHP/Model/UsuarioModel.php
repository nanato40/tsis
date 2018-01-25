<?php
ob_start();
class UsuarioModel{
    
    public function insertUsuarioModel(Usuario $value){
        $dao = new UsuarioDAO();
        
        
      return  $dao->salvarUsuario($value);
    }
    
      public function autenticarModel(Usuario $value){
        $usu = new UsuarioDAO();
       
        return $usu->autenticar($value);
    }
    
    public function getAllAndroidQtdModel(){
    
    $usu = new UsuarioDAO();
   return $usu->QtdAndroid();

    
    }
    
        public function getByModelUsuario($usuario){
        $sec = new UsuarioDAO();
        $vo = $sec->verificaEmail($usuario);        
        return $vo;
    
}
    
    public function updateModelUsuario(Usuario $value){
        $usu = new UsuarioDAO();
        
        return $usu->updateUsuario($value);
    }
    
    public function getByIdModelUsuario($id){
        $est = new UsuarioDAO();
        $vo = $est->getByIdUsuario($id);        
        return $vo;
    
}
    
}

?>