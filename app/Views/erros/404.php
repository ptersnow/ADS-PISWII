<?php 
$titulo = "Página Não Encontrada"; 
require_once __DIR__ . '/../components/header.php'; 
?>

<div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4">
    <h1 class="text-9xl font-extrabold text-indigo-600 tracking-widest">404</h1>
    <div class="bg-indigo-600 text-white px-2 text-sm rounded rotate-12 absolute font-semibold">
        Página não encontrada
    </div>
    <p class="text-slate-600 text-lg mt-5 mb-6">
        Ops! A página que você está procurando não existe ou foi movida.
    </p>
    <a href="/" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-md transition shadow-sm">
        ← Voltar para o Início
    </a>
</div>

<?php require_once __DIR__ . '/../components/footer.php'; ?>