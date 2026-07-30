<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController {
    public function index() {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->listar();
        
        require_once __DIR__ . '/../Views/usuarios/index.php';
    }
}