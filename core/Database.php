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
                die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
            }
        }

        return self::$db;
    }
}