<?php

require_once "db.php";

try {
    $database = new Database();
    $db = $database->getConnection();

    if ($db) {
        echo "Conexão bem-sucedida!<br><br>";

        $query = "SELECT id, titulo, autor FROM livros";
        $stmt = $db->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<h3>Lista de Livros:</h3>";
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "ID: " . $row['id'] . " - Título: " . $row['titulo'] . " - Autor: " . $row['autor'] . "<br>";
            }
        } else {
            echo "Nenhum livro encontrado na tabela.";
        }
    }
} catch (Exception $e) {
    echo "Erro ao conectar ou consultar o banco de dados: " . $e->getMessage();
}

?>