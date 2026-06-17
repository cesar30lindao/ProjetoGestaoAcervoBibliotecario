<?php
class LivroModel {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function buscarLivros() {
        // LEFT JOIN garante que mesmo livros sem estoque apareçam com valor 0
        $stmt = $this->db->query("
            SELECT 
                l.id_livro, 
                l.titulo, 
                l.descricao, 
                l.autor,
                COALESCE(e.quantidade_atual, 0) AS estoque
            FROM Livros l 
            LEFT JOIN Estoque e ON l.id_livro = e.id_livro
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateLivro($id, $titulo, $autor, $descricao)
        $stmt

    public function getLivrosPeloTitulo($titulo){
        $stmt = $this->db->prepare("
            SELECT 
                l.id_livro, l.titulo, l.descricao, l.autor, 
                COALESCE(e.quantidade_atual, 0) AS estoque 
            FROM Livros l
            LEFT JOIN Estoque e ON e.id_livro = l.id_livro
            WHERE l.titulo LIKE :titulo
        ");
        $stmt->bindValue(':titulo', '%' . $titulo . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>