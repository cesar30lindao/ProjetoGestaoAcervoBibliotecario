<?php

class UsuarioModel {
    private $db;
    private $table = 'usuarios';

    public function __construct($db){
        $this->db = $db;
    }

    public function login($email, $senha){
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email AND senha = :senha";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>