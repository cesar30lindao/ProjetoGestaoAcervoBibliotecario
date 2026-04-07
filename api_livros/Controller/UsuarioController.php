<?php

class UserController {
    public function dashboard($rota) {
        global $db; // Puxa a variável de conexão criada no index.php

        $stmt = $db->prepare("SELECT nome, nivel, cor FROM usuarios WHERE rota = :rota");
        $stmt->execute(['rota' => $rota]);
        $dados = $stmt->fetch();

        if (!$dados) {
            http_response_code(404);
            echo "<h1>Ops! Rota 404 — Perfil não encontrado no banco</h1>";
            exit;
        }

        include 'app/Views/dashboard.php';
        
        // Configurações do Banco de Dados
        $host = 'localhost';
        $db   = 'sistema_perfis';
        $user = 'root'; // ajuste conforme seu ambiente
        $pass = '';     // ajuste conforme seu ambiente

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            
            // Busca os dados no banco filtrando pela rota
            $stmt = $pdo->prepare("SELECT nome, nivel, cor FROM usuarios WHERE rota = :rota");
            $stmt->execute(['rota' => $rota]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            // Tratamento de Erro (se a rota não existir no banco)
            if (!$dados) {
                http_response_code(404);
                echo "<h1>Ops! Rota 404 — Página não encontrada</h1>";
                exit;
            }

            // Carrega a View Única (os dados do banco estarão na variável $dados)
            include 'app/Views/dashboard.php';

            // Dentro da função dashboard ou em uma nova função
            if ($rota === 'login') {
                include 'app/Views/login.php'; // Certifique-se de que o arquivo existe neste caminho
                exit;
            }
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}