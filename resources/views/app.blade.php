<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png"
        href="{{ config('app.tenant.favicon') ? asset(config('app.tenant.favicon')) : asset('Proagro.png') }}">

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#1e1b4b">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="VECODE">
    <link rel="manifest" href="{{ asset('build/manifest.webmanifest') }}">

    <script>
        window.currentUserRoles = @json(auth()->check() ? auth()->user()->getRoleNames() : []);

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.getRegistrations().then((registrations) => {
                registrations.forEach((registration) => registration.unregister());
            });
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        html,
        body,
        *,
        *::before,
        *::after {
            cursor: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAPzSURBVGhD7ddvaBtlGADwW6dIcrn8aTPL5e7eey/J0rTuj+Zyd7nYWTZBC4OBjDDFD/4ZzH/rbO6SNmnWxVVXlVUF8csYm5ulY/hl6wfBb6N2Vq26NVyaIdbRdnWZtritq5VCxyPRL+W++M1k7H5wX573eR54ed/nhSMIi8VisVgsFsv9a2LLFvIHUXzQHL9nTARxviCgLwt+7rMLm0LhCy0tDnNOTSsE8ImCH5UKCH8xhZnVSwKfHd282WPOq1kFjPp/CgrnC340UEK+uckAf+oPzN0ygmivObcmGZg9+Dtm7xT8aPz7R5r3XmHp8g3MLF8KCNlyILDn8tatbnNNTTGCXMAI4g+uCfjc5Y3+VyZZ+kYBcSeLHPsNCAiKPHveXFORSCTWm2NV8Xkisb7E+Zb+4lmY4ugFQ8CfToQC2hxiYJb1rZR4/u3rAb59JBymK/kNB1TJrcUGxH018nLlCaLO4PmcgfHAtB8NGEHh9R+bm5+8iTkwOPZYCTFDKwILMz7mYlhrDdlzypIjKR4196m6ScSM3UIMLPEMXEHMnIGRMSngd39mfTCPGLhGM5/UZaVhsl8FdyrWweitChCwztynKsZirK2E2NkZxKwWEXt2KoAHxzaF24wm/PQ8z8KvtO/2C8+Kr9ZlxLv2rASe9ONvuXT5uqsnVvBq8nNEPl9n7vm/mxCEUNHvf/EXjM5M8+jbqzw7OC4Iu6/yzPLCBnrcllbet/VKYO+RwKlJH1Ga9J3zcBxcGXWlQVd1giCqfxolnvsYBB5uIxZWK0PNs1DE6Kt5Gp0iemJn7T1RqHxkShzx7o9vc3dve+Lh7I7GYEe709yrKhY2MLtXGpnRcqNvaIZmTizT7PBiPZcDgnjAmZK+th+Mgr0rAqQWWQx2tD9krq++vu1NVLfcR/RKZ4hD0jkipwzR6dg7xJHWFm9SPUBmo0uVE3CkRfB2xiLm8qpBr7V63CnlOHUoBrYjKtgrdz0rgi0Xhcq9JzMiODPSaboz/jzVJV0k8wo4k6Js7lM1G5M7GJeuvOTult9wp+RjpB6ZInMy2LsjYNceBVvqsX82RXaLs15NftnZpZz2aq0hc5+qy+ehzqPLg950POlKye850mKZ7FXAnv337ldmgMxK0KjF95hra0JlMClNXHT2xaG+Q34KZXZ6PGlVp1LREYculh1J8TcyFb3jyEh3XbU0A2u5ktFRSo/ebErHqbXxlnzC0ZTeRTXsV8OOrPInlVGm/ftE19qcmuDW1F6Ppvab42vVJ2PPUIdVcOrisHmt6iovEv9m23/+AziT0oeuo23Q0KlkzGv3BABY59bV4w0d8e3mNYvFYrFYLBbLfeJvlaxaRdQ/lIsAAAAASUVORK5CYII=') 4 4, auto !important;
        }

        a,
        a *,
        button,
        button *,
        input,
        select,
        textarea,
        [role="button"],
        [role="button"] *,
        [role="tab"],
        [role="tab"] *,
        label,
        .cursor-pointer,
        .cursor-pointer * {
            cursor: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAPzSURBVGhD7ddvaBtlGADwW6dIcrn8aTPL5e7eey/J0rTuj+Zyd7nYWTZBC4OBjDDFD/4ZzH/rbO6SNmnWxVVXlVUF8csYm5ulY/hl6wfBb6N2Vq26NVyaIdbRdnWZtritq5VCxyPRL+W++M1k7H5wX573eR54ed/nhSMIi8VisVgsFsv9a2LLFvIHUXzQHL9nTARxviCgLwt+7rMLm0LhCy0tDnNOTSsE8ImCH5UKCH8xhZnVSwKfHd282WPOq1kFjPp/CgrnC340UEK+uckAf+oPzN0ygmivObcmGZg9+Dtm7xT8aPz7R5r3XmHp8g3MLF8KCNlyILDn8tatbnNNTTGCXMAI4g+uCfjc5Y3+VyZZ+kYBcSeLHPsNCAiKPHveXFORSCTWm2NV8Xkisb7E+Zb+4lmY4ugFQ8CfToQC2hxiYJb1rZR4/u3rAb59JBymK/kNB1TJrcUGxH018nLlCaLO4PmcgfHAtB8NGEHh9R+bm5+8iTkwOPZYCTFDKwILMz7mYlhrDdlzypIjKR4196m6ScSM3UIMLPEMXEHMnIGRMSngd39mfTCPGLhGM5/UZaVhsl8FdyrWweitChCwztynKsZirK2E2NkZxKwWEXt2KoAHxzaF24wm/PQ8z8KvtO/2C8+Kr9ZlxLv2rASe9ONvuXT5uqsnVvBq8nNEPl9n7vm/mxCEUNHvf/EXjM5M8+jbqzw7OC4Iu6/yzPLCBnrcllbet/VKYO+RwKlJH1Ga9J3zcBxcGXWlQVd1giCqfxolnvsYBB5uIxZWK0PNs1DE6Kt5Gp0iemJn7T1RqHxkShzx7o9vc3dve+Lh7I7GYEe709yrKhY2MLtXGpnRcqNvaIZmTizT7PBiPZcDgnjAmZK+th+Mgr0rAqQWWQx2tD9krq++vu1NVLfcR/RKZ4hD0jkipwzR6dg7xJHWFm9SPUBmo0uVE3CkRfB2xiLm8qpBr7V63CnlOHUoBrYjKtgrdz0rgi0Xhcq9JzMiODPSaboz/jzVJV0k8wo4k6Js7lM1G5M7GJeuvOTult9wp+RjpB6ZInMy2LsjYNceBVvqsX82RXaLs15NftnZpZz2aq0hc5+qy+ehzqPLg950POlKye850mKZ7FXAnv337ldmgMxK0KjF95hra0JlMClNXHT2xaG+Q34KZXZ6PGlVp1LREYculh1J8TcyFb3jyEh3XbU0A2u5ktFRSo/ebErHqbXxlnzC0ZTeRTXsV8OOrPInlVGm/ftE19qcmuDW1F6Ppvab42vVJ2PPUIdVcOrisHmt6iovEv9m23/+AziT0oeuo23Q0KlkzGv3BABY59bV4w0d8e3mNYvFYrFYLBbLfeJvlaxaRdQ/lIsAAAAASUVORK5CYII=') 4 4, pointer !important;
        }

        .sidebar-container,
        .sidebar-container * {
            cursor: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAICSURBVGhD7ddLqM5BGMdx1yTHbSVZqkOWCiskha0sTrJxWRBR2BAi5JJbyUZyj+ycs1C27pedlJWFJJdS7krRR0+eU2/TKTv//8l86635PzPz9DzvzPObmSFDKpVKpVKpVCr/LxiDkaV90IDduIlLmI6uckyrwVk8ww38xHZMLMe1FhxAL47iFS7gI9aUY1sJduILHkfQeIPvuRI9mFDOaRWYimO4jrV4i3N44A+95ZwAw0tbI0Qg+JrBvsd5bMnvH9iHJZic42fldmuHcmEYdmRQ8VuPhZnAaVzJ9l10Z7JHSj+Ng/sZaBDF/BQHO2yn0JftjZiDoaWfRsBovEwZvYbLmI/FGfAnrMOv/N6D13iC5bGKpc9/Tm6PlbiKh5nEslSkUKjDGXxwAo+yHXWytRWrgZMdQfZzO8+GWJl+bmEu5mESxpW+GiH/8TtZuHFCx56PAh+Bex0JfMaocn7jYBr25jaKcyES2Y8Z2NQht8HMcn5jxN0HZzqCG4iLWJFyGswu/TQGpmAVNqT2Py+C7yeUanUm0136aZw81EJ9NuNQ3osGoqec2wqiMLNAg0W5tUIiQ3UimXd58YvzoD010Emq0AeMLexdYctHzze8wPjOMa0Au+KNUNo7wdJcpb6yr3Fy2/z1DYDjmcS2sm9QEFeHlN4FZV+lUqlUKpVK5T/hN9f6MFBO/5D0AAAAAElFTkSuQmCC') 4 4, pointer !important;
        }
    </style>

    <!-- Scripts -->
    @routes
    <!-- Cache Buster: v=3.1-migration-fix -->
    @viteReactRefresh
    @vite('resources/js/app.tsx')
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>