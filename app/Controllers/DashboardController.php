<?php

namespace App\Controllers;


use App\Models\Chamado;

class DashboardController {

    public function __construct() {
    }

    public function index() {

        $chamadoModel = new Chamado();
        $chamados = $chamadoModel->obterEstatisticasPorPerfil();

        require_once __DIR__ . '/../Views/dashboard/index.php';
    }
}