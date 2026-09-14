<?php

namespace App\Controllers;

use Core\Auth;
use App\Models\Usuario;

class UsuarioController {
    public function __construct() {
        Auth::requireRole(['admin']);
    }

    public function index() {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->listar();
        require_once __DIR__ . '/../Views/usuarios/index.php';
    }
}