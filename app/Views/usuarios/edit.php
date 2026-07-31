<?php

    $titulo = "Editar Usuário";
    require_once __DIR__ . '/../components/header.php';

?>

<div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Editar Usuário</h1>
        <a href="/usuarios" class="text-sm text-slate-500 hover:text-slate-700">← Voltar</a>
    </div>

    <form  action="/usuarios/salvar" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>" />

        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Nome:</label>
            <input type="text" name="nome"
                value="<?php echo htmlspecialchars($usuario['nome']); ?>"
                class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Email:</label>
            <input type="email" name="email"
                value="<?php echo htmlspecialchars($usuario['email']); ?>"
                class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />
        </div>

        <div class="flex items-center space-x-3 pt-2">
            <button type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 shadow-sm">
                Salvar Alterações
            </button>
            <a href="/usuarios" 
               class="px-4 py-2 border border-slate-300 text-slate-600 rounded-md hover:bg-slate-50 transition duration-150">
                Cancelar
            </a>
        </div>
    </form>
</div>

<?php

    require_once __DIR__ . '/../components/footer.php';

?>