<?php

namespace Core;

use PDO;
use PDOException;

class Database {
    private static $db = null;

    private function __construct() {}

    public static function getConexao() {
        if (self::$db === null) {
            $config = require __DIR__ . '/../config/database.php';

            try {
                $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
                
                // Opções de segurança e boas práticas do PDO
                $opcoes = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Transforma erros do SQL em Exceções do PHP
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,     // Retorna os dados como Arrays Associativos
                    PDO::ATTR_EMULATE_PREPARES   => false,                 // Força Prepared Statements nativos (Segurança contra SQL Injection)
                ];

                self::$db = new PDO($dsn, $config['username'], $config['password'], $opcoes);

            } catch (PDOException $e) {
                error_log("[" . date('Y-m-d H:i:s') . "] Erro de Banco: " . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../logs/database.log');

                http_response_code(500);
                require_once __DIR__ . '/../app/Views/erros/500.php';
                exit;
            }
        }

        return self::$db;
    }
}