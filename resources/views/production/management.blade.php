<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestión de la Producción</title>
    <link rel="icon" type="image/png" href="{{ asset('Proagro.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('Proagro.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('Proagro.png') }}">
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --slate-900: #0f172a;
            --emerald-50: #ecfdf5;
            --emerald-200: #a7f3d0;
            --emerald-600: #059669;
            --emerald-700: #047857;
        }
        * { box-sizing: border-box; }
        html, body { width: 100%; min-height: 100%; margin: 0; }
        html, body, *, *::before, *::after {
            cursor: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAPzSURBVGhD7ddvaBtlGADwW6dIcrn8aTPL5e7eey/J0rTuj+Zyd7nYWTZBC4OBjDDFD/4ZzH/rbO6SNmnWxVVXlVUF8csYm5ulY/hl6wfBb6N2Vq26NVyaIdbRdnWZtritq5VCxyPRL+W++M1k7H5wX573eR54ed/nhSMIi8VisVgsFsv9a2LLFvIHUXzQHL9nTARxviCgLwt+7rMLm0LhCy0tDnNOTSsE8ImCH5UKCH8xhZnVSwKfHd282WPOq1kFjPp/CgrnC340UEK+uckAf+oPzN0ygmivObcmGZg9+Dtm7xT8aPz7R5r3XmHp8g3MLF8KCNlyILDn8tatbnNNTTGCXMAI4g+uCfjc5Y3+VyZZ+kYBcSeLHPsNCAiKPHveXFORSCTWm2NV8Xkisb7E+Zb+4lmY4ugFQ8CfToQC2hxiYJb1rZR4/u3rAb59JBymK/kNB1TJrcUGxH018nLlCaLO4PmcgfHAtB8NGEHh9R+bm5+8iTkwOPZYCTFDKwILMz7mYlhrDdlzypIjKR4196m6ScSM3UIMLPEMXEHMnIGRMSngd39mfTCPGLhGM5/UZaVhsl8FdyrWweitChCwztynKsZirK2E2NkZxKwWEXt2KoAHxzaF24wm/PQ8z8KvtO/2C8+Kr9ZlxLv2rASe9ONvuXT5uqsnVvBq8nNEPl9n7vm/mxCEUNHvf/EXjM5M8+jbqzw7OC4Iu6/yzPLCBnrcllbet/VKYO+RwKlJH1Ga9J3zcBxcGXWlQVd1giCqfxolnvsYBB5uIxZWK0PNs1DE6Kt5Gp0iemJn7T1RqHxkShzx7o9vc3dve+Lh7I7GYEe709yrKhY2MLtXGpnRcqNvaIZmTizT7PBiPZcDgnjAmZK+th+Mgr0rAqQWWQx2tD9krq++vu1NVLfcR/RKZ4hD0jkipwzR6dg7xJHWFm9SPUBmo0uVE3CkRfB2xiLm8qpBr7V63CnlOHUoBrYjKtgrdz0rgi0Xhcq9JzMiODPSaboz/jzVJV0k8wo4k6Js7lM1G5M7GJeuvOTult9wp+RjpB6ZInMy2LsjYNceBVvqsX82RXaLs15NftnZpZz2aq0hc5+qy+ehzqPLg950POlKye850mKZ7FXAnv337ldmgMxK0KjF95hra0JlMClNXHT2xaG+Q34KZXZ6PGlVp1LREYculh1J8TcyFb3jyEh3XbU0A2u5ktFRSo/ebErHqbXxlnzC0ZTeRTXsV8OOrPInlVGm/ftE19qcmuDW1F6Ppvab42vVJ2PPUIdVcOrisHmt6iovEv9m23/+AziT0oeuo23Q0KlkzGv3BABY59bV4w0d8e3mNYvFYrFYLBbLfeJvlaxaRdQ/lIsAAAAASUVORK5CYII=') 4 4, auto !important;
        }
        a, a *, button, button *, input, select, textarea, [role="button"], label, .back-btn, .btn-save {
            cursor: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAPzSURBVGhD7ddvaBtlGADwW6dIcrn8aTPL5e7eey/J0rTuj+Zyd7nYWTZBC4OBjDDFD/4ZzH/rbO6SNmnWxVVXlVUF8csYm5ulY/hl6wfBb6N2Vq26NVyaIdbRdnWZtritq5VCxyPRL+W++M1k7H5wX573eR54ed/nhSMIi8VisVgsFsv9a2LLFvIHUXzQHL9nTARxviCgLwt+7rMLm0LhCy0tDnNOTSsE8ImCH5UKCH8xhZnVSwKfHd282WPOq1kFjPp/CgrnC340UEK+uckAf+oPzN0ygmivObcmGZg9+Dtm7xT8aPz7R5r3XmHp8g3MLF8KCNlyILDn8tatbnNNTTGCXMAI4g+uCfjc5Y3+VyZZ+kYBcSeLHPsNCAiKPHveXFORSCTWm2NV8Xkisb7E+Zb+4lmY4ugFQ8CfToQC2hxiYJb1rZR4/u3rAb59JBymK/kNB1TJrcUGxH018nLlCaLO4PmcgfHAtB8NGEHh9R+bm5+8iTkwOPZYCTFDKwILMz7mYlhrDdlzypIjKR4196m6ScSM3UIMLPEMXEHMnIGRMSngd39mfTCPGLhGM5/UZaVhsl8FdyrWweitChCwztynKsZirK2E2NkZxKwWEXt2KoAHxzaF24wm/PQ8z8KvtO/2C8+Kr9ZlxLv2rASe9ONvuXT5uqsnVvBq8nNEPl9n7vm/mxCEUNHvf/EXjM5M8+jbqzw7OC4Iu6/yzPLCBnrcllbet/VKYO+RwKlJH1Ga9J3zcBxcGXWlQVd1giCqfxolnvsYBB5uIxZWK0PNs1DE6Kt5Gp0iemJn7T1RqHxkShzx7o9vc3dve+Lh7I7GYEe709yrKhY2MLtXGpnRcqNvaIZmTizT7PBiPZcDgnjAmZK+th+Mgr0rAqQWWQx2tD9krq++vu1NVLfcR/RKZ4hD0jkipwzR6dg7xJHWFm9SPUBmo0uVE3CkRfB2xiLm8qpBr7V63CnlOHUoBrYjKtgrdz0rgi0Xhcq9JzMiODPSaboz/jzVJV0k8wo4k6Js7lM1G5M7GJeuvOTult9wp+RjpB6ZInMy2LsjYNceBVvqsX82RXaLs15NftnZpZz2aq0hc5+qy+ehzqPLg950POlKye850mKZ7FXAnv337ldmgMxK0KjF95hra0JlMClNXHT2xaG+Q34KZXZ6PGlVp1LREYculh1J8TcyFb3jyEh3XbU0A2u5ktFRSo/ebErHqbXxlnzC0ZTeRTXsV8OOrPInlVGm/ftE19qcmuDW1F6Ppvab42vVJ2PPUIdVcOrisHmt6iovEv9m23/+AziT0oeuo23Q0KlkzGv3BABY59bV4w0d8e3mNYvFYrFYLBbLfeJvlaxaRdQ/lIsAAAAASUVORK5CYII=') 4 4, pointer !important;
        }
        .page {
            width: 100%;
            max-width: 80rem;
            min-height: 100vh;
            margin: 0 auto;
            padding: 2rem 1rem 3rem;
        }
        @media (min-width: 640px) { .page { padding-left: 1.5rem; padding-right: 1.5rem; } }
        @media (min-width: 1024px) { .page { padding-left: 2rem; padding-right: 2rem; } }

        .nav-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--slate-700);
            background: #fff;
            padding: 9px 18px;
            border-radius: 12px;
            border: 1px solid var(--slate-200);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            transition: all .2s;
        }
        .back-btn:hover {
            color: var(--sky-700);
            border-color: var(--sky-200);
            background: var(--sky-50);
            transform: translateY(-1px);
        }
        .back-subtle {
            background: transparent;
            border-color: transparent;
            box-shadow: none;
            color: var(--slate-500);
        }
        .back-subtle:hover {
            background: transparent;
            color: var(--sky-700);
            transform: none;
        }

        .shell {
            overflow: hidden;
            border: 1px solid var(--slate-200);
            border-radius: 2rem;
            background: #fff;
            box-shadow: 0 20px 60px -30px rgba(15, 23, 42, .35);
        }
        .hero {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 1.75rem 2rem;
            background: linear-gradient(110deg, var(--sky-700), var(--blue-700) 55%, var(--indigo-800));
            color: #fff;
        }
        .hero-brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .hero-back-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: background .2s;
        }
        .hero-back-icon:hover {
            background: rgba(255, 255, 255, 0.25);
        }
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
            color: var(--sky-100);
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .24em;
            text-transform: uppercase;
        }
        .hero h1 {
            margin: 4px 0 0;
            font-size: 1.875rem;
            font-weight: 900;
            letter-spacing: -.02em;
        }
        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .chip {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .chip-white { background: #fff; color: var(--sky-700); }
        .chip-trans { background: rgba(255, 255, 255, .12); color: var(--sky-100); border: 1px solid rgba(255, 255, 255, .2); }

        .form-body {
            padding: 2rem;
        }
        @media (min-width: 640px) { .form-body { padding: 2.5rem; } }

        .form-top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid var(--slate-100);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .form-top-bar p { margin: 0; font-size: 14px; font-weight: 600; color: var(--slate-500); }
        .form-top-bar span { font-size: 12px; font-weight: 900; color: var(--slate-400); text-transform: uppercase; }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        @media (min-width: 1024px) {
            .grid-3 { grid-template-columns: 1fr 1fr 0.9fr; }
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .field-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--sky-700);
            margin-bottom: 8px;
        }
        .field-control {
            width: 100%;
            border-radius: 12px;
            border: 1px solid var(--sky-200);
            background: #fff;
            padding: 12px 16px;
            font-size: 15px;
            font-weight: 600;
            color: var(--slate-800);
            outline: none;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .05);
            transition: all .2s;
        }
        .field-control:focus {
            border-color: var(--sky-600);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, .15);
        }
        .field-control:read-only {
            background: var(--slate-50);
            color: var(--slate-500);
            cursor: not-allowed;
        }

        .date-box {
            display: flex;
            align-items: center;
            gap: 12px;
            height: 50px;
            border-radius: 12px;
            border: 1px solid var(--slate-200);
            background: var(--slate-50);
            padding: 0 16px;
            font-weight: 700;
            color: var(--slate-600);
        }
        .date-box i { color: var(--sky-600); font-size: 18px; }

        .btn-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            height: 50px;
            width: 100%;
            border-radius: 12px;
            border: none;
            background: var(--sky-600);
            color: #fff;
            font-size: 16px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, .35);
            transition: all .2s;
        }
        .btn-save:hover {
            background: var(--sky-700);
            transform: translateY(-1px);
        }
        .btn-save:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .alert-error {
            display: none;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="nav-row">
            <a href="{{ url('/apt/production') }}" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Volver a Gestión de almacenes
            </a>
        </div>

        <div class="shell">
            <div class="hero">
                <div class="hero-brand">
                    <img src="{{ asset('Proagro.png') }}" alt="Proagroindustria">
                    <div>
                        <p class="hero-kicker">Módulo operativo · APT</p>
                        <h1>Gestión de la producción</h1>
                    </div>
                </div>
                <div class="hero-meta">
                    <span class="chip chip-white">Lote en recepción</span>
                    <span class="chip chip-trans">Paso 1 de 3</span>
                </div>
            </div>

            <form id="shiftForm" class="form-body" method="POST" action="{{ route('apt.management.shift.store') }}">
                @csrf
                <div id="errorBox" class="alert-error"></div>

                    @if(!$canManageShift)
                    <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 14px; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 24px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 10px; background: #dbeafe; color: #1d4ed8; font-size: 18px;">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                @if($latestRegistration)
                                    <p style="margin: 0; font-size: 14px; font-weight: 800; color: #1e3a8a;">Lote asignado por el Jefe de Almacén</p>
                                    <p style="margin: 2px 0 0; font-size: 13px; color: #2563eb; font-weight: 600;">Solo puedes consultar el lote que te asignaron. El inicio de turno lo registra el <strong>Jefe de Almacén</strong>.</p>
                                @else
                                    <p style="margin: 0; font-size: 14px; font-weight: 800; color: #1e3a8a;">Sin lote asignado</p>
                                    <p style="margin: 2px 0 0; font-size: 13px; color: #2563eb; font-weight: 600;">El lote permanece vacío hasta que el <strong>Jefe de Almacén</strong> te asigne uno.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                <div class="form-top-bar">
                    <p>{{ $canManageShift ? 'Completa los datos para iniciar el turno.' : 'Información del turno y lote en recepción.' }}</p>
                    <span>{{ $canManageShift ? '* Campos obligatorios' : 'Solo lectura' }}</span>
                </div>

                <div class="grid-3">
                    <div class="field-group">
                        <label>
                            <span class="field-label"><i class="fa-solid fa-user"></i> Usuario asignado</span>
                            <select id="user_id" name="user_id" required {{ !$canManageShift ? 'disabled' : '' }} class="field-control">
                                <option value="">Seleccionar usuario</option>
                                @foreach($users as $u)
                                    @php
                                        $userPosition = $u->position ?: ($u->level ?: ($u->roles->pluck('name')->first() ?: 'Almacén'));
                                        $isSelected = $latestRegistration ? ($latestRegistration->user_id == $u->id) : (auth()->id() == $u->id);
                                    @endphp
                                    <option value="{{ $u->id }}" data-position="{{ $userPosition }}" {{ $isSelected ? 'selected' : '' }}>
                                        {{ $u->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <span class="field-label"><i class="fa-solid fa-clipboard-list"></i> Turno</span>
                            <select id="shift" name="shift" required {{ !$canManageShift ? 'disabled' : '' }} class="field-control">
                                <option value="">Seleccionar turno</option>
                                @php $selectedShift = $latestRegistration ? $latestRegistration->shift : ''; @endphp
                                <option value="Turno 1" {{ $selectedShift == 'Turno 1' ? 'selected' : '' }}>Turno 1</option>
                                <option value="Turno 2" {{ $selectedShift == 'Turno 2' ? 'selected' : '' }}>Turno 2</option>
                                <option value="Turno 3" {{ $selectedShift == 'Turno 3' ? 'selected' : '' }}>Turno 3</option>
                                <option value="Turno 1A" {{ $selectedShift == 'Turno 1A' ? 'selected' : '' }}>Turno 1A</option>
                                <option value="Turno 1B" {{ $selectedShift == 'Turno 1B' ? 'selected' : '' }}>Turno 1B</option>
                            </select>
                        </label>
                    </div>

                    <div class="field-group">
                        <label>
                            <span class="field-label"><i class="fa-solid fa-id-badge"></i> Puesto</span>
                            <input type="text" id="position" name="position" value="{{ $latestRegistration ? $latestRegistration->position : 'Automático' }}" readonly class="field-control">
                        </label>
                        <label>
                            <span class="field-label"><i class="fa-solid fa-box-open"></i> Lote en recepción</span>
                            <select id="lot_id" name="lot_id" required {{ !$canManageShift ? 'disabled' : '' }} class="field-control">
                                <option value="">{{ $canManageShift ? 'Seleccionar lote' : ($lots->isEmpty() ? 'Sin lote asignado' : 'Lote asignado') }}</option>
                                @php $selectedLot = $latestRegistration ? $latestRegistration->lot_id : ''; @endphp
                                @foreach($lots as $l)
                                    <option value="{{ $l->id }}" {{ $selectedLot == $l->id ? 'selected' : '' }}>
                                        {{ $l->folio }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="field-group" style="justify-content: space-between;">
                        <div>
                            <span class="field-label"><i class="fa-solid fa-calendar-days"></i> Fecha</span>
                            <div class="date-box">
                                <i class="fa-solid fa-calendar-day"></i>
                                <span>{{ $latestRegistration ? $latestRegistration->started_at->format('d/m/Y') : date('d/m/Y') }}</span>
                            </div>
                        </div>
                        @if($canManageShift)
                            <button type="submit" id="saveBtn" class="btn-save">
                                <i class="fa-solid fa-floppy-disk"></i> Guardar registro
                            </button>
                        @else
                            @if($latestRegistration)
                                <a href="{{ route('apt.management.activity') }}" class="btn-save" style="text-decoration: none;">
                                    <i class="fa-solid fa-eye"></i> Ver lote y actividades
                                </a>
                            @else
                                <button type="button" disabled class="btn-save" style="opacity: 0.6; cursor: not-allowed; background: var(--slate-400); box-shadow: none;">
                                    <i class="fa-solid fa-lock"></i> Requiere inicio por Jefe de Almacén
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userSelect = document.getElementById('user_id');
            const posInput = document.getElementById('position');
            const form = document.getElementById('shiftForm');
            const saveBtn = document.getElementById('saveBtn');
            const errorBox = document.getElementById('errorBox');

            const syncPosition = () => {
                const opt = userSelect.options[userSelect.selectedIndex];
                if (opt && opt.value) {
                    posInput.value = opt.getAttribute('data-position') || 'Almacén';
                } else {
                    posInput.value = 'Automático';
                }
            };

            userSelect.addEventListener('change', syncPosition);
            userSelect.addEventListener('input', syncPosition);
            syncPosition();

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                errorBox.style.display = 'none';
                saveBtn.disabled = true;
                saveBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';

                const formData = new FormData(form);

                try {
                    const res = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (!res.ok) {
                        const data = await res.json().catch(() => ({}));
                        const firstError = data.errors ? Object.values(data.errors).flat()[0] : null;
                        throw new Error(firstError || data.message || `Error ${res.status} al guardar`);
                    }

                    window.location.assign("{{ route('apt.management.activity') }}");
                } catch (err) {
                    errorBox.textContent = err.message || 'Error al guardar el registro';
                    errorBox.style.display = 'block';
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Guardar registro';
                }
            });
        });
    </script>
</body>
</html>
