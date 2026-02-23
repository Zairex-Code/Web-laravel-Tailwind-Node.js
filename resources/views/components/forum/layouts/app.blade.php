<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro de programación</title>

    {{-- Load compiled CSS and JavaScript assets using Laravel Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- Apply Tailwind CSS classes for a full-height dark gradient background and white text --}}
<body class="min-h-screen bg-gradient-to-b from-neutral-950 to-neutral-900 text-white">
    {{-- Header section containing the navigation bar --}}
    <div class="px-4 border-b border-neutral-800">
        {{-- Render the forum navbar Blade component (located at resources/views/components/forum/navbar.blade.php) --}}
        <x-forum.navbar />
    </div>

    {{-- Main content container, centered with a maximum width --}}
    <div class="mx-auto max-w-4xl px-4 pb-8">
        {{-- The $slot variable injects the content from the views that use this layout --}}
        {{ $slot }}
    </div>
</body>
</html>
