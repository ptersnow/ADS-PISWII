<?php

namespace App\Controllers;

use App\Models\Usuario;

class PerfilController {
    public function __construct() {
    }

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
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Método não permitido.";
            return;
        }

        $id = $_POST['id'] ?? null;
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $erros = [];

        if (empty($nome)) {
            $erros[] = "O campo nome é obrigatório.";
        }

        if (!$id && empty($senha)) {
            $erros[] = "O campo senha é obrigatório.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "O campo e-mail deve ser um endereço de e-mail válido.";
        }

        if (!empty($erros)) {
            require_once __DIR__ . '/../Views/usuarios/create.php';
            return;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $usuarioModel = new Usuario();
        if ($id) {
            $usuarioModel->atualizar($id, $nome, $email, $senhaHash);
        } else {
            $usuarioModel->criar($nome, $email, $senhaHash);
        }

        header("Location: /usuarios");
        exit;
    }

    public function edit() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $model = new Usuario();
            $usuario = $model->buscarPorId($id);
            require_once __DIR__ . '/../Views/usuarios/edit.php';
        }
    }

    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $model = new Usuario();
            $model->deletar($id);
        }
    }
}