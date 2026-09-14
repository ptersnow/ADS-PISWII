<?php

namespace App\Controllers;

use App\Models\Usuario;

class AuthController {
    public function loginForm() {
        require_once __DIR__ . '/../Views/login/index.php';
    }

    public function autenticar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                echo "Método não permitido.";
                return;
            }

            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $usuarioModel = new Usuario();
            $usuarioEncontrado = $usuarioModel->autenticar($email, $senha);

            if ($usuarioEncontrado) {
                header('Location: /dashboard');
                exit();
            } else {
                $erro = "Usuário ou senha inválidos.";
                require_once __DIR__ . '/../Views/login/index.php';
                exit();
            }
        } catch (Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] Erro de Autenticação: " . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/auth.log');

            http_response_code(500);
            require_once __DIR__ . '/../app/Views/erros/500.php';
            exit();
        }
    }
}