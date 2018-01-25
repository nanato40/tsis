<?php
ob_start();

function __autoload($class_name) {
    include "/home/tcc20673/public_html/renato/tsis/Model/".$class_name.".php";
}

class SecaoController{
    
    public function SecaoController(){
        
    }
    
    public function salvarSecao(){
        
        $model = new SecaoModel();
        $secao = new Secao();
        $secao->setNomeSecao($_POST["nomeSecao"]);
        
        if($model->insertSecaoModel($secao)){
          $_SESSION["msgSecao"] = "Seção cadastrada com sucesso!";
        }else{
            $_SESSION["msgSecao"] = "Por favor, tente novamente mais tarde!";
        }
      
       header('Location: http://tcc2017.com.br/renato/tsis/secao/listarSecao');
       
       
        
    }
    
    public function pesquisarSecao(){
        
        $model = new SecaoModel;

        
        if($model->getByModelSecao($_POST["txtPesquisa"])){
        
        $_SESSION["data"] = $model->getByModelSecao($_POST["txtPesquisa"]);
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/secao.php");
        
        
        
        }else{
        	unset($_SESSION["data"]);
        	$_SESSION["NULL_SEC"] = "Nenhuma seção encontrada.";
        	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/secao.php");
        }
        
    }
    
    
    public function listarSecao(){
        
        $model = new SecaoModel;
        
        if($model->getAllSecaoModel()){
        
        $_SESSION["data"] = $model->getAllSecaoModel();
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/secao.php");
        
        
        
        }else{
        	unset($_SESSION["data"]);
        	$_SESSION["NULL_SEC"] = "Nenhuma seção registrada.";
        	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/secao.php");
        }
        
    }
    
    public function novaSecao(){
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/secao.php");
    }
    
    
    
    
    public function editar(){
        
        $model = new SecaoModel();
        
        $vo = $model->getByIdModelSecao($_GET["id"]);
        
        $_SESSION["id_secao"] = $vo->getId_secao();
        $_SESSION["nomeSecao"] = $vo->getNomeSecao();
       
        
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/editarSecao.php");
    }
    
    
    public function update(){
        $model = new SecaoModel();
        $vo = new Secao();
        
        $vo->setId_secao($_GET["id"]);
        $vo->setNomeSecao($_POST["txtNomeSecao"]);
        
        
        if($model->updateModelSecao($vo)){
            $_SESSION["msgSecao"] = "Seção atualizada com sucesso!";
        } else {
            $_SESSION["msgSecao"] = "Por favor, tente novamente mais tarde!";
        }

	 header('Location: http://tcc2017.com.br/renato/tsis/secao/listarSecao');
    }
    
    public function delete(){
        
        $model = new SecaoModel();
        
        $vo = $model->getByIdModelSecao($_GET["id"]);
        if ($model->deleteModelSecao($vo)){
           	 $_SESSION["msgSecao"] = "Seção deletada com sucesso!";
         
        } else {
            	 $_SESSION["msgSecao"] = "Por favor, tente novamente mais tarde!";
        }
         header('Location: http://tcc2017.com.br/renato/tsis/secao/listarSecao');
    }
    
    
   public function listarSecaoMobile(){
        
        $model = new SecaoModel;

        if($model->getAllSecaoModel()){
        
       	echo json_encode($model->getAllSecaoModel());
       	}
    }
    
  	
}


?>