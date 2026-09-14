<?php

namespace App\Models;

use Core\Auth;
use Core\Model;

class Usuario extends Model {
    public function listar() {
        $sql = "SELECT id, nome, email, perfil, criado_em FROM usuarios";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function buscarPorId($id) {
        $sql = "SELECT id, nome, email, perfil, criado_em FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function criar($nome, $email, $senhaHash, $perfil = 'usuario') {
        $sql = "INSERT INTO usuarios (nome, email, senha, perfil) VALUES (:nome, :email, :senha, :perfil)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':perfil', $perfil);
        return $stmt->execute();
    }

    public function atualizar($id, $nome, $email) {
        $sql = "UPDATE usuarios
                SET nome = :nome, email = :email
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
    }

    public function deletar($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function autenticar($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuarioEncontrado = $stmt->fetch();

        if ($usuarioEncontrado && password_verify($senha, $usuarioEncontrado['senha'])) {
            Auth::login($usuarioEncontrado);
            return true;
        }
        
        return false;
    }
}