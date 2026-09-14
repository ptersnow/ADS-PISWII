<?php 
// Define uma variável para o título da aba antes de incluir o header
$titulo = "Novo Usuário"; 
require_once __DIR__ . '/../components/header.php'; 
?>

<!-- Conteúdo Específico da Página (Estilizado com Tailwind) -->
<div class="bg-white p-6 rounded-lg shadow-sm max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-slate-700 mb-4">Cadastrar Novo Usuário</h1>

    <?php if (!empty($erros)) {
        foreach ($erros as $erro) {
            echo "<div class='bg-red-100 text-red-700 p-2 mb-2 rounded'>{$erro}</div>";
        }
    }
    ?>


    <form action="/usuarios/salvar" method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Nome:</label>
            <input type="text" name="nome" 
                   class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">E-mail:</label>
            <input type="text" name="email" 
                   class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-150">
            Salvar Usuário
        </button>
    </form>
</div>

<?php 
require_once __DIR__ . '/../components/footer.php'; 
?>