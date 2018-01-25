<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TSIS - Login</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>

<?php

if(isset($_SESSION['email'])&& isset($_SESSION['senha'])){

    header('Location: http://tcc2017.com.br/renato/tsis/usuario/index');
   
}


?>

<br>
<center><img src="http://tcc2017.com.br/renato/Imagens/logoNova.png" style="height:40px;"></center>
<br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
				                    
				<?php 
			  if($_SESSION['msgAutenticar']){
				  ?>
				  
				<div class="alert alert-danger">
				    <strong><?php
						  error_reporting(0);
						    session_start();
						    echo $_SESSION["msgAutenticar"];
						?></strong>
				  </div>
				  <?php }?>
				   
                        <form role="form" method="POST" action="http://tcc2017.com.br/renato/tsis/usuario/autenticar">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="txtEmail" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="txtSenha" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <h6><a href="http://tcc2017.com.br/renato/tsis/usuario/redefinirSenha">Esqueci minha senha !</a></h6>
                                    </label>
                                </div>
                                
                                <input type="submit" value="Entrar" class="btn btn-lg btn-success btn-block" />
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</body>

</html>
