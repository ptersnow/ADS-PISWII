<?php
$title = "Sign In - TechDesk";
?>
<?php
use Core\Auth;
Auth::startSession();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'TechDesk' ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

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
</head>
<body class="bg-brand-primary text-slate-800 antialiased font-sans flex flex-col">
        
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        

    <!-- Card Centralizador (Proporção idêntica ao Figma) -->
    <div class="bg-techbg w-full rounded-sm p-8 flex flex-col justify-between items-center shadow-2xl">
        
        <!-- Título TechDesk (Em itálico e negrito) -->
        <div class="my-4">
            <h1 class="text-4xl font-extrabold italic text-black tracking-wide">
                TechDesk
            </h1>
        </div>

        <!-- Formulário de Autenticação -->
        <form action="/login/autenticar" method="POST" class="w-full max-w-[420px] space-y-5 flex flex-col items-center">
            
            <!-- Exibição de Alerta de Erro de Login -->
            <?php if (!empty($erro)): ?>
                <div class="w-full bg-rose-500 text-white text-sm py-2 px-3 rounded text-center font-medium shadow">
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <!-- Campo Username / E-mail -->
            <div class="w-full">
                <input type="text" 
                       id="email" 
                       name="email" 
                       placeholder="Username" 
                       required
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       class="w-full bg-white text-slate-900 border border-slate-800 px-4 py-2.5 text-lg placeholder-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900">
            </div>

            <!-- Campo Password -->
            <div class="w-full">
                <input type="password" 
                       id="senha" 
                       name="senha" 
                       placeholder="Password" 
                       required
                       class="w-full bg-white text-slate-900 border border-slate-800 px-4 py-2.5 text-lg placeholder-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900">
            </div>

            <!-- Botão Sign In Verde -->
            <div class="pt-2 w-full flex justify-center">
                <button type="submit" 
                        class="bg-btnGreen hover:bg-btnGreenHover text-white font-medium text-lg px-12 py-2 rounded-2xl transition duration-150 shadow-md">
                    Sign In
                </button>
            </div>
        </form>

        <!-- Link para Sign Up (Alinhado à direita no rodapé do card) -->
        <div class="w-full text-right pr-6 mb-2">
            <a href="/cadastrar" class="text-black text-xl hover:underline font-normal">
                Sign Up
            </a>
        </div>

    </div>

        </main> <!-- Fecha o container do main -->

</body>
</html>