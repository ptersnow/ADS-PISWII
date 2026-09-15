<?php

namespace App\Controllers;

use Core\Auth;
use Exception;
use App\Models\Chamado;

class ChamadoController {

    public function __construct() {
        Auth::requireLogin();
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
        $categoria_id = trim($_POST['categoria_id'] ?? '');
        $tecnico_id = $_POST['tecnico_id'] ?? null;
        $titulo = trim($_POST['titulo'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $prioridade = trim($_POST['prioridade'] ?? '');

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

        $nomeArquivoSalvo = null;
        if (isset($_FILES['arquivo_anexo']) && $_FILES['arquivo_anexo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['arquivo_anexo']['tmp_name'];
            $fileName = $_FILES['arquivo_anexo']['name'];
            $fileSize = $_FILES['arquivo_anexo']['size'];

            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'pdf'];
            $maxFileSize = 5 * 1024 * 1024; // Limitado a 5MB

            if ($fileSize > $maxFileSize) {
                $erros[] = "O arquivo excede o tamanho máximo permitido de 5MB.";
            }

            if (!in_array($fileExtension, $extensoesPermitidas)) {
                $erros[] = "Extensão de arquivo não permitida. Escolha PDF, JPG ou PNG.";
            }

            if (empty($erros)) {
                // Renomeia o arquivo para evitar sobrescrita ou nomes maliciosos
                $nomeArquivoSalvo = md5(uniqid(rand(), true)) . '.' . $fileExtension;
                $uploadFileDir = __DIR__ . '/../../public/uploads/';

                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                $destPath = $uploadFileDir . $nomeArquivoSalvo;

                if (!move_uploaded_file($fileTmpPath, $destPath)) {
                    $erros[] = "Houve um erro ao mover o arquivo para o diretório de destino.";
                }
            }
        }

        if (!empty($erros)) {
            require_once __DIR__ . '/../Views/chamados/criar.php';
            return;
        }

        try {
            // Lógica para salvar o chamado no banco de dados
            $chamadoModel = new Chamado();
            $chamadoModel->criar($usuario_id, $categoria_id, $tecnico_id, $titulo, $descricao, $prioridade, $arquivo_anexo);

            header('Location: /chamados');
            exit();
        } catch (Exception $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] Erro ao salvar chamado: " . $e->getMessage() . PHP_EOL, 3, __DIR__ . '/../../logs/app.log');
            http_response_code(500);
            require_once __DIR__ . '/../Views/erros/500.php';
            exit();
        }
    }

    public function show() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $chamado = new Chamado();
            $detalhesChamado = $chamado->buscarPorId($id);
        
            require_once __DIR__ . '/../Views/chamados/show.php';
        }
        else {
            http_response_code(404);
            require_once __DIR__ . '/../Views/erros/404.php';
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