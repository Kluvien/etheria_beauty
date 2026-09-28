<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('etheria.name'))</title>
    <meta name="description" content="{{ config('etheria.name') }} beauty services and appointment booking.">
    <meta property="og:title" content="@yield('title', config('etheria.name'))">
    <meta property="og:description" content="Beauty services and appointment booking for {{ config('etheria.name') }}.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
<header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
    <a href="{{ route('home') }}" class="font-serif text-3xl">Etheria<span class="text-[#a66362]">.</span></a>
    <nav class="hidden items-center gap-8 text-sm font-semibold md:flex">
        <a href="{{ route('home') }}#services" class="hover:text-[#a66362]">Services</a><a href="{{ route('home') }}#about" class="hover:text-[#a66362]">About</a><a href="{{ route('home') }}#gallery" class="hover:text-[#a66362]">Gallery</a>
        <a href="{{ route('booking.create') }}" class="btn-primary rounded-full px-5 py-3">Book an appointment</a>
    </nav>
    <a href="{{ route('booking.create') }}" class="btn-primary rounded-full px-4 py-2 text-sm font-bold md:hidden">Book</a>
</header>
@yield('content')
<footer class="border-t border-[#e6d9d3] px-6 py-12 lg:px-10"><div class="mx-auto flex max-w-7xl flex-col justify-between gap-8 md:flex-row"><div><div class="font-serif text-3xl">Etheria<span class="text-[#a66362]">.</span></div><p class="mt-2 max-w-xs text-sm text-[#746965]">{{ config('etheria.slogan') }}</p></div><div class="flex gap-5 text-sm font-semibold"><a href="{{ config('etheria.instagram') }}" target="_blank">Instagram</a><a href="{{ config('etheria.tiktok') }}" target="_blank">TikTok</a><a href="{{ \App\Support\WhatsApp::url() }}" target="_blank">WhatsApp</a></div></div><p class="mx-auto mt-10 max-w-7xl text-xs text-[#746965]">© {{ date('Y') }} Etheria Beauty. All rights reserved.</p></footer>
</body>
</html>