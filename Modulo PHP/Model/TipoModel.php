<?php

class TipoModel{
    
    public function getAllTipoModel(){
        $sec = new TipoDAO();
        return $sec->getAllTipo();
    }
    
 
}
?>
