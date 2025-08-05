<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proximity Result</title>
    @vite(['resources/css/app.css'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 to-black text-white min-h-screen flex items-center justify-center px-4">

    <div class="bg-white/5 backdrop-blur-lg border border-white/10 text-white rounded-2xl shadow-2xl p-10 max-w-md w-full text-center space-y-6">
        
        @if (isset($data))
            @if ($data['within_range'])
                <div class="flex flex-col items-center gap-2">
                    <i data-lucide="check-circle" class="text-green-400 w-10 h-10"></i>
                    <p class="text-green-400 text-xl font-semibold">
                        Delivery is within <span class="font-bold">{{ $data['distance'] }}m</span>!
                    </p>
                </div>
            @else
                <div class="flex flex-col items-center gap-2">
                    <i data-lucide="alert-circle" class="text-red-500 w-10 h-10"></i>
                    <p class="text-red-400 text-xl font-semibold">
                        Delivery is <span class="font-bold">{{ $data['distance'] }}m</span> away.
                    </p>
                </div>
            @endif
        @else
            <div class="flex flex-col items-center gap-2">
                <i data-lucide="help-circle" class="text-yellow-400 w-10 h-10"></i>
                <p class="text-yellow-300 text-lg font-semibold">
                    Could not determine proximity. Please try again.
                </p>
            </div>
        @endif

        <a href="{{ route('proximity.form') }}"
           class="inline-flex items-center justify-center gap-2 mt-4 bg-[#1A00E2] hover:bg-[#1400b0] transition text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg">
            <i data-lucide="arrow-left-circle" class="w-5 h-5"></i>
            Check Another Location
        </a>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>