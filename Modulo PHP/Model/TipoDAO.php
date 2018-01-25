<?php


class TipoDAO{
    

   public function getAllTipo(){
        $SQL = "SELECT * FROM tipo";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $array = array();
        
        if (mysqli_num_rows($query) <= 0)
        {
        	return false;
        }
        else
        
        {
        
        while($row = $query->fetch_assoc()){
            $array[] = $row;
        }
        
        return $array;
    }
    }
    
     
    }
    


?>
