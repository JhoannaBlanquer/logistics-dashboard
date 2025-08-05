<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proximity Alert</title>
    @vite(['resources/css/app.css'])

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="bg-gray-950 text-white min-h-screen">

    <!-- Navigation -->
    <nav class="w-full px-6 py-4 absolute top-0 left-0">
        <a href="{{ route('home') }}" class="text-blue-500 font-bold hover:underline">
            Home
        </a>
    </nav>

<!-- Header -->
<header class="text-center pt-12">
    <h1 class="text-4xl font-extrabold tracking-wide mb-2 text-blue-500">Proximity Alert</h1>
    <p class="text-gray-400 text-sm">Check how far the delivery is from Sta. Mesa, Manila</p>
</header>

<!-- Main Section -->
<section class="flex flex-col lg:flex-row justify-center items-start gap-8 px-6 lg:px-16 mt-16">

        
        <!-- Adjusted Form (moved slightly up) -->
        <div class="w-full lg:w-1/3 mt-8">
            <form method="POST" action="{{ route('check.proximity') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="lat" class="block text-white font-semibold mb-1">Delivery Latitude</label>
                    <input type="text" name="lat" id="lat" required
                           class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label for="lng" class="block text-white font-semibold mb-1">Delivery Longitude</label>
                    <input type="text" name="lng" id="lng" required
                           class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label for="radius" class="block text-white font-semibold mb-1">Alert Radius (meters)</label>
                    <select name="radius" id="radius"
                            class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="100">100m</option>
                        <option value="250" selected>250m</option>
                        <option value="500">500m</option>
                    </select>
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Check Proximity
                    </button>
                </div>
            </form>
        </div>

        <!-- Map (unchanged) -->
        <div class="w-full lg:w-2/3">
            <div id="map" class="w-full h-[500px] rounded-xl shadow-lg"></div>
        </div>
    </section>

    <!-- Leaflet Map JS -->
    <script>
        const staMesaCoords = [14.5999, 121.0153];
        const map = L.map('map').setView(staMesaCoords, 19); // High zoom for streets

        // Free tile layer: OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Warehouse marker
        const warehouseMarker = L.marker(staMesaCoords).addTo(map)
            .bindPopup("Warehouse")
            .openPopup();

        let deliveryMarker;
        let deliveryCircle;

        // Create a red icon for delivery
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

            // Add red delivery marker
            deliveryMarker = L.marker(e.latlng, { icon: redIcon }).addTo(map)
                .bindPopup("Delivery Location")
                .openPopup();

            // Small, light red circle
            deliveryCircle = L.circle(e.latlng, {
                color: '#f87171',
                fillColor: '#f87171',
                fillOpacity: 0.2,
                radius: 20  // very small circle
            }).addTo(map);

            document.getElementById('lat').value = e.latlng.lat.toFixed(6);
            document.getElementById('lng').value = e.latlng.lng.toFixed(6);
        });
    </script>
</body>
</html>