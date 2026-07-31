<?php

$rotas = [
    '/' => ['controller' => 'HomeController', 'action' => 'index'],
    '/usuarios' => ['controller' => 'UsuarioController', 'action' => 'index'],
    '/usuarios/criar' => ['controller' => 'UsuarioController', 'action' => 'create'],
    '/usuarios/editar' => ['controller' => 'UsuarioController', 'action' => 'edit'],
    '/usuarios/salvar' => ['controller' => 'UsuarioController', 'action' => 'save'],
    '/usuarios/excluir' => ['controller' => 'UsuarioController', 'action' => 'delete'],
    '/livros' => ['controller' => 'LivroController', 'action' => 'index'],
];