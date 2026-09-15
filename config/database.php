<?php

return [
    'driver'   => 'mysql', // ou 'pgsql' para PostgreSQL
    'host'     => $_ENV['MYSQLHOST'] ?? $_ENV['DB_HOST'],
    'port'     => $_ENV['MYSQLPORT'] ?? $_ENV['DB_PORT'], // 5432 no PostgreSQL
    'dbname'   => $_ENV['MYSQLDATABASE'] ?? $_ENV['DB_NAME'],
    'username' => $_ENV['MYSQLUSER'] ?? $_ENV['DB_USER'],
    'password' => $_ENV['MYSQLPASSWORD'] ?? $_ENV['DB_PASSWORD'],
    'charset'  => 'utf8mb4'
];