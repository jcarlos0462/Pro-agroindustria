<?php
// Uso: subir archivos actualizados por FTP/Administrador de archivos y luego
// visitar https://pro-agroindustria.online/deploy_refresh.php una sola vez.
// Elimina este archivo después de usarlo.

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

try {
    echo "Limpiando cachés de Laravel...\n\n";

    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    echo \Illuminate\Support\Facades\Artisan::output();

    \Illuminate\Support\Facades\Artisan::call('config:cache');
    echo \Illuminate\Support\Facades\Artisan::output();

    echo "\nListo. Verifica el sitio y luego elimina este archivo.\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
