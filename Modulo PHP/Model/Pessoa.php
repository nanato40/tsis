<?php

class Pessoa{
    private $id_pessoa;
    private $nome;
    private $sexo;
    
    
    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getNome() {
        return $this->nome;
    }

    function getSexo() {
        return $this->sexo;
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }


    
}

?>

