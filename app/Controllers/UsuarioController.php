<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController {
    public function index() {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->listar();
        
        require_once __DIR__ . '/../Views/usuarios/index.php';
    }

    public function show($id) {
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->buscarPorId($id);
        
        require_once __DIR__ . '/../Views/usuarios/show.php';
    }

    public function create() {
        require_once __DIR__ . '/../Views/usuarios/create.php';
    }

    public function save() {
        $id = $_POST['id'] ?? null;
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';

        $usuarioModel = new Usuario();
        if ($id) {
            $usuarioModel->atualizar($id, $nome, $email);
        } else {
            $usuarioModel->criar($nome, $email);
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model = new Usuario();
            $usuario = $model->buscarPorId($id);
            require_once __DIR__ . '/../Views/usuarios/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model = new Usuario();
            $model->deletar($id);
        }
    }
}