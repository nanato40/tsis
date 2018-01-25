<?php

class Usuario extends Pessoa{
    private $id_usuario;
    private $email;
    private $senha;
    private $secao_id;
    private $pessoa_id;
    private $tipoUsuario;
    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getSecao_id() {
        return $this->secao_id;
    }

    function getPessoa_id() {
        return $this->pessoa_id;
    }
    
    function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setSecao_id($secao_id) {
        $this->secao_id = $secao_id;
    }

    function setPessoa_id($pessoa_id) {
        $this->pessoa_id = $pessoa_id;
    }
    
    function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }


    
}

?>

