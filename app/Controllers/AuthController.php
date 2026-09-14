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

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            if (empty($email) || empty($senha)) {
                $erro = "Preencha todos os campos obrigatórios.";
                require_once __DIR__ . '/../Views/login/index.php';
                return;
            }

            $usuarioModel = new Usuario();
            $usuarioEncontrado = $usuarioModel->autenticar($email, $senha);

            if ($usuarioEncontrado) {
                header('Location: /dashboard');
                exit();
            } else {
                $erro = "Usuário ou senha inválidos.";
                require_once __DIR__ . '/../Views/login/index.php';
                return;
            }
        } catch (Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] Erro de Autenticação: " . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/auth.log');

            http_response_code(500);
            require_once __DIR__ . '/../app/Views/erros/500.php';
            exit();
        }
    }

    public function salvarCadastro() {
        try {
            $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            $erros = [];
            if (empty($nome)) {
                $erros[] = "Nome é obrigatório.";
            }
            if (!$email) {
                $erros[] = "Informe um e-mail válido.";
            }
            if (strlen($senha) < 6) {
                $erros[] = "A senha deve ter pelo menos 6 caracteres.";
            }

            if (!empty($erros)) {
                require_once __DIR__ . '/../Views/login/signup.php';
                return;
            }

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $usuarioModel = new Usuario();
            $usuarioModel->criar($nome, $email, $senhaHash);

            header('Location: /login');
            exit();
        } catch (Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] Erro ao salvar cadastro: " . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/auth.log');

            http_response_code(500);
            require_once __DIR__ . '/../app/Views/erros/500.php';
            exit();
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /login');
        exit();
    }
}