<?php
	
    session_start();
    
    if(isset($_GET["Controller"])){
       
        include "/home/tcc20673/public_html/renato/tsis/Controller/".$_GET["Controller"]."Controller.php";
        
        $class = $_GET["Controller"]."Controller";
        
        eval("\$Controller = new $class();");
        
        
        if(isset($_GET["Action"])){
           eval("\$Controller->\$_GET['Action']();");
        }
    }
?>