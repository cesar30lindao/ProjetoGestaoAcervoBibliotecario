<?php

// configuracoes de erro
error_reporting(E_ALL);
ini_set('display_errors', 1);

// cabecalho da API:
// definicao para retorno (API) arquivo o JSON
header('Content-Type: application/json; charset=utf-8');
$origin = $_SERVER['HTTP_ORIGIN'] ?? '*'; // API recebe requisicao de qualquer dominio
header('Access-Control-Allow-Origin: ' . $origin);
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    http_response_code(204); //requisicao OK, sem conteudo
    exit;
}

// IMPORTAÇÃO CORRIGIDA: Removido o '/app' dos caminhos
// Certifique-se de que as chamadas apontam exatamente para as pastas reais do projeto:
require_once '../config/db.php';
require_once '../Controller/UsuarioController.php';
require_once '../Controller/LivroController.php';
require_once '../Model/UsuarioModel.php';
require_once '../Model/LivroModel.php';

$database = new Database();
$db = $database->getConnection();

// recuperar URL, limpa a URL, e prepara para rota configuracao de rota
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //limpa URL
$route = basename($path); //captura a rota (/login)
$method = $_SERVER['REQUEST_METHOD']; //captura metodo HTTP (POST)

$livroController = new LivroController($db);

try {
    switch ($route) {
        case 'health':
            http_response_code(200);
            echo json_encode([
                'status'=>'ok - Sistema Online!'
            ]);
            break; // Break movido para o final do case corretamente
            
        case 'login':
            if ($method === 'POST') {
                //chamar Controller do Usuario para realizar Login
                $usuarioController = new UsuarioController($db);
                $usuarioController->loginUsuario();
            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Método não permitido em /login']);
            }
            break;
            
        case 'livro':
            if ($method === 'GET') {
                $livroController->getLivros();
                exit;
            }

            if ($method === 'POST') {
                $livroController->createLivro();
                exit;
            }

            if ($method === 'PUT'){
                $livroController->updateLivro();
                exit;
            }
            
            http_response_code(405); //nao reconhece o metodo
            echo json_encode([
                'error' => "Método não permitido em /livro"
            ]);
            break;
        
        case 'livroTitulo':
            if ($method === 'GET'){
                $livroController = new LivroController($db);
                $livroController->getLivrosPeloTitulo();
                exit;
            }
            http_response_code(405); //nao reconhece o metodo
            echo json_encode([
                'error' => "Método não permitido!"
            ]);
            break;
    }
} catch (Throwable $e) {
    http_response_code(500); //Internal Server Error
    echo json_encode([
        'error' => 'Erro interno do servidor',
        'detalhe' => $e->getMessage()
    ]);
}
?>