<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Proximity Alert</title>
    @vite(['resources/css/app.css'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute inset-0 bg-gradient-to-tr from-[#1A00E2]/10 to-transparent pointer-events-none z-0"></div>
    <div class="absolute w-96 h-96 bg-[#1A00E2]/20 rounded-full blur-3xl top-[-100px] left-[-100px] z-0"></div>

    <div class="z-10 w-full max-w-7xl mx-auto px-6 py-16 flex flex-col lg:flex-row items-center justify-between gap-12">

        <div class="lg:w-1/2">
            <img src="{{ asset('images/cover.png') }}" alt="Delivery Cover" class="rounded-xl shadow-xl w-full object-cover">
        </div>

        <div class="lg:w-1/2 space-y-6">

            <div class="flex items-center gap-3 text-[#1A00E2]">
                <i data-lucide="truck" class="w-8 h-8"></i>
                <span class="text-sm font-medium uppercase tracking-wide">Smart Delivery</span>
            </div>

            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight text-white">
                <span class="bg-gradient-to-r from-[#1A00E2] to-blue-400 bg-clip-text text-transparent">
                    AI-Powered Proximity Alerts
                </span> for Warehouse Deliveries
            </h1>

            <p class="text-gray-300 text-lg">
                Enhance safety and efficiency by automatically tracking your delivery locations with real-time smart alerts.
            </p>

            <div>
                <a href="{{ route('proximity.form') }}"
                   class="inline-flex items-center gap-2 bg-[#1A00E2] hover:bg-[#1300b0] transition text-white font-bold py-3 px-6 rounded-lg shadow-lg">
                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                    Check Proximity
                </a>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>