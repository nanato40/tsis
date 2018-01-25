<?php

class UsuarioDAO{
    
    public function salvarUsuario(Usuario $usuario){
        
        $SQL = "INSERT INTO usuario (email,senha,secao_id,pessoa_id,tipoUsuario) VALUES (";
        $SQL.="?,?,?,?,?)";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $secaoid = $usuario->getSecao_id();
        $pessoaid = $usuario->getPessoa_id();
        $tipousuario = $usuario->getTipoUsuario();
        
        $pstm->bind_param("ssiis",$email,$senha,$secaoid,$pessoaid,$tipousuario);
       
    
        if($pstm->execute()){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function autenticar(Usuario $usuario){
    
    		$email = $usuario->getEmail();
		$senha = $usuario->getSenha();
    	$SQL = "SELECT  pessoa.id_pessoa,pessoa.nome , pessoa.sexo, usuario.email, usuario.senha, usuario.id_usuario,usuario.pessoa_id, secao.nomeSecao, usuario.secao_id, usuario.tipoUsuario FROM pessoa
      inner join usuario ON usuario.pessoa_id = pessoa.id_pessoa inner join secao ON usuario.secao_id = secao.id_secao WHERE email = '$email' and senha = '$senha'";
      
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
       
        if (mysqli_num_rows($query) <= 0)
        {
        	return false;
        }
        else
        {
            while($row = $query->fetch_row()){
            $array[] = $row;
        }
        
        return $array;
        }
 
}


	public function QtdAndroid(){
	
	$SQL = "SELECT * FROM token";
	$DB = new DB();
	$DB->getConnection();
	$query = $DB->execReader($SQL);
	
	$retorno = mysqli_num_rows($query);
	return $retorno;

	}
	
	public function verificaEmail($value){
        $SQL = "SELECT * FROM usuario WHERE email like '%".$value."%' ";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);

         if (mysqli_num_rows($query) <= 0)
        {
        	return false;
        }
        else
        {
            $vo = new Usuario();
        
        while($reg = $query->fetch_array(MYSQLI_ASSOC)){

            $vo->setSenha($reg["senha"]);
            
        }
        }
        
        return $vo;

    }
    
    // Revisão

	public function getByIdUsuario($id){
    
    	$SQL = "SELECT  pessoa.id_Pessoa, pessoa.nome , pessoa.sexo, usuario.email, usuario.senha, usuario.id_usuario FROM pessoa
inner join usuario ON usuario.pessoa_id = pessoa.id_Pessoa where id_usuario = ".addslashes($id);
    
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        
        $vo = new Usuario();
        
        while($reg = $query->fetch_array(MYSQLI_ASSOC)){
            $vo->setId_usuario($reg["id_usuario"]);
            $vo->setEmail($reg["email"]);
            $vo->setSenha($reg["senha"]);
            
            
        }
        
        return $vo;
    }
    
    public function updateUsuario(Usuario $value){
        $SQL = "UPDATE usuario SET email = ?, senha = ?, secao_id = ? WHERE id_usuario = ?";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        
        $email = $value->getEmail();
        $senha = $value->getSenha();
        $idusuario = $value->getId_usuario();
        $secao = $value->getSecao_id();
        
        $pstm->bind_param("ssii", $email,$senha,$secao,$idusuario);
        
        if($pstm->execute())
            return true;
        else
            return false;
    }
}

?>