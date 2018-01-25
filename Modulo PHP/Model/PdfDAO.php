<?php


class PdfDAO{
    
    public function salvarPdf(Pdf $secao){
        
       $SQL = "INSERT INTO pdf (nomePdf) VALUES (";
        $SQL.="?)";
        
        $DB = new DB();
        $DB->getConnection();
        $pstm = $DB->execSQL($SQL);
        $sec = $secao->getNomePdf();
        
        $pstm->bind_param("s", $sec);
        
        if($pstm->execute()){
            return true;
        }else{
            return false;
        }
        
    }
    
    
     public function idPdf(){
        $SQL = "SELECT * FROM pdf";
        
        $DB = new DB();
        $DB->getConnection();
        $query = $DB->execReader($SQL);
        $retorno = mysqli_num_rows($query);
        
        	return $retorno;
        
    }
    
     
    }
    


?>
