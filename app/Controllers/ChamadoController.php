<?php

namespace App\Controllers;

use App\Models\Chamado;

class ChamadoController {

    public function __construct() {
        
    }

    public function index() {
        $chamado = new Chamado();
        $chamados = $chamado->listarPorPerfil();

        require_once __DIR__ . '/../Views/chamados/index.php';
    }

    public function create() {
        require_once __DIR__ . '/../Views/chamados/criar.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Método não permitido.";
            return;
        }

        $usuario_id = $_SESSION['usuario_id'];
        $categoria_id = $_POST['categoria_id'];
        $tecnico_id = $_POST['tecnico_id'] ?? null;
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $prioridade = $_POST['prioridade'];
        $arquivo_anexo = $_FILES['arquivo_anexo']['name'] ?? null;

        // Validação dos campos obrigatórios
        $erros = [];
        if (empty($categoria_id)) {
            $erros[] = "O campo categoria é obrigatório.";
        }
        if (empty($titulo)) {
            $erros[] = "O campo título é obrigatório.";
        }
        if (empty($descricao)) {
            $erros[] = "O campo descrição é obrigatório.";
        }
        if (empty($prioridade)) {
            $erros[] = "O campo prioridade é obrigatório.";
        }

        if (!empty($erros)) {
            require_once __DIR__ . '/../Views/chamados/criar.php';
            return;
        }

        // Lógica para salvar o chamado no banco de dados
        $chamadoModel = new Chamado();
        $chamadoModel->criar($usuario_id, $categoria_id, $tecnico_id, $titulo, $descricao, $prioridade, $arquivo_anexo);

        header('Location: /chamados');
        exit();
    }

    public function show() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $chamado = new Chamado();
            $detalhesChamado = $chamado->buscarPorId($id);
        
            require_once __DIR__ . '/../Views/chamados/show.php';
        }
    }

    public function close() {        
        require_once __DIR__ . '/../Views/chamados/close.php';
    }

    public function approveList() {
        $titulo = "Chamados para Aprovação";
        require_once __DIR__ . '/../Views/chamados/approve_list.php';
    }

    public function processApprove() {
        // Lógica para processar a aprovação do chamado
    }
}