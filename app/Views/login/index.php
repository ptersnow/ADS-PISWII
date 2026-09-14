<?php
$title = "Sign In - TechDesk";
require_once __DIR__ . '/../components/header.php';
?>


<!-- Card Centralizador (Proporção idêntica ao Figma) -->
    <div class="bg-brand-primary w-full rounded-sm p-8 flex flex-col justify-between items-center shadow-2xl">
        
        <!-- Título TechDesk (Em itálico e negrito) -->
        <div class="mt-4">
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


<?php
require_once __DIR__ . '/../components/footer.php';
?>