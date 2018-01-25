<?php
ob_start();

function __autoload($class_name) {
    include "/home/tcc20673/public_html/renato/tsis/Model/".$class_name.".php";
}

class UsuarioController{
    
    public function UsuarioController(){
        
    }
    
    //Método Android
    
    public function autenticarAndroid(){
        
        $model = new UsuarioModel;
        $tokenModel = new TokenModel;
        $user = new Usuario;
        $token = new Token;
        $user->setEmail($_POST["email"]);
        $user->setSenha($_POST["senha"]);
        
        
        
        
        
        if($model->autenticarModel($user)){
        
        $_SESSION["dataUsuario"] = $model->autenticarModel($user);
        $retorno = $_SESSION["dataUsuario"];
        foreach($retorno as $value){
        
        $token->setNomeToken(md5(time()));
        $token->setUsuarioId($value[5]);
        $tokenModel->insertTokenModel($token);
        	
        	$retorno = array("retorno" => $value[0], "nome" => $value[1], "sexo" => $value[2], "email" => $value[3], "senha" => $value[4], "id_usuario" => $value[5], "pessoa_id" => $value[6], "nomeSecao" => $value[7],"secaoId" => $value[8],"tipoUsuario" => $value[9]);
        	 
        }

        
        } else {
        
        $retorno = array("retorno" => "0");
            	
        }
        
         echo json_encode($retorno);
        
          
    }
    
    //Método PHP
 
    public function autenticar(){
        
        $model = new UsuarioModel;
        
        $user = new Usuario;
        $user->setEmail($_POST["txtEmail"]);
        $user->setSenha($_POST["txtSenha"]);
        
        if($_POST["txtEmail"] && $_POST["txtSenha"] ){
        
        if($model->autenticarModel($user)){
        
        $_SESSION["dataUsuario"] = $model->autenticarModel($user);
        $retorno = $_SESSION["dataUsuario"];
        foreach($retorno as $value){
        	$_SESSION["id_pessoa"] = $value[0];
        	$_SESSION["id_usuario"] = $value[5];
        	$_SESSION["nomeUsuario"] = $value[1];
        	$_SESSION["sexoUsuario"] = $value[2];
        	$_SESSION["email"] = $value[3];
        	$_SESSION["senha"] = $value[4];
        	$_SESSION["secao"] = $value[7];
        	$_SESSION["secao_id"] = $value[8];
        
        }
     
        header('Location: http://tcc2017.com.br/renato/tsis/usuario/index');
        
        } else {
        
            $_SESSION["msgAutenticar"] = "Login ou senha invalidos!";
            include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/login.php");
        }
        }else{
        	unset($_SESSION["msgAutenticar"]);
        	 $_SESSION["msgAutenticar"] = "Preencha todos os campos em branco!";
        	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/login.php");
        }
          
    }
    
    //Método Android
    
    public function salvarUsuario(){
        
        $modelUsuario = new UsuarioModel();
        $model = new UsuarioModel();
        $modelPessoa = new PessoaModel();
        $dao = new PessoaDAO();
        $usuario = new Usuario();
        $pessoa = new Pessoa();
        $pessoa->setNome($_POST["nome"]);
        $pessoa->setSexo($_POST["sexo"]);
        
        $modelPessoa->insertPessoaModel($pessoa);
        
        
        
        if($model->getByModelUsuario($_POST["email"])){
		
        	  $retorno = array("retorno"=>"ERROR_EMAIL");
        
        }else{
        	
        $usuario->setEmail($_POST["email"]);
        $usuario->setSenha($_POST["senha"]);
        $usuario->setSecao_id($_POST["secao"]);
        
        $_SESSION["dataId"] = $dao->id();
        $retorno = $_SESSION["dataId"];
        foreach($retorno as $value){
            $usuario->setPessoa_id($value[0]);
        }

        $usuario->setTipoUsuario("U");
        
        
        
        if($modelUsuario->insertUsuarioModel($usuario)){
          $retorno = array("retorno" => "YES");
        }else{
          $retorno = array("retorno" => "NO");
        }
      
       
        }
        
        
        echo json_encode($retorno);
        
      
        
    }
    
   
    //Método Android
        public function updateUserAndroid(){
        $model = new UsuarioModel();
        $model2 = new PessoaModel();
        $vo = new Usuario();
        $vo2 = new Pessoa();
        
        $vo2->setId_pessoa($_POST["idPessoa"]);
        $vo2->setNome($_POST["nome"]);
        $vo2->setSexo($_POST["sexo"]);
        
        $vo->setId_usuario($_POST["idUsuario"]);
        $vo->setEmail($_POST["email"]);
        $vo->setSenha($_POST["senha"]);
        $vo->setSecao_id($_POST["secao"]);

        if($model->updateModelUsuario($vo) && $model2->updateModelPessoa($vo2)){
            $retorno = array("retorno" => "YES");
        } else {
            $retorno = array("retorno" => "NO");
        }
        
        echo json_encode($retorno);
       
       
    }
    
