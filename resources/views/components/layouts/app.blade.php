<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrivida - {{ $title ?? ''}}</title>
    <meta name="description" content="{{ $metaDescription ?? ''}}">
    
    @vite('resources/css/app.css', 'resources/js/app.js')

</head>
<body class="h-screen">
    
    {{-- <x-layouts.nav class="nav"></x-layaouts>
    @if (session('status'))
        <div class="session">
            {{ session('status') }}
        </div>
    @endif --}}
{{ $slot }}

@yield('scripts')
</body>

</html>