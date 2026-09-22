<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Digital Store' }}</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- FontAwesome 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Compiled Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dynamic JSON-LD Schema.org for Google Local SEO -->
    @if(isset($tenant))
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => $tenant->archetype->schema_type ?? 'LocalBusiness',
        'name' => $tenant->business_name,
        'description' => $tenant->tagline,
        'telephone' => $tenant->phone,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $tenant->address,
            'addressLocality' => $tenant->city,
            'addressCountry' => 'IN',
        ],
        'url' => url()->current(),
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @endif

    <style>
        [x-cloak] { display: none !important; }
        .gradient-logo-swirl {
            background: linear-gradient(135deg, #fb923c 0%, #f43f5e 35%, #9333ea 70%, #3b82f6 100%);
        }
        .btn-brand-gradient {
            background: linear-gradient(135deg, #f43f5e 0%, #9333ea 50%, #4f46e5 100%);
        }
        .btn-brand-gradient:hover {
            background: linear-gradient(135deg, #e11d48 0%, #7e22ce 50%, #4338ca 100%);
        }
    </style>
    @livewireStyles
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen flex flex-col">

    {{ $slot }}

    @livewireScripts
</body>
</html>
