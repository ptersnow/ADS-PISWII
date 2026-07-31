<?php 
$titulo = "Listar Usuários"; 
require_once __DIR__ . '/../components/header.php'; 
?>

<!-- Container principal com card branco e sombra suave -->
<div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
    
    <!-- Cabeçalho da página com título e botão de ação -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Usuários Cadastrados</h1>
            <p class="text-sm text-slate-500">Gerencie a lista de usuários do sistema</p>
        </div>
        
        <a href="/usuarios/criar" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-md transition duration-150 text-sm shadow-sm">
            + Novo Usuário
        </a>
    </div>

    <!-- Tabela estilizada -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Nome</th>
                    <th class="py-3 px-4">E-mail</th>
                    <th class="py-3 px-4 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="4" class="py-6 text-center text-slate-400">
                            Nenhum usuário encontrado.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($usuarios as $usuario): ?>
                        <tr class="hover:bg-slate-50 transition duration-150">
                            <td class="py-3 px-4 font-mono text-slate-500">
                                #<?php echo htmlspecialchars($usuario['id']); ?>
                            </td>
                            <td class="py-3 px-4 font-medium text-slate-900">
                                <?php echo htmlspecialchars($usuario['nome']); ?>
                            </td>
                            <td class="py-3 px-4 text-slate-600">
                                <?php echo htmlspecialchars($usuario['email']); ?>
                            </td>
                            <td class="py-3 px-4 text-center space-x-2">
                                <a href="/usuarios/editar?id=<?php echo $usuario['id']; ?>" 
                                   class="text-indigo-600 hover:text-indigo-900 font-medium">
                                   Editar
                                </a>
                                <a href="/usuarios/excluir?id=<?php echo $usuario['id']; ?>" 
                                   class="text-rose-600 hover:text-rose-900 font-medium"
                                   onclick="return confirm('Tem certeza que deseja excluir?')">
                                   Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php 
require_once __DIR__ . '/../components/footer.php'; 
?>