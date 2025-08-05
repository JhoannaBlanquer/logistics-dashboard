<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proximity Result</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="bg-white text-gray-800 rounded-xl shadow-lg p-8 text-center">
        @if (isset($data))
            @if ($data['within_range'])
                <p class="text-green-600 text-xl font-bold">Delivery is within {{ $data['distance'] }} meters!</p>
            @else
                <p class="text-red-600 text-xl font-bold">Delivery is {{ $data['distance'] }} meters away.</p>
            @endif
        @else
            <p class="text-yellow-600 text-xl font-bold">Could not determine proximity. Please try again.</p>
        @endif

        <a href="{{ route('proximity.form') }}" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
            Check Another Location
        </a>
    </div>
</body>
</html>