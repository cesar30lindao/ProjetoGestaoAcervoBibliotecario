<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conecta inicialmente sem selecionar um banco específico para podermos criá-lo
$host = "localhost";
$username = "root";
$password = "12345678"; // Altere para a sua senha se for diferente (Ex: "" ou "123456")

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h3>🔨 Recriando o banco de dados 'livro_db'...</h3>";
    
    // Cria o banco de dados exatamente com o nome do seu projeto
    $pdo->exec("CREATE DATABASE IF NOT EXISTS livro_db");
    $pdo->exec("USE livro_db");
    
    // Remove tabelas antigas para evitar conflitos de chaves estrangeiras
    $pdo->exec("DROP TABLE IF EXISTS log_movimentacao_estoque");
    $pdo->exec("DROP TABLE IF EXISTS Estoque");
    $pdo->exec("DROP TABLE IF EXISTS Livros");
    $pdo->exec("DROP TABLE IF EXISTS Usuarios");
    
    // Criação da tabela Usuarios conforme seu script
    $pdo->exec("CREATE TABLE Usuarios (
        id_usuario INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100) NOT NULL,
        sobrenome VARCHAR(100) NOT NULL,
        email VARCHAR(200) NOT NULL UNIQUE, 
        senha VARCHAR(255) NOT NULL 
    )");
    
    // Criação da tabela Livros conforme seu script
    $pdo->exec("CREATE TABLE Livros ( 
        id_livro INT PRIMARY KEY AUTO_INCREMENT,
        titulo VARCHAR(100) NOT NULL,
        descricao VARCHAR(600) NOT NULL,
        autor VARCHAR(100) NOT NULL
    )");
    
    // Criação da tabela Estoque conforme seu script
    $pdo->exec("CREATE TABLE Estoque (
        id_estoque INT PRIMARY KEY AUTO_INCREMENT,
        id_livro INT,
        quantidade_atual INT NOT NULL,
        CONSTRAINT fk_livros_estoque FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
    )");

    // Criação da tabela de Logs conforme seu script
    $pdo->exec("CREATE TABLE log_movimentacao_estoque (
        id_movimentacoes INT PRIMARY KEY AUTO_INCREMENT,
        data_movimentacoes DATE,
        tipo VARCHAR(70) NOT NULL,
        id_usuario INT,
        id_livro INT,
        quantidade INT NOT NULL,
        CONSTRAINT fk_usuario_log FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
        CONSTRAINT fk_livro_log FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
    )");
    
    echo "✅ Estrutura das tabelas criada com sucesso!<br>";

    // Inserindo os Usuários do seu exercício
    $pdo->exec("INSERT INTO Usuarios (nome, sobrenome, email, senha) VALUES
    ('Ana', 'Silva', 'ana@email.com', 'senha123'),
    ('Isa', 'Oliveira', 'isah@email.com', 'senha123'),
    ('Carla', 'Souza', 'carla@email.com', 'senha123'),
    ('Caio', 'Silva', 'caio.c.silva34@aluno.senai', '123456')");

    // Inserindo os Livros do seu exercício
    $pdo->exec("INSERT INTO Livros (titulo, autor, descricao) VALUES
    ('Dom Casmurro', 'Machado de Assis', 'Uma história sobre o ciúme e a dúvida.'),
    ('O Alquimista', 'Paulo Coelho', 'A jornada de um pastor em busca de seu tesouro.'),
    ('1984', 'George Orwell', 'Uma crítica severa ao autoritarismo e vigilância.'),
    ('O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 'Uma fábula sobre amizade e a essência da vida.'),
    ('Harry Potter', 'J.K. Rowling', 'O início da saga do menino que sobreviveu.')");

    // Inserindo o Estoque do seu exercício
    $pdo->exec("INSERT INTO Estoque (id_livro, quantidade_atual) VALUES
    (1, 50), (2, 30), (3, 25), (4, 100), (5, 15)");

    echo "<h2 style='color: green;'>🎉 Banco 'livro_db' sincronizado com o PHP com sucesso!</h2>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Erro ao gerar banco: " . $e->getMessage() . "</h2>";
}
?>