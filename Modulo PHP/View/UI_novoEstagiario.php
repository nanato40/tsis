<!DOCTYPE html>
<html>
<title>TSIS - Estagiários</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><style>
html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif;}
.w3-bar-block .w3-bar-item{padding:16px}
</style>
<body>

<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left w3-card-2" style="z-index:3;width:320px;" id="mySidebar">
   <p><center><img src="http://tcc2017.com.br/renato/Imagens/logo.png" style="width:60%;"></center></p>
   
   
   <a href="http://tcc2017.com.br/renato/tsis/usuario/meuPerfil" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onClick="openMail('secoes');w3_close();" id="firstTab">
      <div class="w3-container">
      <span class="w3-opacity w3-large">Meu Perfil</span>
        
      </div>
   
  <a href="http://tcc2017.com.br/renato/tsis/View/UI_listaDeRequisicoes.php" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onClick="openMail('secoes');w3_close();" id="firstTab">
      <div class="w3-container">
      <span class="w3-opacity w3-large">Lista de Requisições</span>
        
      </div>
  
    <a href="http://tcc2017.com.br/renato/tsis/secao/listarSecao" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onClick="openMail('secoes');w3_close();" id="firstTab">
      <div class="w3-container">
      <span class="w3-opacity w3-large">Seções</span>
        
      </div>
      
    <a href="http://tcc2017.com.br/renato/tsis/estagiario/listarEstagiario" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onClick="openMail('estagiarios');w3_close();">
      <div class="w3-container">
       <span class="w3-opacity w3-large">Estagiários</span>
        
      </div>
 
  
</nav>
<!--
<!-- Modal that pops up when you click on "New Message" -->

<div id="id01" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-red">
       <span onClick="document.getElementById('id01').style.display='none'"
       class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
      <h2>Send Mail</h2>
    </div>
    <div class="w3-panel">
      <label>To</label>
      <input class="w3-input w3-border w3-margin-bottom" type="text">
      <label>From</label>
      <input class="w3-input w3-border w3-margin-bottom" type="text">
      <label>Subject</label>
      <input class="w3-input w3-border w3-margin-bottom" type="text">
      <input class="w3-input w3-border w3-margin-bottom" style="height:150px" placeholder="What's on your mind?">
      <div class="w3-section">
        <a class="w3-button w3-red" onClick="document.getElementById('id01').style.display='none'">Cancel  <i class="fa fa-remove"></i></a>
        <a class="w3-button w3-light-grey w3-right" onClick="document.getElementById('id01').style.display='none'">Send  <i class="fa fa-paper-plane"></i></a> 
      </div>    
    </div>
  </div>
</div>

<!-- Overlay effect when opening the side navigation on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onClick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

<!-- Page content -->
<div class="w3-main" style="margin-left:320px;">
<i class="fa fa-bars w3-button w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onClick="w3_open()"></i>
<a href="javascript:void(0)" class="w3-hide-large w3-red w3-button w3-right w3-margin-top w3-margin-right" onClick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil"></i></a>


<!-- Ações de Lista de Requisições -->
<div id="requisicoes" class="w3-container person">

 
</div>

<?php

if(empty($_SESSION['email'])&& empty($_SESSION['senha'])){
    
    session_destroy();
    header('Location: http://tcc2017.com.br/renato/tsis/usuario/login');
    exit();
}


?>

<script>
    function apagar(id){
        if(window.confirm("Deseja realmente excluir?")){
            var url = 'http://tcc2017.com.br/renato/tsis/?Controller=estagiario&Action=delete&id=' + id;
            window.location = url;
        }
    }
</script>
<a href="http://tcc2017.com.br/renato/tsis/usuario/logout"><img src="http://tcc2017.com.br/renato/Imagens/exit.png" align="right" style="width:50px;height:50px;"></a>
<!-- Ação de Seção -->
<div id="secoes" class="w3-container person">
  <br>
  <?php 
  
  if($_SESSION['msgEstagiario']){
  ?>
<div class="w3-panel w3-green">
    <h3>Aviso !</h3>
    <p><?php
  error_reporting(0);
    session_start();
    echo $_SESSION["msgEstagiario"];
    unset($_SESSION["msgEstagiario"]);

?></p>
  </div>
</p>

 <?php }?>
 <div class="w3-container w3-blue">
  <h2>Estagiários</h2>
  
</div>
  <hr>
  
  
  <form class="w3-container" name="" method="POST" action="http://tcc2017.com.br/renato/tsis/estagiario/salvarEstagiario">
  <p>
  <label>Nome</label>
  <input class="w3-input" name="txtNome" type="text"></p>
  <p>
  <label>Sexo</label>
  </p>
  <p><select name="txtSexo" class="w3-select">
  <option value="Masculino">Masculino</option>
  <option value="Feminino">Feminino</option>
  
</select></p>
  <p>
  <label>Ensino</label>
   <p><select name="txtTipoEnsino" class="w3-select">
  <option value="Ensino Superior">Ensino Superior</option>
  <option value="Ensino Fundamental">Ensino Fundamental</option>
  
</select></p>
<p>
  
  
    <p>
    
   <p>
  <label>Semestre</label>
  <input class="w3-input" name="txtSemestre" type="text"></p>
  <p>
  
  
  <p>
  <label>Contato</label>
  <input class="w3-input" name="txtContato" type="text"></p>
  <p>
  
  <label>Seção</label>
  </p>
  <select name="txtSecao" class="w3-select">
                <option value="0">-- Selecione --</option>
                 <?php
                    $retorno = $_SESSION["data"];
        	     foreach($retorno as $value){
                ?>
                    <option value="<?php echo $value["id_secao"];?>"><?php echo $value["nomeSecao"];?></option>
                    <?php }?>
            </select>
<p>
  <label>Status</label>
  </p>
  <p><select name="txtStatus" class="w3-select">
  <option value="Entrevista">Entrevista</option>
  <option value="Contratado">Contratado</option>
  <option value="Desligado">Desligado</option>
  
</select></p>

<input type="submit" value="Enviar" class="w3-button w3-block w3-teal" />
  
</form>
  

<br>
<div class="w3-container w3-blue">
  <h2>Lista de Estagiários</h2>
  
</div>

<table class="w3-table">
 <?php  if(isset($_SESSION["dadosEstagiario"])){  ?>
    <tr>
  
      <th>Nome</th>
      <th>Sexo</th>
      <th>Ensino</th>
      <th>Semestre</th>
      <th>Status</th>
      <th>Seção</th>
      <th>Contato</th>
      <th>Ações</th>
      
    </tr>
   <?php } ?>
    
    <tr>
    
        
        <?php
        if(isset($_SESSION["dadosEstagiario"])){
        $retorno = $_SESSION["dadosEstagiario"];
        foreach($retorno as $value){
    ?>
        
        <td><?php echo $value[1];?></td>
        <td><?php echo $value[2];?></td>
        <td><?php echo $value[4];?></td>
        <td><?php echo $value[5];?></td>
        <td><?php echo $value[6];?></td>
        <td><?php echo $value[8];?></td>
        <td><?php echo $value[9];?></td>
       
      <td><a href="http://tcc2017.com.br/renato/tsis/estagiario/editar/<?php echo $value[3];?>">Alterar</a>
          
          
          /<a href="#" onclick="apagar('<?php echo $value[0];?>');">Deletar</a></td>
      
    </tr>
    <center>
        <?php }}else{
        
        echo $_SESSION["NULL_EST"];
        
        }
        
        
         ?>
         </center>
  </table>
</div>
     
</div>
<!-- fim Ações de Seção -->


</body>
</html> 
