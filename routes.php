<?php

$rotas = [
    '/'                        => ['controller' => 'AuthController', 'action' => 'loginForm'],

    '/login'                   => ['controller' => 'AuthController', 'action' => 'loginForm'],
    '/login/autenticar'        => ['controller' => 'AuthController', 'action' => 'autenticar'],
    '/cadastrar'               => ['controller' => 'AuthController', 'action' => 'signUpForm'],
    '/cadastrar/salvar'        => ['controller' => 'AuthController', 'action' => 'signUpSave'],
    '/logout'                  => ['controller' => 'AuthController', 'action' => 'logout'],

    '/dashboard'               => ['controller' => 'DashboardController', 'action' => 'index'],
    '/perfil'                  => ['controller' => 'PerfilController', 'action' => 'index'],
    '/perfil/atualizar'        => ['controller' => 'PerfilController', 'action' => 'update'],

    '/chamados'                => ['controller' => 'ChamadoController', 'action' => 'index'],
    '/chamados/criar'          => ['controller' => 'ChamadoController', 'action' => 'create'],
    '/chamados/salvar'         => ['controller' => 'ChamadoController', 'action' => 'store'],
    '/chamados/detalhes'       => ['controller' => 'ChamadoController', 'action' => 'show'],
    '/chamados/fechar'         => ['controller' => 'ChamadoController', 'action' => 'close'],

    '/chamados/aprovar'        => ['controller' => 'ChamadoController', 'action' => 'approveList'],
    '/chamados/aprovar/status' => ['controller' => 'ChamadoController', 'action' => 'processApprove'],
];