<?php

class PdfModel{
    
    public function insertPdfModel(Pdf $value){
        	$dao = new PdfDAO();
        	return  $dao->salvarPdf($value);
        	
    }
    
   

}
?>
