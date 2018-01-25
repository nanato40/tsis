<?php
ob_start();

function __autoload($class_name) {
    include "/home/tcc20673/public_html/renato/tsis/Model/".$class_name.".php";
}

class EstagiarioController{

public function EstagiarioController(){
        
    }

			public function salvarEstagiario(){
			
			$pessoa = new Pessoa();
			
			$pessoa->setNome($_POST["txtNome"]);
			$pessoa->setSexo($_POST["txtSexo"]);
			
			$salvarPessoa = new PessoaModel();
			$salvarPessoa->insertPessoaModel($pessoa);
			
			
			//Salvar Estagiário
			$estagiario = new Estagiario();     
			$estagiario->setTipoEnsino($_POST["txtTipoEnsino"]);
			$estagiario->setSemestre($_POST["txtSemestre"]);
			$estagiario->setStatus($_POST["txtStatus"]);
			$model = new PessoaDAO();
			        $_SESSION["dataId"] = $model->id();
			        $retorno = $_SESSION["dataId"];
			        foreach($retorno as $value){
			            $estagiario->setPessoa_id($value[0]);
			        }
			$estagiario->setSecao_id($_POST["txtSecao"]);   
			$estagiario->setContato($_POST["txtContato"]);
			
			$salvarEstagiario = new EstagiarioModel();
			
			
			if($salvarEstagiario->insertEstagiarioModel($estagiario)){
			          $_SESSION["msgEstagiario"] = "Estagiário cadastrado com sucesso.";
			        }else{
			            $_SESSION["msgEstagiario"] = "Por favor, tente novamente mais tarde!";
			        }
			      
			        header('Location: http://tcc2017.com.br/renato/tsis/estagiario/listarEstagiario');
			        
			    }
			    
    
    public function novoEstagiario(){
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/estagiario.php");
    }
    
    public function pesquisarEstagiario(){
        
        $model = new EstagiarioModel;

        
        if($model->getByModelEstagiario($_POST["txtPesquisa"])){
        
        $_SESSION["dadosEstagiario"] = $model->getByModelEstagiario($_POST["txtPesquisa"]);
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/estagiario.php");
        
        
        
        }else{
        	unset($_SESSION["dadosEstagiario"]);
        	$_SESSION["NULL_EST"] = "Nenhuma dado encontrado.";
        	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/estagiario.php");
        }
        
    }
    
    
    
    public function listarEstagiario(){
        
        $model = new EstagiarioModel;
        
        if($model->getAllEstagiarioModel()){
        
        $_SESSION["dadosEstagiario"] = $model->getAllEstagiarioModel();
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/estagiario.php");
        
        
        
        }else{
        	unset($_SESSION["dadosEstagiario"]);
        	$_SESSION["NULL_EST"] = "Nenhum estagiário registrado.";
        	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/estagiario.php");
        }
        
        
    }
    
    
    
    public function delete(){
        
        $model = new PessoaModel();
        
        $vo = $model->getByIdModelPessoa($_GET["id"]);
        if ($model->deleteModelPessoa($vo)){
           	 $_SESSION["msgEstagiario"] = "Estagiário deletado com sucesso.";
         
        } else {
            	 $_SESSION["msgEstagiario"] = "Por favor, tente novamente mais tarde!";
        }
         header('Location: http://tcc2017.com.br/renato/tsis/estagiario/listarEstagiario');
    }


    public function editar(){
        
        $model = new EstagiarioModel();
        
        $vo = $model->getByIdModelEstagiario($_GET["id"]);
        
        $_SESSION["id_estagiario"] = $vo->getId_estagiario();
        $_SESSION["pessoa_id"] = $vo->getPessoa_id();
        $_SESSION["nome"] = $vo->getNome();
        $_SESSION["sexo"] = $vo->getSexo();
        $_SESSION["tipoEnsino"] = $vo->getTipoEnsino();
        $_SESSION["semestre"] = $vo->getSemestre();
        $_SESSION["status"] = $vo->getStatus();
        $_SESSION["nomeSecao"] = $vo->getSecao_id();
        $_SESSION["contato"] = $vo->getContato();
       
        
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/editarEstagiario.php");
    }
    
    
    public function update(){
        $model = new EstagiarioModel();
        $model2 = new PessoaModel();
        $vo = new Estagiario();
        $vo2 = new Pessoa();
        
        $vo2->setId_pessoa($_GET["id"]);
        $vo2->setNome($_POST["txtNome"]);
        $vo2->setSexo($_POST["txtSexo"]);
        $vo->setid_estagiario($_POST["txtId_estagiario"]);
        $vo->setTipoEnsino($_POST["txtTipoEnsino"]);
        $vo->setSemestre($_POST["txtSemestre"]);
        $vo->setStatus($_POST["txtStatus"]);
        $vo->setSecao_id($_POST["txtSecao_id"]);
        $vo->setContato($_POST["txtContato"]);
        
        
        
        if($model->updateModelEstagiario($vo) && $model2->updateModelPessoa($vo2)){
            $_SESSION["msgEstagiario"] = "Estagiário atualizado com sucesso.";
        } else {
            $_SESSION["msgEstagiario"] = "Por favor, tente novamente mais tarde!";
        }

	 header('Location: http://tcc2017.com.br/renato/tsis/estagiario/listarEstagiario');
    }
    
    
    }

?>
