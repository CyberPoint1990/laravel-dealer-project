<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Khalsa Agro') }}</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .main-content { min-height: calc(100vh - 64px); }
        </style>
    </head>
    <body class="bg-slate-50 antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow-sm border-b border-slate-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="text-2xl font-bold text-slate-800 tracking-tight">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <main class="main-content">
                {{-- Dono methods support karne ke liye: --}}
                @if(isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </body>
</html>