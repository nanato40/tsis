<!DOCTYPE html>
<html>
<title>TSIS - Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><style>
html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif;}

</style>
<br>
<center><img src="http://tcc2017.com.br/renato/Imagens/logo.png" style="width:15%;"></center>
<body>


<div id="perfil" class="w3-container person">
  <br>
  
  
  <p>
  
  <?php 
  
  if($_SESSION['msgAutenticar']){
  ?>
<div class="w3-panel w3-red">
    <h3>Aviso !</h3>
    <p><?php
  error_reporting(0);
    session_start();
    echo $_SESSION["msgAutenticar"];
?></p>
  </div>
</p>

 <?php }?>
  <div class="w3-container w3-blue">
  <h2>Login</h2>
</div>

  
<form class="w3-container" method="POST" action="http://tcc2017.com.br/renato/tsis/usuario/autenticar">
  <p>
  <label>E-mail</label>
  <input class="w3-input" name="txtEmail" type="text"></p>
 
  <p>
  <label>Senha</label>
  <input class="w3-input" name="txtSenha" type="password"></p>
  

<input type="submit" value="Entrar" class="w3-button w3-block w3-teal" />
  
</form>
  
  
</div>



     
</div>
<!-- fim Ações de Seção -->

</body>
</html> 
