<?php
header('Content-Type: application/json; charset=utf-8');
$origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
header('Access-Control-Allow_Origin: ' . $origin);
header('Access_Control-Allow_Methods: GET, POST, DELETE, OPTIONS');
header('Access_Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once 'app/Controllers/UsuarioController.php';

// Pega apenas a última parte da URL (ex: admin, usuario ou suporte)
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($url, '/'));
$route = end($parts);

$controller = new UsuarioController();
$controller->dashboard($route);

//recuperar url, limpa a url, e prepara para rota configuracao de rotas
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = basename($path);
$method = $_SERVER['REQUEST_METHOD'];

try{
    switch ($route) {
        case 'health':
            echo json_encode([
                'status' => 'ok - Sistema online',
                ]);
            http_response_code(200);
        case 'login':
            if ($method === 'POST') {
                $usuarioController = new $usuarioController($db);
                $usuarioController->loginUsuario();

            }
    } 
    
    }catch (Throwable $e) {
            http_response_code(500);
            echo json_encode([
                    'error' => 'Erro interno do servidor',
                    'details' => $e->getMessage()
                ]);

    }
?>