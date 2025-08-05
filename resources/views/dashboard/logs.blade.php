<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proximity Logs</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-950 text-white min-h-screen px-6 py-10">

    <div class="max-w-6xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-[#1A00E2]">Proximity Logs</h1>
            <a href="{{ route('proximity.form') }}" class="text-white bg-[#1A00E2] hover:bg-[#1300b0] px-4 py-2 rounded-lg font-semibold shadow-md flex items-center gap-2">
                <i data-lucide="map-pin" class="w-5 h-5"></i> New Check
            </a>
        </div>

        <div class="overflow-x-auto bg-white/5 rounded-xl shadow-xl border border-white/10">
            <table class="min-w-full text-sm text-left text-white">
                <thead class="bg-[#1A00E2]/20 text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">Latitude</th>
                        <th class="px-6 py-4">Longitude</th>
                        <th class="px-6 py-4">Radius (m)</th>
                        <th class="px-6 py-4">Distance (m)</th>
                        <th class="px-6 py-4">Within Range?</th>
                        <th class="px-6 py-4">Checked At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($logs as $log)
                        <tr>
                            <td class="px-6 py-4">{{ $log->id }}</td>
                            <td class="px-6 py-4">{{ $log->latitude }}</td>
                            <td class="px-6 py-4">{{ $log->longitude }}</td>
                            <td class="px-6 py-4">{{ $log->radius }}m</td>
                            <td class="px-6 py-4">{{ $log->distance ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @if($log->within_range === null)
                                    <span class="text-yellow-400">Unknown</span>
                                @elseif($log->within_range)
                                    <span class="text-green-400 font-semibold">Yes</span>
                                @else
                                    <span class="text-red-400 font-semibold">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-400">No logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>