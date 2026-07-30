<?php

namespace App\Models;

use Core\Model;

class Usuario extends Model {
    public function listar() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}