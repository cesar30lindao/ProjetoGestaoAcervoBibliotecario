<?php

require_once "db.php";

try {
    $database = new Database();
    $db = $database->getConnection();
    if ($db) {
        echo "Conexão bem-sucedida!";
    }
} catch (Exception $e) {
    echo "Erro ao conectar ao banco de dados.";
}

?>