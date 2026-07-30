<?php

namespace App\Controllers;

class UsuarioController {
    public function listar() {
        $usuarios = [
            "Pedro",
            "Maria",
            "João"
        ];

        require_once __DIR__ . '/../Views/usuarios/index.php';
    }
}