    public function deleteToken(){
        
        $model = new TokenModel();
        $con = new Token();
        $con->setIdToken($_POST["idUsuario"]);
       
        
        if ($model->deleteModelToken($con)){
        	 
           	 $retorno = array("retorno" => "YES");
         
        } else {
            	 $retorno = array("retorno" => "NO");
        }
        
        echo json_encode($retorno);
    }
    
    
    public function update(){
        $model = new UsuarioModel();
        $model2 = new PessoaModel();
        $vo = new Usuario();
        $vo2 = new Pessoa();
        
        if($_POST["txtSenha"] == $_POST["txtConfirmaSenha"]){
        $_SESSION["nomeUsuario"] = $_POST["txtNome"];
        $_SESSION["email"] = $_POST["txtEmail"];
        $_SESSION["sexoUsuario"] = $_POST["txtSexo"];
        
        $vo2->setId_pessoa($_POST["txtId_pessoa"]);
        $vo2->setNome($_POST["txtNome"]);
        $vo2->setSexo($_POST["txtSexo"]);
        
        $vo->setid_usuario($_POST["txtId_usuario"]);
        $vo->setEmail($_POST["txtEmail"]);
        $vo->setSenha($_POST["txtSenha"]);
        $vo->setSecao_id($_POST["txtSecao"]);
        
        
        
        
        if($model->updateModelUsuario($vo) && $model2->updateModelPessoa($vo2)){
            $_SESSION["msgUsuario"] = "Usuário atualizado com sucesso.";
        } else {
            $_SESSION["msgUsuario"] = "Por favor, tente novamente mais tarde!";
        }
        
        }else{
            $_SESSION["msgUsuario"] = "Senhas não conferem.";	
        }
        

	 header('Location: http://tcc2017.com.br/renato/tsis/usuario/meuPerfil');
    }
 
    
     public function login(){
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/login.php");
    }
    
    public function index(){
    
    	$model = new SecaoModel();
    	$model2 = new EstagiarioModel();
    	$model3 = new UsuarioModel();
    	$model4 = new ContratoModel();

    	if($model->getAllSecaoModel()){
    		
	    	$_SESSION["data"] = $model->getAllSecaoModel();
	    	$_SESSION["dadosEstagiario"] = $model2->getAllEstagiarioModel();
	    	$_SESSION["qtdUsuario"] = $model3->getAllAndroidQtdModel();
	    	$_SESSION["qtdSecao"] = $model->getAllSecaoQtd();
	    	$_SESSION["qtdEstagiarios"] = $model2->getAllEstagiarioQtd();
	    	$_SESSION["qtdContrato"] = $model4->getAllContratoQtd();
	    	
	    	$_SESSION["dadosContrato"] = $model4->getAllContratoModel();
	    	$_SESSION["NULL_EST"] = "Nenhuma estagiário registrado.";
    	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/inicial.php");
    	}else{
        	unset($_SESSION["dadosEstagiario"]);
        	$_SESSION["NULL_SEC"] = "Nenhuma seção registrada.";
        	$_SESSION["qtdContrato"] = $model4->getAllContratoQtd();
        	$_SESSION["qtdSecao"] = $model->getAllSecaoQtd();
        	$_SESSION["qtdUsuario"] = $model3->getAllAndroidQtdModel();
	    	$_SESSION["qtdEstagiarios"] = $model2->getAllEstagiarioQtd();
	    	
	    	$_SESSION["dadosContrato"] = $model4->getAllContratoModel();
        	header('Location: http://tcc2017.com.br/renato/tsis/secao/listarSecao');
        }
    	
    	
    	
    
    }
    
    	public function redefinirSenha(){
		include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/redefinirSenha.php");

    	}
    	
    	 public function verificarEmail(){
		$model = new UsuarioModel;

        
        if($model->getByModelUsuario($_POST["txtEmail"])){
		$vo = $model->getByModelUsuario($_POST["txtEmail"]);
        	unset($_SESSION["msgSenha"]);
        	$_SESSION["msgSenha"] = "Verifique sua caixa de e-mail";
        	$from = "renatochavesmonteiro@tcc2017.com.br";
		$to = $_POST["txtEmail"]; 
		$subject = "Envio de senha.";
		$message = "Sua senha:".$vo->getSenha();
		mail($to, $subject, $message, "TCC");
	
        	  include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/redefinirSenha.php");
        
        }else{
        	unset($_SESSION["msgSenha"]);
        	$_SESSION["msgSenha"] = "Nenhuma usuário cadastrado com esse email.";
        	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/redefinirSenha.php");
        }

    	}
    	
    	
    	
    	
    	public function verificarEmailAndroid(){
		$model = new UsuarioModel;

        
        if($model->getByModelUsuario($_POST["txtEmail"])){
		$vo = $model->getByModelUsuario($_POST["txtEmail"]);
        	unset($_SESSION["msgSenha"]);
        	$_SESSION["msgSenha"] = "Verifique sua caixa de e-mail";
        	$from = "renatochavesmonteiro@tcc2017.com.br";
		$to = $_POST["txtEmail"]; 
		$subject = "Envio de senha.";
		$message = "Sua senha:".$vo->getSenha();
		mail($to, $subject, $message, "TCC");
	
        	  $retorno = array("retorno"=>"YES");
        
        }else{
        	$retorno = array("retorno"=>"NO");
        }
        
        echo json_encode($retorno);

    	}
    	

	public function meuPerfil(){
		include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/meuPerfil.php");

    	}

    public function logout(){
    	session_destroy();
    	header('Location: http://tcc2017.com.br/renato/tsis/usuario/login');
    }
    
}


?>