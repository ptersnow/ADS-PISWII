<?php

namespace Core;

class Auth {

    public static function login($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['perfil'] = $usuario['perfil'];
    }

    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
    }

    public static function check() {
        return isset($_SESSION['usuario_id']);
    }

    public static function user() {
        return $_SESSION['usuario_nome'] ?? null;
    }

    public static function role() {
        return $_SESSION['perfil'] ?? null;
    }
    
    public static function requireLogin() {
        if (!self::check()) {
            header('Location: /login');
            exit();
        }
    }

    public static function requireRole(array $perfisPermitidos) {
        self::requireLogin();

        if (!in_array(self::role(), $perfisPermitidos)) {
            http_response_code(403);
            require_once __DIR__ . '/../Views/403.php';
            exit();
        }
    }
}