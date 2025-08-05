<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Proximity Alert</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-950 text-white min-h-screen flex flex-col items-center justify-center text-center">

    <h1 class="text-4xl font-bold mb-6">Welcome to Proximity Alert</h1>
    <p class="text-gray-400 mb-10">Easily check if your delivery is within range of Sta. Mesa, Manila.</p>

    <a href="{{ route('proximity.form') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition">
        Check Proximity
    </a>

</body>
</html>