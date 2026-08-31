<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Gestión de la Producción</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('Proagro.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('Proagro.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('Proagro.png')); ?>">
    <style>
        :root {
            --sky-50: #f0f9ff;
            --sky-100: #e0f2fe;
            --sky-200: #bae6fd;
            --sky-600: #0284c7;
            --sky-700: #0369a1;
            --blue-700: #1d4ed8;
            --indigo-800: #3730a3;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-500: #64748b;
            --slate-700: #334155;
            --slate-900: #0f172a;
        }
        * { box-sizing: border-box; }
        html, body { width: 100%; min-height: 100%; margin: 0; }
        html, body, *, *::before, *::after {
            cursor: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAPzSURBVGhD7ddvaBtlGADwW6dIcrn8aTPL5e7eey/J0rTuj+Zyd7nYWTZBC4OBjDDFD/4ZzH/rbO6SNmnWxVVXlVUF8csYm5ulY/hl6wfBb6N2Vq26NVyaIdbRdnWZtritq5VCxyPRL+W++M1k7H5wX573eR54ed/nhSMIi8VisVgsFsv9a2LLFvIHUXzQHL9nTARxviCgLwt+7rMLm0LhCy0tDnNOTSsE8ImCH5UKCH8xhZnVSwKfHd282WPOq1kFjPp/CgrnC340UEK+uckAf+oPzN0ygmivObcmGZg9+Dtm7xT8aPz7R5r3XmHp8g3MLF8KCNlyILDn8tatbnNNTTGCXMAI4g+uCfjc5Y3+VyZZ+kYBcSeLHPsNCAiKPHveXFORSCTWm2NV8Xkisb7E+Zb+4lmY4ugFQ8CfToQC2hxiYJb1rZR4/u3rAb59JBymK/kNB1TJrcUGxH018nLlCaLO4PmcgfHAtB8NGEHh9R+bm5+8iTkwOPZYCTFDKwILMz7mYlhrDdlzypIjKR4196m6ScSM3UIMLPEMXEHMnIGRMSngd39mfTCPGLhGM5/UZaVhsl8FdyrWweitChCwztynKsZirK2E2NkZxKwWEXt2KoAHxzaF24wm/PQ8z8KvtO/2C8+Kr9ZlxLv2rASe9ONvuXT5uqsnVvBq8nNEPl9n7vm/mxCEUNHvf/EXjM5M8+jbqzw7OC4Iu6/yzPLCBnrcllbet/VKYO+RwKlJH1Ga9J3zcBxcGXWlQVd1giCqfxolnvsYBB5uIxZWK0PNs1DE6Kt5Gp0iemJn7T1RqHxkShzx7o9vc3dve+Lh7I7GYEe709yrKhY2MLtXGpnRcqNvaIZmTizT7PBiPZcDgnjAmZK+th+Mgr0rAqQWWQx2tD9krq++vu1NVLfcR/RKZ4hD0jkipwzR6dg7xJHWFm9SPUBmo0uVE3CkRfB2xiLm8qpBr7V63CnlOHUoBrYjKtgrdz0rgi0Xhcq9JzMiODPSaboz/jzVJV0k8wo4k6Js7lM1G5M7GJeuvOTult9wp+RjpB6ZInMy2LsjYNceBVvqsX82RXaLs15NftnZpZz2aq0hc5+qy+ehzqPLg950POlKye850mKZ7FXAnv337ldmgMxK0KjF95hra0JlMClNXHT2xaG+Q34KZXZ6PGlVp1LREYculh1J8TcyFb3jyEh3XbU0A2u5ktFRSo/ebErHqbXxlnzC0ZTeRTXsV8OOrPInlVGm/ftE19qcmuDW1F6Ppvab42vVJ2PPUIdVcOrisHmt6iovEv9m23/+AziT0oeuo23Q0KlkzGv3BABY59bV4w0d8e3mNYvFYrFYLBbLfeJvlaxaRdQ/lIsAAAAASUVORK5CYII=') 4 4, auto !important;
        }
        a, a *, button, button *, input, select, textarea, [role="button"], label, .back, .btn-save, .btn-capture {
            cursor: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAPzSURBVGhD7ddvaBtlGADwW6dIcrn8aTPL5e7eey/J0rTuj+Zyd7nYWTZBC4OBjDDFD/4ZzH/rbO6SNmnWxVVXlVUF8csYm5ulY/hl6wfBb6N2Vq26NVyaIdbRdnWZtritq5VCxyPRL+W++M1k7H5wX573eR54ed/nhSMIi8VisVgsFsv9a2LLFvIHUXzQHL9nTARxviCgLwt+7rMLm0LhCy0tDnNOTSsE8ImCH5UKCH8xhZnVSwKfHd282WPOq1kFjPp/CgrnC340UEK+uckAf+oPzN0ygmivObcmGZg9+Dtm7xT8aPz7R5r3XmHp8g3MLF8KCNlyILDn8tatbnNNTTGCXMAI4g+uCfjc5Y3+VyZZ+kYBcSeLHPsNCAiKPHveXFORSCTWm2NV8Xkisb7E+Zb+4lmY4ugFQ8CfToQC2hxiYJb1rZR4/u3rAb59JBymK/kNB1TJrcUGxH018nLlCaLO4PmcgfHAtB8NGEHh9R+bm5+8iTkwOPZYCTFDKwILMz7mYlhrDdlzypIjKR4196m6ScSM3UIMLPEMXEHMnIGRMSngd39mfTCPGLhGM5/UZaVhsl8FdyrWweitChCwztynKsZirK2E2NkZxKwWEXt2KoAHxzaF24wm/PQ8z8KvtO/2C8+Kr9ZlxLv2rASe9ONvuXT5uqsnVvBq8nNEPl9n7vm/mxCEUNHvf/EXjM5M8+jbqzw7OC4Iu6/yzPLCBnrcllbet/VKYO+RwKlJH1Ga9J3zcBxcGXWlQVd1giCqfxolnvsYBB5uIxZWK0PNs1DE6Kt5Gp0iemJn7T1RqHxkShzx7o9vc3dve+Lh7I7GYEe709yrKhY2MLtXGpnRcqNvaIZmTizT7PBiPZcDgnjAmZK+th+Mgr0rAqQWWQx2tD9krq++vu1NVLfcR/RKZ4hD0jkipwzR6dg7xJHWFm9SPUBmo0uVE3CkRfB2xiLm8qpBr7V63CnlOHUoBrYjKtgrdz0rgi0Xhcq9JzMiODPSaboz/jzVJV0k8wo4k6Js7lM1G5M7GJeuvOTult9wp+RjpB6ZInMy2LsjYNceBVvqsX82RXaLs15NftnZpZz2aq0hc5+qy+ehzqPLg950POlKye850mKZ7FXAnv337ldmgMxK0KjF95hra0JlMClNXHT2xaG+Q34KZXZ6PGlVp1LREYculh1J8TcyFb3jyEh3XbU0A2u5ktFRSo/ebErHqbXxlnzC0ZTeRTXsV8OOrPInlVGm/ftE19qcmuDW1F6Ppvab42vVJ2PPUIdVcOrisHmt6iovEv9m23/+AziT0oeuo23Q0KlkzGv3BABY59bV4w0d8e3mNYvFYrFYLBbLfeJvlaxaRdQ/lIsAAAAASUVORK5CYII=') 4 4, pointer !important;
        }
        .page {
            width: 100%;
            max-width: 80rem;
            min-height: 100vh;
            margin: 0 auto;
            padding: 2rem 1rem 2.5rem;
        }
        @media (min-width: 640px) { .page { padding-left: 1.5rem; padding-right: 1.5rem; } }
        @media (min-width: 1024px) { .page { padding-left: 2rem; padding-right: 2rem; } }
        .shell {
            overflow: hidden;
            border: 1px solid var(--slate-200);
            border-radius: 2rem;
            background: #fff;
            box-shadow: 0 20px 60px -30px rgba(15, 23, 42, .35);
        }
        .nav-row { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 18px; }
        .back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--slate-700);
            background: #fff;
            padding: 8px 16px;
            border-radius: 12px;
            border: 1px solid var(--slate-200);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .06);
            transition: all .2s;
        }
        .back:hover { color: var(--sky-700); border-color: var(--sky-200); background: var(--sky-50); }
        .back-subtle { background: transparent; border-color: transparent; box-shadow: none; color: var(--slate-500); }
        .back-subtle:hover { background: transparent; color: var(--sky-700); }
        .hero {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            width: 100%;
            padding: 1.5rem 2rem;
            background: linear-gradient(110deg, var(--sky-700), var(--blue-700) 55%, var(--indigo-800));
            color: #fff;
        }
        .hero-brand { display: flex; align-items: center; gap: 16px; }
        .hero-brand img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            background: #fff;
            border-radius: 14px;
            padding: 4px;
        }
        .hero-kicker {
            margin: 0;
            color: #e0f2fe;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .24em;
            text-transform: uppercase;
        }
        .hero h1 { margin: 4px 0 0; font-size: 1.875rem; font-weight: 900; letter-spacing: -.02em; }
        .hero-meta { display: flex; flex-wrap: wrap; gap: 8px; }
        .chip {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .chip-solid { background: #fff; color: var(--sky-700); }
        .chip-soft { background: rgba(255,255,255,.12); color: #e0f2fe; ring: 1px solid rgba(255,255,255,.2); box-shadow: inset 0 0 0 1px rgba(255,255,255,.2); }
        .panel {
            width: 100%;
            padding: 1.5rem 2rem 2rem;
            background: #fff;
        }
        .card {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem 1.5rem;
            width: 100%;
            margin-bottom: 1.25rem;
            padding: 1.25rem 1.5rem;
            border: 1px solid var(--slate-200);
            border-radius: 1.25rem;
            background: #fff;
        }
        .card:last-child { margin-bottom: 0; }
        .card-head { grid-column: 1 / -1; display: flex; flex-wrap: wrap; align-items: end; justify-content: space-between; gap: 8px; padding-bottom: 12px; border-bottom: 1px solid var(--slate-100); }
        .card-head h2 {
            margin: 0;
            color: var(--sky-700);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .card-head p { margin: 0; color: var(--slate-500); font-size: 13px; }
        .field { display: block; color: var(--sky-700); font-size: 11px; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; }
        .field input, .field select, .field textarea {
            display: block;
            width: 100%;
            margin-top: 8px;
            border: 1px solid var(--sky-200);
            border-radius: 12px;
            background: #fff;
            padding: 12px 14px;
            min-height: 48px;
            color: var(--slate-700);
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            box-shadow: 0 1px 2px rgb(15 23 42 / .05);
        }
        .field input:focus, .field select:focus, .field textarea:focus {
            border-color: var(--sky-600);
            outline: 0;
            box-shadow: 0 0 0 3px rgb(14 165 233 / .15);
        }
        .field input[readonly] { background: var(--slate-50); color: var(--slate-500); cursor: default; }
        .field textarea { min-height: 128px; resize: vertical; }
        .wide { grid-column: span 2; }
        .activity { grid-column: span 2; }
        .activity-types { display: flex; flex-wrap: wrap; align-items: end; gap: 10px; }
        .type-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--sky-200);
            border-radius: 999px;
            background: #fff;
            color: var(--sky-700);
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
        }
        .type-button:hover { background: var(--sky-50); }
        .type-button.active {
            background: var(--sky-600);
            border-color: var(--sky-600);
            color: #fff;
            box-shadow: 0 8px 18px -8px rgba(2, 132, 199, .7);
        }
        .evidence-actions, .save-activity { align-self: end; }
        .evidence-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; grid-column: span 2; }
        .action {
            border: 1px solid var(--sky-200);
            border-radius: 12px;
            background: #fff;
            padding: 12px 16px;
            font-weight: 800;
            color: var(--slate-700);
            cursor: pointer;
            transition: .2s;
        }
        .action:hover { background: var(--sky-50); border-color: var(--sky-600); }
        .action:disabled { cursor: not-allowed; opacity: .65; }
        .save-activity {
            min-width: 170px;
            background: var(--sky-600);
            border-color: var(--sky-600);
            color: #fff;
            box-shadow: 0 10px 20px -12px rgba(2, 132, 199, .8);
        }
        .save-activity:hover { background: var(--sky-700); color: #fff; }
        .evidence-status { color: var(--slate-500); font-size: 12px; font-weight: 700; }
        .evidence-status.error { color: #b42318; }
        .evidence-preview {
            width: 64px;
            height: 46px;
            border: 2px solid var(--sky-600);
            border-radius: 8px;
            object-fit: cover;
            cursor: zoom-in;
        }
        .delete-photo {
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fff1f2;
            color: #be123c;
            padding: 8px 10px;
            font-weight: 800;
            cursor: pointer;
        }
        .history { overflow: auto; }
        .history-filters {
            grid-column: 1 / -1;
            display: flex;
            flex-wrap: wrap;
            align-items: end;
            gap: 12px;
            padding: 12px 14px;
            border: 1px solid var(--sky-100);
            border-radius: 12px;
            background: var(--sky-50);
        }
        .history-filters label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--sky-700);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }
        .history-filters select, .history-filters input {
            border: 1px solid var(--sky-200);
            border-radius: 10px;
            background: #fff;
            padding: 9px 12px;
            color: var(--slate-700);
            font-weight: 700;
            text-transform: none;
        }
        .history table {
            grid-column: 1 / -1;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
            overflow: hidden;
            border: 1px solid var(--slate-200);
            border-radius: 12px;
            background: #fff;
            font-size: 13px;
        }
        .history th {
            background: var(--sky-700);
            color: #fff;
            padding: 12px 10px;
            text-align: left;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .history td {
            padding: 12px 10px;
            border-bottom: 1px solid var(--slate-100);
            color: var(--slate-700);
            word-break: break-word;
        }
        .history tr:nth-child(even) td { background: var(--slate-50); }
        .empty-history { text-align: center !important; color: var(--slate-500) !important; font-weight: 700; padding: 28px !important; }
        .camera-panel {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, .78);
            padding: 20px;
        }
        .camera-frame {
            width: min(100%, 430px);
            overflow: hidden;
            border-radius: 24px;
            background: #050b12;
            border: 1px solid rgba(255,255,255,.2);
            box-shadow: 0 25px 60px rgba(0,0,0,.45);
        }
        .camera-toolbar { display: flex; align-items: center; justify-content: space-between; padding: 13px 16px; color: #fff; font-weight: 800; }
        .camera-panel video { display: block; width: 100%; max-height: 62vh; min-height: 240px; background: #000; object-fit: cover; }
        .camera-actions { display: flex; justify-content: space-between; gap: 8px; padding: 14px; background: #0b1d2a; }
        .camera-actions .action { color: #fff; background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.3); }
        .camera-actions [data-camera-capture] { background: var(--sky-600); border-color: var(--sky-600); }
        .photo-modal { display: none; position: fixed; inset: 0; z-index: 1200; align-items: center; justify-content: center; background: rgba(15,23,42,.82); padding: 22px; }
        .photo-modal.open { display: flex; }
        .photo-dialog { position: relative; max-width: min(92vw, 900px); max-height: 90vh; border-radius: 18px; background: #071b2a; padding: 12px; box-shadow: 0 25px 70px rgba(0,0,0,.5); }
        .photo-dialog img { display: block; max-width: 86vw; max-height: 82vh; border-radius: 10px; object-fit: contain; }
        .photo-close { position: absolute; right: -12px; top: -12px; width: 34px; height: 34px; border: 1px solid #fff; border-radius: 50%; background: var(--sky-600); color: #fff; font-size: 19px; font-weight: 900; cursor: pointer; }
        @media (max-width: 1100px) {
            .history table { table-layout: auto; min-width: 960px; }
        }
        @media (max-width: 850px) {
            .card { grid-template-columns: repeat(2, minmax(0, 1fr)); padding: 16px; }
            .wide, .activity, .evidence-actions { grid-column: span 2; }
            .page { padding: 1rem .75rem 1.5rem; }
            .shell { border-radius: 1.25rem; }
            .hero { padding: 1rem 1.25rem; }
            .hero h1 { font-size: 1.5rem; }
            .panel { padding: .75rem 1rem 1.25rem; }
        }
        @media (max-width: 520px) {
            .card { grid-template-columns: 1fr; }
            .wide, .activity, .evidence-actions { grid-column: span 1; }
        }
    </style>
</head>
<body>
<div class="page">
    <div class="nav-row">
        <a class="back" href="<?php echo e(route('apt.management')); ?>">← Volver a inicio de turno</a>
        <a class="back" href="<?php echo e(route('apt.production')); ?>">← Volver a Gestión de almacenes</a>
    </div>
    <div class="shell">
    <header class="hero">
        <div class="hero-brand">
            <img src="<?php echo e(asset('Proagro.png')); ?>" alt="Proagroindustria">
            <div>
                <p class="hero-kicker">Módulo operativo · APT</p>
                <h1>Gestión de la producción</h1>
            </div>
        </div>
        <div class="hero-meta">
            <span class="chip chip-solid">Generación de lote</span>
            <span class="chip chip-soft">Paso 2 de 3</span>
        </div>
    </header>
    <main class="panel" data-shift-id="<?php echo e($registration->id ?? ''); ?>">
        <section class="card">
            <div class="card-head">
                <h2>Personal a cargo</h2>
                <p>Datos del operador asignado al turno.</p>
            </div>
            <label class="field">Usuario asignado<input readonly value="<?php echo e(optional(optional($registration)->user)->name); ?>"></label>
            <label class="field">Puesto<input readonly value="<?php echo e(optional($registration)->position); ?>"></label>
            <label class="field">Turno<input readonly value="<?php echo e(optional($registration)->shift); ?>"></label>
            <label class="field">Fecha<input readonly value="<?php echo e(optional(optional($registration)->started_at)->format('d/m/Y')); ?>"></label>
        </section>
        <section class="card">
            <div class="card-head">
                <h2>Información de lote de producción en proceso</h2>
                <p><?php echo e($registration ? 'Identificación del lote activo en recepción.' : 'El lote permanece vacío hasta que el Jefe de Almacén te asigne uno.'); ?></p>
            </div>
            <label class="field wide">No. de lote<input readonly value="<?php echo e(optional(optional($registration)->lot)->folio); ?>"></label>
            <label class="field">Producto<input readonly value="<?php echo e(str_contains(strtoupper((string) optional(optional($registration)->lot)->plant_origin), 'UREA') ? 'UREA AGRICOLA' : (optional(optional($registration)->lot)->folio ? 'Automático' : '')); ?>"></label>
            <label class="field">Origen<input readonly value="<?php echo e(optional(optional($registration)->lot)->plant_origin); ?>"></label>
            <label class="field">Disposición<input readonly value="<?php echo e(optional(optional($registration)->lot)->warehouse); ?>"></label>
            <label class="field">Inicio<input readonly value="<?php echo e(optional(optional($registration)->started_at)->format('d/m/Y')); ?>"></label>
            <label class="field">Final<input readonly value="<?php echo e($registration ? 'EN PROCESO' : ''); ?>"></label>
            <label class="field">Cierre de lote<select><option>Seleccionar</option></select></label>
        </section>
        <section class="card" data-activity-form>
            <div class="card-head">
                <h2>Registro de actividades del turno</h2>
                <p>La hora se actualiza hasta el momento de guardar.</p>
            </div>
            <div class="field wide activity-types" role="group" aria-label="Tipo de registro">
                Tipo
                <div>
                    <button type="button" class="type-button active" data-type="incidencia" aria-pressed="true"><span class="type-mark" aria-hidden="true">◉</span> Incidencias</button>
                    <button type="button" class="type-button" data-type="relevancia" aria-pressed="false"><span class="type-mark" aria-hidden="true">◯</span> Relevancias</button>
                </div>
            </div>
            <label class="field">Hora<input data-activity-time readonly value=""></label>
            <label class="field activity">Captura<textarea placeholder="Captura la incidencia"></textarea></label>
            <label class="field">Ubicación<input data-activity-location placeholder="EJEM. C21-C22"></label>
            <div class="evidence-actions">
                <button class="action" data-evidence-button type="button">＋ 📷 Evidencia fotográfica</button>
                <span data-evidence-status class="evidence-status">Sin evidencia</span>
                <img data-evidence-preview class="evidence-preview" alt="Abrir evidencia fotográfica" hidden>
                <button class="delete-photo" data-delete-photo type="button" hidden>Eliminar fotografía</button>
            </div>
            <button class="action save-activity" data-save-activity type="button">💾 Guardar</button>
        </section>
        <section class="card history">
            <div class="card-head">
                <h2>Historial de incidencias y/o relevancias del día</h2>
                <p>Consulta los registros guardados del turno.</p>
            </div>
            <div class="history-filters">
                <label>Tipo
                    <select data-history-type>
                        <option value="all" <?php if(($activityType ?? 'all') === 'all'): echo 'selected'; endif; ?>>Todas</option>
                        <option value="incidencia" <?php if(($activityType ?? '') === 'incidencia'): echo 'selected'; endif; ?>>Incidencias</option>
                        <option value="relevancia" <?php if(($activityType ?? '') === 'relevancia'): echo 'selected'; endif; ?>>Relevancias</option>
                    </select>
                </label>
                <label>Fecha<input type="date" data-history-date value="<?php echo e($activityDate ?? ''); ?>"></label>
                <button type="button" class="action" data-clear-filters>Limpiar filtros</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>No. de lote</th>
                        <th>Disposición</th>
                        <th>Ubicación</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Usuario</th>
                        <th>Evidencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($activity->occurred_at->format('d/m/Y')); ?></td>
                            <td><?php echo e($activity->occurred_at->format('H:i:s')); ?></td>
                            <td><?php echo e(optional(optional($registration)->lot)->folio); ?></td>
                            <td><?php echo e(optional(optional($registration)->lot)->warehouse); ?></td>
                            <td><?php echo e($activity->location ?: 'Automático'); ?></td>
                            <td><?php echo e(str_contains(strtoupper((string) optional(optional($registration)->lot)->plant_origin), 'UREA') ? 'UREA AGRICOLA' : (optional(optional($registration)->lot)->folio ? 'Automático' : '')); ?></td>
                            <td><?php echo e(ucfirst($activity->type)); ?>: <?php echo e($activity->description); ?></td>
                            <td><?php echo e(optional($activity->user)->name); ?></td>
                            <td>
                                <?php if($activity->evidence_path): ?>
                                    <img class="evidence-preview" src="<?php echo e($activity->evidenceUrl()); ?>" alt="Evidencia" data-history-photo>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="9" class="empty-history">No hay actividades guardadas.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
    </div>
</div>
<div class="photo-modal" data-photo-modal aria-hidden="true">
    <div class="photo-dialog">
        <button type="button" class="photo-close" data-photo-close aria-label="Cerrar vista previa">×</button>
        <img data-photo-modal-image alt="Evidencia fotográfica" />
    </div>
</div>
<script>
    (() => {
        const filterType = document.querySelector('[data-history-type]');
        const filterDate = document.querySelector('[data-history-date]');
        const applyHistoryFilters = () => {
            const url = new URL(window.location.href);
            filterType.value === 'all' ? url.searchParams.delete('activity_type') : url.searchParams.set('activity_type', filterType.value);
            filterDate.value ? url.searchParams.set('activity_date', filterDate.value) : url.searchParams.delete('activity_date');
            window.location.assign(url.pathname + url.search);
        };
        filterType?.addEventListener('change', applyHistoryFilters);
        filterDate?.addEventListener('change', applyHistoryFilters);
        document.querySelector('[data-clear-filters]')?.addEventListener('click', () => {
            const url = new URL(window.location.href); url.searchParams.delete('activity_type'); url.searchParams.delete('activity_date'); window.location.assign(url.pathname + url.search);
        });
        const activity = document.querySelector('[data-activity-form]');
        const shiftId = document.querySelector('[data-shift-id]')?.dataset.shiftId;
        if (!activity || !shiftId) return;
        let type = 'incidencia';
        const capture = activity.querySelector('textarea');
        const location = activity.querySelector('[data-activity-location]');
        const timeInput = activity.querySelector('[data-activity-time]');
        const pad = (value) => String(value).padStart(2, '0');
        const nowLocal = () => {
            const now = new Date();
            return {
                clock: `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`,
                stamp: `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())} ${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`,
            };
        };
        const tickClock = () => { timeInput.value = nowLocal().clock; };
        tickClock();
        let clockTimer = setInterval(tickClock, 1000);
        const evidenceButton = activity.querySelector('[data-evidence-button]');
        const saveButton = activity.querySelector('[data-save-activity]');
        const evidenceStatus = activity.querySelector('[data-evidence-status]');
        const evidencePreview = activity.querySelector('[data-evidence-preview]');
        const deletePhotoButton = activity.querySelector('[data-delete-photo]');
        const photoModal = document.querySelector('[data-photo-modal]');
        const photoModalImage = photoModal.querySelector('[data-photo-modal-image]');
        const openPhoto = (src) => { if (!src) return; photoModalImage.src = src; photoModal.classList.add('open'); photoModal.setAttribute('aria-hidden', 'false'); };
        evidencePreview.addEventListener('click', () => openPhoto(evidencePreview.src));
        document.querySelectorAll('[data-history-photo]').forEach((image) => image.addEventListener('click', () => openPhoto(image.src)));
        photoModal.querySelector('[data-photo-close]').addEventListener('click', () => { photoModal.classList.remove('open'); photoModal.setAttribute('aria-hidden', 'true'); });
        photoModal.addEventListener('click', (event) => { if (event.target === photoModal) photoModal.classList.remove('open'); });
        const cameraPanel = document.createElement('div');
        cameraPanel.className = 'camera-panel';
        cameraPanel.innerHTML = '<div class="camera-frame"><div class="camera-toolbar"><span>📷 Evidencia fotográfica</span><button type="button" class="action" data-camera-cancel aria-label="Cerrar cámara">✕</button></div><video autoplay playsinline muted></video><div class="camera-actions"><button type="button" class="action" data-camera-cancel>Cancelar</button><button type="button" class="action" data-camera-capture>Tomar foto</button></div></div>';
        activity.appendChild(cameraPanel);
        const video = cameraPanel.querySelector('video');
        let cameraStream = null;
        let capturedEvidence = null;
        let evidenceBeforeCamera = null;
        let previewBeforeCamera = '';
        activity.querySelectorAll('[data-type]').forEach((button) => button.addEventListener('click', () => {
            type = button.dataset.type;
            activity.querySelectorAll('[data-type]').forEach((item) => {
                const selected = item === button;
                item.classList.toggle('active', selected);
                item.setAttribute('aria-pressed', selected ? 'true' : 'false');
                const mark = item.querySelector('.type-mark');
                if (mark) mark.textContent = selected ? '◉' : '◯';
            });
            capture.placeholder = type === 'incidencia' ? 'Captura la incidencia' : 'Captura la relevancia';
        }));
        const openCamera = async () => {
            evidenceStatus.classList.remove('error');
            evidenceBeforeCamera = capturedEvidence;
            previewBeforeCamera = evidencePreview.src;
            try {
                cameraStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: { ideal: 'environment' } }, audio: false });
                video.srcObject = cameraStream;
                cameraPanel.style.display = 'flex';
            } catch {
                evidenceStatus.textContent = 'No fue posible abrir la cámara';
                evidenceStatus.classList.add('error');
            }
        };
        evidenceButton.addEventListener('click', openCamera);
        deletePhotoButton.addEventListener('click', () => {
            capturedEvidence = null;
            evidencePreview.src = '';
            evidencePreview.hidden = true;
            deletePhotoButton.hidden = true;
            evidenceButton.textContent = '＋ 📷 Evidencia fotográfica';
            evidenceStatus.textContent = 'Sin evidencia';
            evidenceStatus.classList.remove('error');
        });
        const cancelCamera = () => {
            cameraStream?.getTracks().forEach((track) => track.stop()); cameraStream = null;
            video.srcObject = null; cameraPanel.style.display = 'none';
            capturedEvidence = evidenceBeforeCamera;
            evidencePreview.src = previewBeforeCamera;
            evidencePreview.hidden = !capturedEvidence;
            deletePhotoButton.hidden = !capturedEvidence;
            evidenceButton.disabled = false;
            evidenceButton.textContent = capturedEvidence ? '✓ Foto tomada' : '＋ 📷 Evidencia fotográfica';
            evidenceStatus.textContent = capturedEvidence ? '1 evidencia lista' : 'Sin evidencia';
        };
        cameraPanel.querySelectorAll('[data-camera-cancel]').forEach((button) => button.addEventListener('click', cancelCamera));
        cameraPanel.querySelector('[data-camera-capture]').addEventListener('click', () => {
            const canvas = document.createElement('canvas'); canvas.width = video.videoWidth || 1280; canvas.height = video.videoHeight || 720;
            canvas.getContext('2d')?.drawImage(video, 0, 0, canvas.width, canvas.height);
            canvas.toBlob((blob) => {
                if (!blob) return;
                capturedEvidence = new File([blob], `evidencia-${Date.now()}.jpg`, { type: 'image/jpeg' });
                evidencePreview.src = URL.createObjectURL(capturedEvidence);
                evidencePreview.hidden = false;
                deletePhotoButton.hidden = false;
                cameraStream?.getTracks().forEach((track) => track.stop()); cameraStream = null; video.srcObject = null; cameraPanel.style.display = 'none';
                evidenceButton.textContent = '↻ Volver a tomar foto'; evidenceButton.disabled = false; evidenceStatus.textContent = '1 evidencia lista';
            }, 'image/jpeg', 0.88);
        });
        saveButton.addEventListener('click', async () => {
            if (!capture.value.trim()) { capture.focus(); capture.setCustomValidity('Captura una actividad antes de guardar.'); capture.reportValidity(); return; }
            if (!capturedEvidence) { evidenceStatus.textContent = 'Toma una evidencia fotográfica para continuar'; evidenceStatus.classList.add('error'); evidenceButton.disabled = false; evidenceButton.focus(); return; }
            capture.setCustomValidity('');
            clearInterval(clockTimer);
            const savedAt = nowLocal();
            timeInput.value = savedAt.clock;
            saveButton.disabled = true; saveButton.textContent = 'Guardando...';
            const payload = new FormData();
            payload.append('production_shift_start_id', shiftId); payload.append('type', type); payload.append('description', capture.value.trim()); payload.append('location', location.value.trim());
            payload.append('occurred_at', savedAt.stamp);
            payload.append('evidence', capturedEvidence);
            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            const response = await fetch('<?php echo e(route('apt.management.activity.store')); ?>', { method: 'POST', body: payload, credentials: 'same-origin', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            if (response.ok) window.location.reload();
            else { saveButton.disabled = false; saveButton.textContent = '⚠ Reintentar'; clockTimer = setInterval(tickClock, 1000); }
        });
    })();
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Proagroindustria\resources\views/production/activity.blade.php ENDPATH**/ ?>