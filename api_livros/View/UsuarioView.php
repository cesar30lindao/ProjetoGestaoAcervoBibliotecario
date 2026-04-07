<?php

class UsuarioView{
    public function exibirUsuario($usuario){
        echo json_encode($usuario);
    }

    public function exibirErro($mensagem){
        echo json_encode(['error' => $mensagem]);
    }
}

?>