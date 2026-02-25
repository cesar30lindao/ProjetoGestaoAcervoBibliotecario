<?php
    require_once 'db.php';
    try{
        $database = new Database();
        $db = $database->getConnection();
        if($db){
            echo "Sucesso: A ponte com o Banco de Dados funcionou!<br>";
        }
    }catch(Exception $e){
        echo "Erro: Algo deu errado com a conexão ao Banco de Dados.<br>";
    };
    $livros = [];
    $stmt = $db->query("SELECT * FROM Livros");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $livros[]= $row;
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>