<?php


class PessoaModel{
    
    public function insertPessoaModel(Pessoa $value){
        $dao = new PessoaDAO();
      return  $dao->salvarPessoa($value);
    }
    
    public function deleteModelPessoa(Pessoa $value){
        $pes = new PessoaDAO();
        
        return $pes->deletePessoa($value);
    }
    
        public function getByIdModelPessoa($id){
        $sec = new PessoaDAO();
        $vo = $sec->getByIdPessoa($id);        
        return $vo;
    
}
    
    public function updateModelPessoa(Pessoa $value){
        $pes = new PessoaDAO();
        
        return $pes->updatePessoa($value);
    }
    
}

?>
