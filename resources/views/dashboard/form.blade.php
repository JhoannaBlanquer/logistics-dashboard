<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proximity Alert</title>
    @vite(['resources/css/app.css'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    </style>
</head>
<body class="bg-gradient-to-tr from-gray-900 via-gray-950 to-black text-white min-h-screen relative">

    <!-- Navigation -->
    <nav class="fixed w-full top-0 left-0 z-50 px-6 py-4 bg-black/30 backdrop-blur-lg shadow-lg flex items-center justify-between">
        <div class="flex items-center gap-3">
            <i data-lucide="map-pin" class="w-6 h-6 text-[#1A00E2]"></i>
            <span class="font-bold text-white text-lg">Proximity Alert</span>
        </div>
        <a href="{{ route('home') }}" class="text-[#1A00E2] hover:underline font-semibold">
            Home
        </a>
    </nav>

    <!-- Header -->
    <header class="text-center pt-28 px-4">
        <h1 class="text-4xl font-extrabold tracking-wide mb-2 text-[#1A00E2]">Check Delivery Proximity</h1>
        <p class="text-gray-300 text-base">Click the map or enter coordinates to check distance from warehouse</p>
    </header>

    <!-- Main Section -->
    <section class="flex flex-col lg:flex-row justify-center items-start gap-10 px-6 lg:px-16 mt-16 mb-20 z-10 relative">

        <!-- Form -->
        <div class="w-full lg:w-1/3 bg-white/5 border border-white/10 backdrop-blur-md p-8 rounded-xl shadow-xl">
            <form method="POST" action="{{ route('check.proximity') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="lat" class="block text-gray-200 font-semibold mb-1">Delivery Latitude</label>
                    <input type="text" name="lat" id="lat" required
                           class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1A00E2]">
                </div>

                <div>
                    <label for="lng" class="block text-gray-200 font-semibold mb-1">Delivery Longitude</label>
                    <input type="text" name="lng" id="lng" required
                           class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1A00E2]">
                </div>

                <div>
                    <label for="radius" class="block text-gray-200 font-semibold mb-1">Alert Radius</label>
                    <select name="radius" id="radius"
                            class="w-full px-4 py-2 rounded-lg bg-white/10 text-white focus:outline-none focus:ring-2 focus:ring-[#1A00E2]">
                        <option value="100">100m</option>
                        <option value="250" selected>250m</option>
                        <option value="500">500m</option>
                    </select>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="bg-[#1A00E2] hover:bg-[#1300b0] transition text-white font-bold py-3 px-6 rounded-lg w-full shadow-md">
                        Check Proximity
                    </button>
                </div>
            </form>
        </div>

        <!-- Map -->
        <div class="w-full lg:w-2/3">
            <div id="map" class="w-full h-[500px] rounded-xl shadow-2xl border border-white/10"></div>
        </div>
    </section>

    <!-- Leaflet Map JS -->
    <script>
        const staMesaCoords = [14.5999, 121.0153];
        const map = L.map('map').setView(staMesaCoords, 19);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const warehouseMarker = L.marker(staMesaCoords).addTo(map)
            .bindPopup("Warehouse")
            .openPopup();

        let deliveryMarker;
        let deliveryCircle;

        const redIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        map.on('click', function (e) {
            if (deliveryMarker) map.removeLayer(deliveryMarker);
            if (deliveryCircle) map.removeLayer(deliveryCircle);

            deliveryMarker = L.marker(e.latlng, { icon: redIcon }).addTo(map)
                .bindPopup("Delivery Location")
                .openPopup();

            deliveryCircle = L.circle(e.latlng, {
                color: '#f87171',
                fillColor: '#f87171',
                fillOpacity: 0.2,
                radius: 20
            }).addTo(map);

            document.getElementById('lat').value = e.latlng.lat.toFixed(6);
            document.getElementById('lng').value = e.latlng.lng.toFixed(6);
        });

        lucide.createIcons();
    </script>
</body>
</html>