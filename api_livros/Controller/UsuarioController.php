<?php

require_once '../Model/UsuarioModel.php';
require_once '../View/UsuarioView.php';

class UsuarioController {
    private $modelUsuario;
    private $viewUsuario;

    public function __construct($db) {
        // manipular informacoes no DB
        $this->modelUsuario = new UsuarioModel($db);
        
        // criar os elementos para o Usuario Final
        $this->viewUsuario = new UsuarioView();
    }

    public function loginUsuario() {
        // capturando email e senha do arquivo JSON (JSON -> Array)
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (isset($data['email']) && isset($data['senha'])) {
            // chamar Model passando email, senha digitado pelo usuario
            $usuario = $this->modelUsuario->loginUser($data['email'], $data['senha']);
            
            // chamar View passando resultado de Model ($usuario) e HTTP_RESPONSE 200
            $this->viewUsuario->sendResponse($usuario, 200);
        } else {
            $this->viewUsuario->sendResponse(['message' => 'Login Invalido'], 400);
        }
    }
}
?>