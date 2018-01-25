<?php

class Secao{
    private $id_secao;
    private $nomeSecao;
    
    function getId_secao() {
        return $this->id_secao;
    }

    function getNomeSecao() {
        return $this->nomeSecao;
    }

    function setId_secao($id_secao) {
        $this->id_secao = $id_secao;
    }

    function setNomeSecao($nomeSecao) {
        $this->nomeSecao = $nomeSecao;
    }


    
    
}

?>
