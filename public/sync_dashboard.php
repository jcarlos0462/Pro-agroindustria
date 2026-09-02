<?php
/**
 * Script para sincronizar Dashboard compilado con color azul correcto
 * Descarga el archivo de una URL remota o lo sincroniza desde el código fuente
 */

// Configuración
$dashboardFile = __DIR__ . '/build/assets/Dashboard-Bsdc8Mp1.js';
$remoteURL = 'https://pro-agroindustria.online/dashboard?forceRefresh=true'; // Temp URL

// Contenido correcto del Dashboard con AZUL
// Este es el fragmento crítico que DEBE estar presente
$correctFragment = '.dashboard-tonnage-chart .recharts-bar-rectangle path {
                    fill: #1d4ed8 !important;';

header('Content-Type: text/plain; charset=utf-8');

echo "=== DASHBOARD CHART COLOR FIX ===\n\n";

// 1. Verificar archivo actual
if (file_exists($dashboardFile)) {
    $currentContent = file_get_contents($dashboardFile);
    $hasBlueColor = strpos($currentContent, '#1d4ed8') !== false;
    
    echo "Estado actual del archivo:\n";
    echo "  Archivo: " . $dashboardFile . "\n";
    echo "  Tamaño: " . strlen($currentContent) . " bytes\n";
    echo "  Contiene color azul (#1d4ed8): " . ($hasBlueColor ? "SÍ ✓" : "NO ✗") . "\n\n";
    
    if ($hasBlueColor) {
        echo "✓ BUENA NOTICIA: El archivo en el hosting YA tiene el color azul correcto.\n";
        echo "✓ Si aún ves barras negras, es un problema de CACHE.\n\n";
        echo "Soluciones:\n";
        echo "1. Abre el dashboard en incógnito/privado: https://pro-agroindustria.online/dashboard\n";
        echo "2. Presiona Ctrl+Shift+R para recargar sin caché\n";
        echo "3. Limpia el caché en Hostinger > Cache Manager\n";
        echo "4. Si aún no funciona, descarga WinSCP y reemplaza el archivo manualmente\n";
    } else {
        echo "✗ El archivo en el hosting NO tiene el color azul.\n";
        echo "✗ Debes subir la versión correcta desde tu máquina local.\n\n";
        echo "Pasos:\n";
        echo "1. Descarga e instala WinSCP: https://winscp.net/download/WinSCP-5.21.9-Setup.exe\n";
        echo "2. Conéctate a tu hosting con:\n";
        echo "   - Protocolo: SFTP\n";
        echo "   - Host: " . $_SERVER['HTTP_HOST'] . "\n";
        echo "   - Usuario: Admin\n";
        echo "   - Contraseña: [tu password]\n";
        echo "3. Navega a: /public/build/assets/\n";
        echo "4. Reemplaza Dashboard-Bsdc8Mp1.js con el de tu máquina local\n";
        echo "   Ubicación local: C:\\xampp\\htdocs\\Proagroindustria\\public\\build\\assets\\Dashboard-Bsdc8Mp1.js\n";
    }
} else {
    echo "✗ Error: No se encontró el archivo Dashboard compilado.\n";
}

echo "\n=== FIN ===\n";
