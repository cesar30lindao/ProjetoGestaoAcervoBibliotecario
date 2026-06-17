create database livro_db;
use livro_db;
create table Usuarios
(
id_usuario INT primary key auto_increment,
nome varchar(100) NOT NULL,
sobrenome varchar(100) NOT NULL,
email varchar(200) NOT NULL UNIQUE, 
senha varchar(255) NOT NULL 

);

-- ATIVIDADE PRATICA 1 --
create table Livros
( 
id_livro INT primary key auto_increment,
titulo varchar(100) NOT NULL,
descricao varchar(600) NOT NULL,
autor varchar(100) NOT NULL
);

create table log_movimentacao_estoque 
(
id_movimentacoes INT primary key auto_increment,
data_movimentacoes date,
tipo varchar(70) NOT NULL,
id_usuario INT,
id_livro INT,
quantidade INT NOT NULL,
CONSTRAINT fk_usuario_log FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
CONSTRAINT fk_livro_log FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
);

create table Estoque
 (
    id_estoque INT PRIMARY KEY AUTO_INCREMENT,
    id_livro INT,
    quantidade_atual INT NOT NULL,
    CONSTRAINT fk_livros_estoque FOREIGN KEY (id_livro) REFERENCES Livros(id_livro)
);
    -- atividade 2 --
 INSERT INTO Usuarios (nome, sobrenome, email, senha) VALUES
('Ana', 'Silva', 'ana@email.com', 'senha123'),
('Isa', 'Oliveira', 'isah@email.com', 'senha123'),
('Carla', 'Souza', 'carla@email.com', 'senha123'),
('Diego', 'Lima', 'diego@email.com', 'senha123'),
('Elena', 'Rosa', 'elena@email.com', 'senha123'),
('Fabio', 'Melo', 'fabio@email.com', 'senha123'),
('Gisele', 'Luz', 'gisluz@email.com', 'senha123'),
('Hugo', 'Neto', 'hugo@email.com', 'senha123'),
('Iara', 'Dias', 'iara@email.com', 'senha123'),
('João', 'Vaz', 'joao@email.com', 'senha123'),
('Karen', 'Gil', 'karen@email.com', 'senha123'),
('Lucas', 'Paz', 'lucas@email.com', 'senha123'),
('Mara', 'Ivy', 'mara@email.com', 'senha123'),
('Henry', 'Silva', 'henry@email.com', 'senha123'),
('Osmar', 'Santos', 'osmar@email.com', 'senha123');

INSERT INTO Livros (titulo, autor, descricao) VALUES
('Dom Casmurro', 'Machado de Assis', 'Uma história sobre o ciúme e a dúvida.'),
('O Alquimista', 'Paulo Coelho', 'A jornada de um pastor em busca de seu tesouro.'),
('1984', 'George Orwell', 'Uma crítica severa ao autoritarismo e vigilância.'),
('O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 'Uma fábula sobre amizade e a essência da vida.'),
('Harry Potter', 'J.K. Rowling', 'O início da saga do menino que sobreviveu.'),
('O Hobbit', 'J.R.R. Tolkien', 'A aventura de Bilbo Bolseiro na Terra Média.'),
('A Metamorfose', 'Franz Kafka', 'O dia em que um homem acorda transformado em inseto.'),
('Drácula', 'Bram Stoker', 'O clássico conto de terror do conde vampiro.'),
('Sherlock Holmes', 'Arthur Conan Doyle', 'As investigações do detetive mais famoso do mundo.'),
('O Cortiço', 'Aluísio Azevedo', 'Um retrato do naturalismo brasileiro.'),
('Capitães da Areia', 'Jorge Amado', 'A vida de meninos de rua em Salvador.'),
('A Hora da Estrela', 'Clarice Lispector', 'A história da nordestina Macabéa no Rio de Janeiro.'),
('Memórias Póstumas', 'Machado de Assis', 'Narrado por um defunto autor sobre sua própria vida.'),
('Ensaio sobre a Cegueira', 'José Saramago', 'Uma epidemia de cegueira branca atinge a humanidade.'),
('O Guia do Mochileiro', 'Douglas Adams', 'Uma comédia espacial com muitas toalhas e respostas.');

INSERT INTO Estoque (id_livro, quantidade_atual) VALUES
(1, 50), (2, 30), (3, 25), (4, 100), (5, 15),
(6, 40), (7, 10), (8, 5), (9, 20), (10, 60);

INSERT INTO Log_movimentacao_estoque 
(data_movimentacoes, tipo, id_usuario, id_livro, quantidade) VALUES
('2026-02-01', 'Entrada de Estoque', 1, 1, 10),
('2026-02-02', 'Venda Direta', 2, 2, 2),
('2026-02-03', 'Entrada de Estoque', 3, 3, 5),
('2026-02-04', 'Doação Recebida', 4, 4, 20),
('2026-02-05', 'Saída venda', 5, 5, 1),
('2026-02-06', 'Entrada de Estoque', 6, 6, 8),
('2026-02-07', 'Venda Direta', 7, 7, 3),
('2026-02-08', 'Reposição', 8, 8, 12),
('2026-02-09', 'Saída por Venda', 9, 9, 4),
('2026-02-10', 'Entrada de Estoque', 10, 10, 15);