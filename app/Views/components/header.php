<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Sistema Web' ?></title>

    <!-- CDN do Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
            extend: {
                colors: {
                brand: {
                    primary: '#3066BE',
                    secondary: '#963484',
                    light: '#60AFFF',
                },
                techbg: '#F2F5FF',
                status: {
                    aberto: '#F49097',
                    atendimento: '#F5E960',
                    concluido: '#55D6C2',
                },
                accent: '#DFB2F4'
                }
            }
            }
        }
    </script>

    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-techbg text-slate-800 antialiased font-sans min-h-screen flex flex-col">

    <?php
        if (isset($_SESSION['usuario_id'])) {
    ?>            
        <!-- Barra de Navegação Reutilizável -->
        <nav class="bg-brand-primary text-white flex items-center justify-between px-6 shadow-md z-20 mb-8">
            <div class="max-w-xl px-4 py-3">
                <a href="/" class="ftext-3xl font-extrabold italic tracking-wider">TechDesk</a>
            </div>

            <div class="flex items-center space-x-6">
                <button class="hover:text-brand-light transition relative">
                    <i data-lucide="bell" class="w-6 h-6"></i>
                    <span class="absolute -top-1 -right-1 bg-status-aberto w-2.5 h-2.5 rounded-full"></span>
                </button>
                <a href="/perfil" class="hover:text-brand-light transition" title="Meu Perfil">
                    <i data-lucide="user" class="w-6 h-6"></i>
                </a>
                <a href="/logout" class="hover:text-brand-light transition" title="Sair do Sistema">
                    <i data-lucide="log-out" class="w-6 h-6"></i>
                </a>
            </div>
        </nav>

        <div class="flex flex-1">

            <!-- MENU LATERAL SIDEBAR (250px) -->
            <aside class="bg-sidebar p-4 flex flex-col justify-between shrink-0 shadow-inner">
                <nav class="space-y-3">
                    
                    <!-- Item: Dashboard -->
                    <a href="/" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-300 transition">
                        <i data-lucide="layout-grid" class="w-5 h-5"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- Item: New Ticket -->
                    <a href="/chamados/criar" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-300 transition">
                        <i data-lucide="ticket-plus" class="w-5 h-5"></i>
                        <span>Novo Chamado</span>
                    </a>

                    <!-- Item: My Ticket -->
                    <a href="/chamados" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg font-semibold text-slate-800 hover:bg-slate-300 transition">
                        <i data-lucide="ticket" class="w-5 h-5"></i>
                        <span>Meus Chamados</span>
                    </a>

                </nav>
            </aside>

    <?php
        }
        else {
    ?>
        <div class="flex flex-1">
    <?php
        }
    ?>


        <!-- Container Principal do Conteúdo -->
        <main class="flex-1 p-8 bg-techbg overflow-y-auto">