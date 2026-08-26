<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">

    <title inertia><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link rel="icon" type="image/png"
        href="<?php echo e(config('app.tenant.favicon') ? asset(config('app.tenant.favicon')) : asset('Proagro.png')); ?>">

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#1e1b4b">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="VECODE">
    <link rel="manifest" href="<?php echo e(asset('build/manifest.webmanifest')); ?>">

    <script>
        (() => {
            const basePath = '/Proagroindustria';
            const applicationPaths = /^(dashboard|sales|traffic|surveillance|documentation|scale|dock|apt|admin|clients|profile|login)(\/|$)/;

            const normalizeLinks = () => {
                document.querySelectorAll('a[href]').forEach((link) => {
                    if (link.origin !== window.location.origin) return;

                    const path = link.pathname.replace(/^\/+/, '');
                    if (path.startsWith(basePath.slice(1) + '/') || !applicationPaths.test(path)) return;

                    link.href = `${basePath}/${path}`;
                });
            };

            normalizeLinks();
            new MutationObserver(normalizeLinks).observe(document.documentElement, {
                childList: true,
                subtree: true,
            });

            const ensureProductionNavigation = () => {
                const currentPath = window.location.pathname.replace(/\/+$/, '');
                const aptPath = `${basePath}/apt`;
                const productionPath = `${basePath}/apt/production`;

                if (currentPath === aptPath) {
                    const grid = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4');
                    if (!grid || grid.querySelector('[data-production-card]')) return;

                    const card = document.createElement('a');
                    card.dataset.productionCard = 'true';
                    card.href = `${productionPath}`;
                    card.className = 'group bg-white rounded-xl shadow-md border-2 border-transparent p-8 flex flex-col items-center justify-center text-center transition-all duration-300 hover:shadow-xl hover:border-emerald-500';
                    card.innerHTML = '<div class="w-20 h-20 rounded-full flex items-center justify-center mb-6 bg-emerald-50 text-emerald-600"><span class="text-4xl">&#9881;</span></div><h3 class="text-xl font-bold text-gray-800 break-words w-full">Gestión de la producción</h3><p class="text-gray-500 mt-2 text-sm">Consultar y gestionar la producción en APT.</p>';
                    grid.appendChild(card);
                    normalizeLinks();
                    return;
                }

                if (currentPath !== productionPath) return;

                const content = document.querySelector('.py-12 > .max-w-7xl');
                if (!content || content.querySelector('[data-production-page]')) return;

                const submodules = [
                    ['Gestión de la producción', 'Control y seguimiento de la producción.', '/apt/management', 'fa-industry', 'bg-green-50 text-green-600', 'hover:border-green-500'],
                    ['Gestión de proceso de embarques', 'Seguimiento de órdenes y procesos de embarque.', '/apt/oe-tracker?module=apt&from=production', 'fa-truck', 'bg-blue-50 text-blue-600', 'hover:border-blue-500'],
                    ['Gestión de inventarios', 'Control de existencias, lotes y ubicaciones.', '/apt/lots?from=production', 'fa-boxes-stacked', 'bg-purple-50 text-purple-600', 'hover:border-purple-500'],
                    ['Gestión de maquinarias', 'Registro y mantenimiento de maquinaria operativa.', '/apt/status?from=production', 'fa-wrench', 'bg-orange-50 text-orange-600', 'hover:border-orange-500'],
                    ['Gestión de equipos envasado', 'Control de equipos y unidades de envasado.', '/apt/status-unidades?from=production', 'fa-box', 'bg-yellow-50 text-yellow-600', 'hover:border-yellow-500'],
                    ['Gestión de equipos de seguridad', 'Administración y control de equipos de seguridad.', '/apt/scanner?from=production', 'fa-shield-halved', 'bg-slate-100 text-slate-600', 'hover:border-slate-500'],
                    ['Gestión prestadores de servicios', 'Administración de proveedores y prestadores.', '/apt/status?from=production', 'fa-users', 'bg-indigo-50 text-indigo-600', 'hover:border-indigo-500'],
                    ['Gestión de requerimientos', 'Registro y seguimiento de solicitudes operativas.', '/apt/status?from=production', 'fa-circle-exclamation', 'bg-cyan-50 text-cyan-600', 'hover:border-cyan-500'],
                ];

                content.innerHTML = `<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" data-production-page="true"><div class="mb-8"><a href="${aptPath}" class="inline-flex items-center text-gray-500 hover:text-emerald-600 transition-colors bg-white px-3 py-1.5 rounded-lg border border-gray-200 shadow-sm text-sm font-medium mb-5">&larr; Volver al menú APT</a><h2 class="text-3xl font-bold text-gray-900 mb-2">Gestión de la Producción</h2><p class="text-gray-600">Selecciona un submódulo para continuar.</p></div><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">${submodules.map(([name, description, href, icon, color, hover], index) => `<a href="${basePath}${href}" class="group bg-white rounded-xl shadow-md border-2 border-transparent p-8 flex flex-col items-center justify-center text-center transition-all duration-300 hover:shadow-xl ${hover}"><div class="w-20 h-20 rounded-full flex items-center justify-center mb-6 text-3xl transition-transform group-hover:scale-110 ${color}"><i class="fa-solid ${icon}"></i></div><span class="text-sm font-semibold text-gray-500 mb-2">${index + 1}</span><h3 class="text-xl font-bold text-gray-800 break-words w-full">${name}</h3><p class="text-gray-500 mt-2 text-sm">${description}</p></a>`).join('')}</div></div>`;
                normalizeLinks();
            };

            const ensureProductionShiftForm = () => {
                const currentPath = window.location.pathname.replace(/\/+$/, '');
                const productionManagementPath = `${basePath}/apt/management`;
                if (currentPath !== productionManagementPath && currentPath !== `${basePath}/apt/status`) return;
                if (currentPath !== productionManagementPath && new URLSearchParams(window.location.search).get('from') !== 'production') return;

                if (currentPath === productionManagementPath) {
                    document.title = 'Gestión de la Producción';
                    const headerTitle = document.querySelector('header h1');
                    if (headerTitle) headerTitle.textContent = 'Gestión de la Producción';
                }
                if (document.querySelector('[data-production-shift-form]')) return;

                const dashboard = document.querySelector('.max-w-7xl.mx-auto.py-8');
                if (!dashboard) return;

                const form = document.createElement('section');
                form.dataset.productionShiftForm = 'true';
                form.className = 'max-w-7xl mx-auto mb-8 overflow-hidden rounded-3xl border border-sky-200 bg-white shadow-xl';
                form.style.cssText = 'max-width:1200px;margin:0 auto 32px;overflow:hidden;border-radius:24px;border:1px solid #bae6fd;background:#fff;box-shadow:0 20px 45px -24px rgba(15,23,42,.45);';
                form.innerHTML = `
                    <div data-shift-header style="display:flex;align-items:center;justify-content:space-between;gap:16px;padding:22px 28px;background:linear-gradient(110deg,#0369a1,#1d4ed8);color:#fff;">
                        <div><p style="margin:0;color:#e0f2fe;font-size:11px;font-weight:900;letter-spacing:2px;text-transform:uppercase;">Gestión de la producción</p><h2 style="margin:5px 0 0;color:#fff;font-size:28px;font-weight:900;">Registro de inicio de turno</h2></div>
                        <span data-shift-saved style="display:none;align-items:center;gap:8px;border-radius:999px;background:rgba(52,211,153,.2);padding:7px 12px;color:#d1fae5;font-size:12px;font-weight:800;">&#10003; Guardado</span>
                    </div>
                    <form data-shift-inner-form class="grid gap-6 p-6 lg:grid-cols-3" style="padding:28px;">
                        <div class="space-y-5">
                            <label class="block text-sm font-black uppercase tracking-wide text-sky-700">Usuario asignado<select data-shift-user required class="mt-2 w-full rounded-xl border-sky-200 px-4 py-3 font-semibold text-slate-700"><option value="">Seleccionar</option><option value="<?php echo e(auth()->id()); ?>"><?php echo e(auth()->user()->name ?? 'Usuario actual'); ?></option></select></label>
                            <label class="block text-sm font-black uppercase tracking-wide text-sky-700">Turno<select data-shift-turn required class="mt-2 w-full rounded-xl border-sky-200 px-4 py-3 font-semibold text-slate-700"><option value="">Seleccionar</option><option>Turno 1</option><option>Turno 2</option><option>Turno 3</option><option>Turno 1A</option><option>Turno 1B</option></select></label>
                        </div>
                        <div class="space-y-5">
                            <label class="block text-sm font-black uppercase tracking-wide text-sky-700">Puesto<input value="Automático" readonly class="mt-2 w-full rounded-xl border-sky-200 bg-slate-50 px-4 py-3 font-semibold text-slate-500" /></label>
                            <label class="block text-sm font-black uppercase tracking-wide text-sky-700">Lote en recepción<select data-shift-lot required class="mt-2 w-full rounded-xl border-sky-200 px-4 py-3 font-semibold text-slate-700"><option value="">Seleccionar</option><option>Lote 1</option><option>Lote 2</option><option>Lote 3</option></select></label>
                        </div>
                        <div class="flex flex-col justify-between gap-5">
                            <div style="border:1px solid #bae6fd;border-radius:12px;background:#f8fafc;padding:13px 16px;font-weight:700;color:#64748b;">&#128197; Fecha: ${new Date().toLocaleDateString('es-MX')}</div>
                            <button type="button" data-shift-camera-button style="display:flex;min-height:82px;width:100%;align-items:center;justify-content:center;gap:12px;border:2px dashed #bae6fd;border-radius:16px;background:#f0f9ff;padding:16px;color:#0369a1;font-size:13px;font-weight:900;cursor:pointer;"><i class="fa-solid fa-camera" style="font-size:26px;"></i><span data-shift-photo-label>ACTIVAR CÁMARA</span></button>
                            <div data-shift-camera-panel class="relative hidden overflow-hidden rounded-xl bg-black" style="border-radius:20px;box-shadow:0 0 0 4px #e0f2fe,0 18px 35px -15px rgba(15,23,42,.5);"><video data-shift-video autoplay playsinline muted class="h-48 w-full object-cover"></video><button type="button" data-shift-close class="absolute right-3 top-3 rounded-full bg-black/60 px-3 py-2 text-white">&#10005;</button><div class="absolute inset-x-0 bottom-0 flex items-center justify-between bg-gradient-to-t from-black/90 to-transparent p-4 pt-10"><span class="text-xs font-bold text-white"><i class="fa-solid fa-circle" style="color:#34d399;font-size:8px;"></i> Cámara activa</span><button type="button" data-shift-capture class="rounded-xl bg-sky-500 px-4 py-2 text-xs font-black text-white">CAPTURAR</button></div></div>
                            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-sky-600 px-5 py-3 font-black text-white shadow-lg hover:bg-sky-700">&#128190; Guardar</button>
                        </div>
                    </form>`;

                const innerForm = form.querySelector('[data-shift-inner-form]');
                const saved = form.querySelector('[data-shift-saved]');
                const cameraButton = form.querySelector('[data-shift-camera-button]');
                const cameraPanel = form.querySelector('[data-shift-camera-panel]');
                const video = form.querySelector('[data-shift-video]');
                let cameraStream = null;
                let capturedEvidence = null;
                cameraButton.addEventListener('click', async () => {
                    try {
                        cameraStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: { ideal: 'environment' } }, audio: false });
                        video.srcObject = cameraStream;
                        cameraPanel.classList.remove('hidden');
                        cameraButton.classList.add('hidden');
                    } catch {
                        form.querySelector('[data-shift-photo-label]').textContent = 'Permiso de cámara requerido';
                    }
                });
                const closeCamera = () => {
                    cameraStream?.getTracks().forEach((track) => track.stop());
                    cameraStream = null;
                    cameraPanel.classList.add('hidden');
                    cameraButton.classList.remove('hidden');
                };
                form.querySelector('[data-shift-close]').addEventListener('click', closeCamera);
                form.querySelector('[data-shift-capture]').addEventListener('click', () => {
                    const canvas = document.createElement('canvas');
                    canvas.width = video.videoWidth || 1280;
                    canvas.height = video.videoHeight || 720;
                    canvas.getContext('2d')?.drawImage(video, 0, 0, canvas.width, canvas.height);
                    capturedEvidence = canvas.toDataURL('image/jpeg', 0.85);
                    form.querySelector('[data-shift-photo-label]').textContent = 'Evidencia capturada';
                    closeCamera();
                });
                innerForm.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    const payload = new FormData();
                    payload.append('user_id', form.querySelector('[data-shift-user]').value);
                    payload.append('position', 'Automático');
                    payload.append('shift', form.querySelector('[data-shift-turn]').value);
                    payload.append('lot_id', form.querySelector('[data-shift-lot]').value);
                    if (capturedEvidence) {
                        const evidenceBlob = await fetch(capturedEvidence).then((response) => response.blob());
                        payload.append('evidence', evidenceBlob, `evidencia-${Date.now()}.jpg`);
                    }
                    const xsrf = decodeURIComponent(document.cookie.split('; ').find((cookie) => cookie.startsWith('XSRF-TOKEN='))?.split('=')[1] || '');
                    fetch(`${basePath}/apt/management/turno`, {
                        method: 'POST',
                        body: payload,
                        headers: { 'X-XSRF-TOKEN': xsrf, 'X-Requested-With': 'XMLHttpRequest' },
                    }).then((response) => {
                        if (!response.ok) throw new Error('No se pudo guardar');
                        saved.style.display = 'inline-flex';
                    }).catch(() => {
                        form.querySelector('[data-shift-photo-label]').textContent = 'Error al guardar el registro';
                    });
                });
                dashboard.style.display = 'none';
                dashboard.before(form);
            };

            const watchProductionNavigation = () => {
                const updateProductionNavigation = () => {
                    ensureProductionNavigation();
                    ensureProductionShiftForm();
                };

                updateProductionNavigation();
                new MutationObserver(updateProductionNavigation).observe(document.body, {
                    childList: true,
                    subtree: true,
                });
            };

            if (document.body) {
                watchProductionNavigation();
            } else {
                document.addEventListener('DOMContentLoaded', watchProductionNavigation, { once: true });
            }

            document.addEventListener('click', (event) => {
                const link = event.target.closest?.('a');
                if (!link || link.origin !== window.location.origin) return;

                const path = link.pathname.replace(/^\/+/, '');
                const localPath = path.startsWith(basePath.slice(1) + '/')
                    ? path.slice(basePath.length)
                    : `/${path}`;
                const applicationPath = localPath.replace(/^\/+/, '');
                if (!applicationPaths.test(applicationPath)) return;

                const productionPage = `${basePath}/apt/production`;
                const productionSubmodule = /^\/Proagroindustria\/apt\/(status|status-unidades|scanner|lots|oe-tracker)(\/|$)/;
                const cameFromProduction = new URLSearchParams(window.location.search).get('from') === 'production';
                const aptMenuPath = path === 'apt' || path === `${basePath.slice(1)}/apt`;
                if (cameFromProduction && productionSubmodule.test(window.location.pathname) && aptMenuPath) {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    window.location.assign(productionPage);
                    return;
                }

                if (window.location.pathname.replace(/\/+$/, '') === productionPage && productionSubmodule.test(link.pathname)) {
                    const target = new URL(link.href, window.location.origin);
                    target.searchParams.set('from', 'production');
                    window.location.assign(`${target.pathname}${target.search}${target.hash}`);
                    return;
                }

                event.preventDefault();
                event.stopImmediatePropagation();
                window.location.assign(`${basePath}/${applicationPath}${link.search}${link.hash}`);
            }, true);

            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.getRegistrations().then((registrations) => {
                    registrations.forEach((registration) => registration.unregister());
                });
            }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Tighten\Ziggy\BladeRouteGenerator')->generate(); ?>
    <!-- Cache Buster: v=3.1-migration-fix -->
    <?php echo app('Illuminate\Foundation\Vite')->reactRefresh(); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.tsx'); ?>
    <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->head; } ?>
</head>

<body class="font-sans antialiased">
    <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->body; } elseif (config('inertia.use_script_element_for_initial_page')) { ?><script data-page="app" type="application/json"><?php echo json_encode($page); ?></script><div id="app"></div><?php } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\Proagroindustria\resources\views/app.blade.php ENDPATH**/ ?>