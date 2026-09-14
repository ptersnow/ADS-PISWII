<?php

namespace App\Models;

use Core\Model;
use Core\Auth;

class Chamado extends Model {
    public function listarPorPerfil() {
        $perfil = Auth::role();
        $usuarioId = $_SESSION['usuario_id'];

        if ($perfil === 'user') {
            $stmt = $this->db->prepare("SELECT c.*, cat.nome as categoria
                                        FROM chamados c
                                        JOIN categorias cat ON c.categoria_id = cat.id
                                        WHERE c.usuario_id = :id
                                        ORDER BY c.id DESC");
            $stmt->execute([':id' => $usuarioId]);
            return $stmt->fetchAll();
        }

        if ($perfil === 'support') {
            $stmt = $this->db->prepare("SELECT c.*, cat.nome as categoria
                                        FROM chamados c
                                        JOIN categorias cat ON c.categoria_id = cat.id
                                        WHERE c.tecnico_id = :id OR c.tecnico_id IS NULL
                                        ORDER BY c.id DESC");
            $stmt->execute([':id' => $usuarioId]);
            return $stmt->fetchAll();
        }

        $stmt = $this->db->query("SELECT c.*, cat.nome as categoria
                                  FROM chamados c
                                  JOIN categorias cat ON c.categoria_id = cat.id
                                  ORDER BY c.id DESC");
        return $stmt->fetchAll();
    }

    public function obterEstatisticasPorPerfil() {
        $perfil = Auth::role();
        $usuarioId = $_SESSION['usuario_id'];

        // Query base com a contagem de cada status + total geral
        $sql = "SELECT 
                    COUNT(*) as total,
                    COUNT(CASE WHEN c.status = 'Aberto' THEN 1 END) as abertos,
                    COUNT(CASE WHEN c.status = 'Em Atendimento' OR c.status = 'In Progress' THEN 1 END) as em_atendimento,
                    COUNT(CASE WHEN c.status = 'Concluído' OR c.status = 'Closed' THEN 1 END) as concluidos
                FROM chamados c";

        // Regra 1: Solicitante (User) -> Conta apenas seus próprios chamados
        if ($perfil === 'user') {
            $sql .= " WHERE c.usuario_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $usuarioId]);
            return $stmt->fetch();
        }

        // Regra 2: Suporte Técnico (Support) -> Conta chamados atribuídos a ele ou sem técnico
        if ($perfil === 'support') {
            $sql .= " WHERE c.tecnico_id = :id OR c.tecnico_id IS NULL";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $usuarioId]);
            return $stmt->fetch();
        }

        // Regra 3: Operação / Admin -> Conta global de todo o sistema
        $stmt = $this->db->query($sql);
        return $stmt->fetch();
    }

    public function buscarPorId($id) {
        $sql = "SELECT c.*, cat.nome as categoria 
                FROM chamados c 
                JOIN categorias cat ON c.categoria_id = cat.id 
                WHERE c.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function criar($usuario_id, $categoria_id, $tecnico_id, $titulo, $descricao, $prioridade, $arquivo_anexo = null) {
        $sql = "INSERT INTO chamados (usuario_id, categoria_id, tecnico_id, titulo, descricao, prioridade, status, arquivo_anexo)
                VALUES (:usuario_id, :categoria_id, :tecnico_id, :titulo, :descricao, :prioridade, 'Aberto', :arquivo_anexo)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->bindParam(':tecnico_id', $tecnico_id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':prioridade', $prioridade);
        $stmt->bindParam(':arquivo_anexo', $arquivo_anexo);
        
        return $stmt->execute();
    }

    public function atualizar($id, $titulo, $descricao) {
        $sql = "UPDATE chamados
                SET titulo = :titulo, descricao = :descricao
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);

        $stmt->execute();
    }

    public function deletar($id) {
        $sql = "DELETE FROM chamados WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}