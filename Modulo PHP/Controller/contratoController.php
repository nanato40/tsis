<?php
ob_start();
function __autoload($class_name) {
    include "/home/tcc20673/public_html/renato/tsis/Model/".$class_name.".php";
}

 class ContratoController{
 
 public function ContratoController(){
 
 }

 public function salvarContrato(){

	
 	$con = new Contrato();
 	$pdf = new Pdf();
 	$modelCon = new ContratoModel();
 	$modelPdf = new PdfModel();
 	$model = new PdfDAO();


 	$photo_user_origem = $_FILES["pdf"]["tmp_name"];
 	$photo_user_destino = "/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/files/".md5(time()).".pdf";
 	move_uploaded_file($photo_user_origem, $photo_user_destino);
      	$nomePdf = md5(time()).".pdf";
 	
 	$con->setStatus("Aguardando");
 	$con->setData(date("d/m/Y"));
 	$con->setTipo_id($_POST["tipo"]);
 	$con->setSecaoId($_POST["secao"]);
 	$con->setUsuarioId($_POST["idUsuario"]);
 	
	$retorno = $model->idPdf(); 
	$con->setPdf_Id($retorno + 1);
			   
 	
 	
        
			      
 	$pdf->setNomePDf($nomePdf);
 	
      	
 	
 	if($modelCon->insertContratoModel($con) && $modelPdf->insertPdfModel($pdf)){
 		
 		$retorno = array("retorno" => "YES");
 	}else{
 		$retorno = array("retorno" => "NO");
 	
 	}
 	
 	echo json_encode($retorno);
 	
 }
 
 
 
 public function delete(){
        
        $model = new ContratoModel();
        
        $vo = $model->getByIdModelContrato($_GET["id"]);
        
        if ($model->deleteModelContrato($vo)){
        	 
           	 $_SESSION["msgContrato"] = "Contrato deletado com sucesso!";
         
        } else {
            	 $_SESSION["msgContrato"] = "Por favor, tente novamente mais tarde!";
        }
         header('Location: http://tcc2017.com.br/renato/tsis/contrato/listarContrato');
    }
    
    
    
    public function pesquisarContrato(){
        
        $model = new ContratoModel;

        
        if($model->getByModelContrato($_POST["txtPesquisa"])){
        
        $_SESSION["dadosContrato"] = $model->getByModelContrato($_POST["txtPesquisa"]);
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/requisicoes.php");
        
        
        
        }else{
        	unset($_SESSION["dadosContrato"]);
        	$_SESSION["NULL_CON"] = "Nenhuma contrato encontrado.";
        	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/requisicoes.php");
        }
        
    }
    
    
    public function editar(){
        
        $model = new ContratoModel();
        
        $vo = $model->getByIdModelContrato($_GET["id"]);
        
        $_SESSION["id_contrato"] = $vo->getId_contrato();
        $_SESSION["nomeSupervisor"] = $vo->getUsuarioId();
        $_SESSION["statusContrato"] = $vo->getStatus();
        $_SESSION["dataContrato"] = $vo->getData();
        $_SESSION["tipoContrato"] = $vo->getTipo_id();
        $_SESSION["pdfName"] = $vo->getPdf_id();
        $_SESSION["contratoSecao"] = $vo->getSecaoId();

        
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/editarContrato.php");
    }
    
   
    
    public function update(){
        $model = new ContratoModel();
        $vo = new Contrato();
        
        $vo->setId_contrato($_GET["id"]);
        $vo->setStatus($_POST["txtStatus"]);
        
        
        if($model->updateModelContrato($vo)){
            $_SESSION["msgContrato"] = "Status atualizado com sucesso.";
        } else {
            $_SESSION["msgContrato"] = "Por favor, tente novamente mais tarde!";
        }

	 header('Location: http://tcc2017.com.br/renato/tsis/contrato/listarContrato');
    }
    
    //Pegar contrato pelo id do usuario
    public function listarContratoUser(){
        
        $model = new ContratoModel();
        
        if($model->getContratoUserModel($_POST["id"])){
        
       	echo json_encode($model->getContratoUserModel($_POST["id"]));
       	
       	}else{
       	
       	$retorno = array("retorno" =>"NO");
       	
       		echo json_encode($retorno);
       	}
       	
       
    }
    
    
     public function deleteContratoAndroid(){
        
        $model = new ContratoModel();
        $con = new Contrato();
        $con->setId_contrato($_POST["id"]);
       
        
        if ($model->deleteModelContrato($con)){
        	 
           	 $retorno = array("retorno" => "YES");
         
        } else {
            	 $retorno = array("retorno" => "NO");
        }
        
        echo json_encode($retorno);
    }
    
    

    
    public function listarContrato(){
        
        $model = new ContratoModel();
        
        if($model->getAllContratoModel()){
        
        $_SESSION["dadosContrato"] = $model->getAllContratoModel();
        include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/requisicoes.php");
        
        
        
        }else{
        	unset($_SESSION["dadosContrato"]);
        	$_SESSION["NULL_CON"] = "Nenhum contrato registrado.";
        	include("/home/tcc20673/public_html/renato/tsis/View/Bootstrap/pages/requisicoes.php");
        }
        
        
    }
    
    
    public function listarTipoMobile(){
        
        $model = new TipoModel;

        if($model->getAllTipoModel()){
        
       	echo json_encode($model->getAllTipoModel());
       	}
    }
    
 
 
 }


 ?>