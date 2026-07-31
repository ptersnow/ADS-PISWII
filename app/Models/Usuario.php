<?php

namespace App\Models;

use Core\Model;

class Usuario extends Model {
    public function listar() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function criar($nome, $email) {
        $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}