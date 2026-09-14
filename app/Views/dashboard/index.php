<?php
$titulo = "Dashboard - TechDesk"; 
require_once __DIR__ . '/../components/header.php';

?>
    <div class="flex-grow max-w-6xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Chamados Totais</h2>
                <p class="text-gray-700 text-lg"><?php echo $chamados['total']; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Chamados Abertos</h2>
                <p class="text-gray-700 text-lg"><?php echo $chamados['abertos']; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Chamados Fechados</h2>
                <p class="text-gray-700 text-lg"><?php echo $chamados['concluidos']; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Chamados Pendentes</h2>
                <p class="text-gray-700 text-lg"><?php echo $chamados['em_atendimento']; ?></p>
            </div>
        </div>
    </div>


<?php

require_once __DIR__ . '/../components/footer.php';

?>