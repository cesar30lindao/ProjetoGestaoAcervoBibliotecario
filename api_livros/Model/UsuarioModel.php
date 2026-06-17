<?php
class UsuarioModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function loginUser($email, $senha) {
        // Ajustado para bater com 'Usuarios' (Maiúsculo) do seu script
        $stmt = $this->db->prepare("
            SELECT id_usuario, nome, email 
            FROM Usuarios 
            WHERE email = :email AND senha = :senha
        ");
        
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>