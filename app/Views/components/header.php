<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Sistema Web' ?></title>

    <!-- CDN do Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 antialiased">

    <!-- Barra de Navegação Reutilizável -->
    <nav class="bg-indigo-600 text-white shadow-md mb-8">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="font-bold text-xl tracking-wide">MeuSistema</a>
            <div class="space-x-4">
                <a href="/usuarios" class="hover:text-indigo-200 transition">Usuários</a>
                <a href="/produtos" class="hover:text-indigo-200 transition">Produtos</a>
            </div>
        </div>
    </nav>

    <!-- Container Principal do Conteúdo -->
    <main class="max-w-6xl mx-auto px-4">