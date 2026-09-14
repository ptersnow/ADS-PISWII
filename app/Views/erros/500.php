<?php 
$titulo = "Erro Interno no Servidor"; 
require_once __DIR__ . '/../components/header.php'; 
?>

<div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4">
    <h1 class="text-9xl font-extrabold text-rose-600 tracking-widest">500</h1>
    <div class="bg-rose-600 text-white px-2 text-sm rounded -rotate-12 absolute font-semibold">
        Erro no Servidor
    </div>
    <p class="text-slate-600 text-lg mt-5 mb-2">
        Desculpe, ocorreu um problema interno em nossos servidores.
    </p>
    <p class="text-slate-400 text-sm mb-6">
        Nossa equipe técnica já foi notificada do erro para realizar o ajuste.
    </p>
    <a href="/" class="bg-slate-700 hover:bg-slate-800 text-white font-medium px-6 py-2.5 rounded-md transition shadow-sm">
        ← Voltar para o Início
    </a>
</div>

<?php require_once __DIR__ . '/../components/footer.php'; ?>