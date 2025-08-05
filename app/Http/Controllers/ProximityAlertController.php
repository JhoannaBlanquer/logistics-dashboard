<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    return view('dashboard.alerts', ['data' => $data]);
}
}