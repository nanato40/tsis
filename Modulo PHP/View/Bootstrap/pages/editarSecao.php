<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TSIS - Index</title>

    <!-- Bootstrap Core CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- MetisMenu CSS -->
    
<link href="http://tcc2017.com.br/renato/tsis/View/Bootstrap/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="http://tcc2017.com.br/renato/tsis/View/Bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
 

    <!-- Custom Fonts -->
    <link href="http://tcc2017.com.br/renato/tsis/View/Bootstrap/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<?php

if(empty($_SESSION['email'])&& empty($_SESSION['senha'])){
    
    session_destroy();
    header('Location: http://tcc2017.com.br/renato/tsis/usuario/login');
    exit();
}


?>

<link href="http://tcc2017.com.br/renato/Imagens/favcon.png" rel="icon" type="image/x-icon" />

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
           
                <a class="navbar-brand" href="http://tcc2017.com.br/renato/tsis/usuario/index"><img src="http://tcc2017.com.br/renato/Imagens/icon.png" style="height:50px;width:50px;float:left;padding:5px;"><h4><strong>Tribunal Superior do Trabalho</strong></h4></a>
                
            </div>
            <!-- /.navbar-header -->
<br>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                   
                    
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                 <li class="dropdown">
                   <br>
                        <p style="margin-top:-2cm;"><i><a href="http://tcc2017.com.br/renato/tsis/usuario/logout"><i class="fa fa-sign-in" aria-hidden="true"></i> Sair</a></i></p>
                    
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                            
                                <center>
                                <a href="http://tcc2017.com.br/renato/tsis/usuario/meuPerfil"><p><img src="http://tcc2017.com.br/renato/Imagens/iconuser.png" style="width:100px;height:100px;"></p></a>
                                
                                <h4>Logado como <a href="http://tcc2017.com.br/renato/tsis/usuario/meuPerfil"><?php echo $_SESSION["email"]; ?></h4></a></center>
                                
                                
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="http://tcc2017.com.br/renato/tsis/contrato/listarContrato">Lista de Requisições</a>
                        </li>
                        
                         <li>
                            <a href="http://tcc2017.com.br/renato/tsis/secao/listarSecao">Seções</a>
                        </li>
                        <li>
                            <a href="http://tcc2017.com.br/renato/tsis/estagiario/listarEstagiario">Estagiários</a>
                        </li>
                        
                        
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gerenciar Seções</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                   
                        <div class="panel-heading">
                           
                        
                        <a href="#">
                            
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                   
                        <div class="panel-heading">
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    
                        <div class="panel-heading">
                            <div class="row">
                               
                            
                        </div>
                        <a href="#">
                           
                        </a>
                    </div>
                </div>
                
                <script>
    function apagar(id){
        if(window.confirm("Deseja realmente excluir?")){
            var url = 'http://tcc2017.com.br/renato/tsis/?Controller=secao&Action=delete&id=' + id;
            window.location = url;
        }
    }
		</script>
                
                
                <div class="col-lg-3 col-md-6">
                    
                        <div class="panel-heading">
                            
                        
                        <a href="#">
                            
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row" style="width: 1140px;">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Cadastrar Seção
                            <div class="pull-right">
                                <div class="btn-group">
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
                        
                        	<form name="" name="" method="POST" action="http://tcc2017.com.br/renato/tsis/secao/update/<?php echo $_SESSION["id_secao"];?>">
				                            <div class="form-group">
				  <label for="pwd">Nome da Seção</label>
				  <input type="text" value="<?php echo $_SESSION["nomeSecao"]; ?>" name="txtNomeSecao" class="form-control" id="pwd">
				</div>
			
				<input type="submit" value="Atualizar" class="btn btn-success" />
				</form>
				
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Seções
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           
                                          
                                       <table class="table table-bordered table-hover table-striped">
 <?php  if(isset($_SESSION["data"])){  ?>
    <tr>
  
      <th>Id</th>
      <th>Seção</th>
      <th>Ações</th>
      
      
    </tr>
   <?php } ?>
    
    <tr>
    
        
        <?php
        if(isset($_SESSION["data"])){
        $retorno = $_SESSION["data"];
        foreach($retorno as $value){
    ?>
        
        <td><?php echo $value["id_secao"];?></td>
        <td><?php echo $value["nomeSecao"];?></td>
      <td><a href="http://tcc2017.com.br/renato/tsis/secao/editar/<?php echo $value["id_secao"];?>"><button type="button" class="btn btn-outline-danger">Alterar</button></a>
          
          
          /<a href="#" onclick="apagar('<?php echo $value["id_secao"];?>');"><button type="button" class="btn btn-outline-danger">Deletar</button></a></td>
      
    </tr>
    <center>
        <?php }}else{
        
        echo $_SESSION["NULL_SEC"];
        
        }
        
        
         ?>
         </center>
  </table>     
                                            
                                        
                            <!-- /.list-group -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <!-- /.panel -->
                    
                        <!-- /.panel-heading -->
                        
                        <!-- /.panel-body -->
                        
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
   <script src="https://tcc2017.com.br/renato/tsis/View/Bootstrap/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://tcc2017.com.br/renato/tsis/View/Bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="https://tcc2017.com.br/renato/tsis/View/Bootstrap/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="https://tcc2017.com.br/renato/tsis/View/Bootstrap/vendor/raphael/raphael.min.js"></script>
    <script src="https://tcc2017.com.br/renato/tsis/View/Bootstrap/vendor/morrisjs/morris.min.js"></script>
    <script src="https://tcc2017.com.br/renato/tsis/View/Bootstrap/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="https://tcc2017.com.br/renato/tsis/View/Bootstrap/dist/js/sb-admin-2.js"></script>

</body>

</html>
