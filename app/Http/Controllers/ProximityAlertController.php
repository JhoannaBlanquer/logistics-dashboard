<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Log;

class ProximityAlertController extends Controller
{
    public function showForm()
    {
        return view('dashboard.form');
    }

    public function checkProximity(Request $request)
    {
        try {
            $response = Http::timeout(10)->post('https://flask-proximity-alert-n0v7.onrender.com/check_proximity', [
                'warehouse' => [14.5999, 121.0153],
                'delivery' => [$request->lat, $request->lng],
                'radius' => $request->radius ?? 250
            ]);

            $data = $response->successful() ? $response->json() : null;

        } catch (\Exception $e) {
            $data = null;
        }

        Log::create([
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'radius' => $request->radius ?? 250,
            'distance' => $data['distance'] ?? 0,
            'within_range' => $data['within_range'] ?? false,
        ]);

        return view('dashboard.alerts', ['data' => $data]);
    }

    public function showLogs()
    {
        $logs = Log::oldest()->get();
        return view('dashboard.logs', compact('logs'));
    }
}