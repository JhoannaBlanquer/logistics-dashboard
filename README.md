# Logistics Dashboard

A Laravel-based dashboard that integrates with a Flask microservice to trigger AI-powered delivery proximity alerts. This app allows users to input delivery coordinates, select proximity range, and receive results when deliveries fall within the specified proximity to the warehouse.

---

## Tech Stack

- Laravel 10+
- Blade Templating
- Laravel HTTP Client
- Leaflet.js (Interactive Map)
- Integration with Flask API

---

## Features

- Input delivery coordinates manually or via map
- Select proximity radius (100m, 250m, 500m)
- Send data to Flask microservice and receive proximity results
- Real-time alert display when delivery is within defined range
- Basic map styling using [MapTiler + Leaflet.js](https://www.maptiler.com/maps/)
- Log all proximity checks in the database and view them on the dashboard

---

## Installation

```bash
git clone https://github.com/JhoannaBlanquer/logistics-dashboard.git
cd logistics-dashboard

# Install dependencies
composer install

# Copy and configure environment variables
cp .env.example .env
php artisan key:generate

#Run database migrations (if applicable)
php artisan migrate

# Serve the Laravel app
php artisan serve
```

Access the app at:  
**http://127.0.0.1:8000/**

---

## API Integration

This app connects to the Flask microservice hosted at:  
[Flask Proximity API](https://flask-proximity-alert-n0v7.onrender.com)

- Laravel sends POST requests to the `/check_proximity` endpoint with user-defined coordinates and radius.
- Flask responds with:
  - Distance (in meters)
  - Boolean flag: `within_range`

---

## Configuration Notes

Update your `.env` file or relevant controller with your Flask API URL:

```env
FLASK_API_URL=https://flask-proximity-alert-n0v7.onrender.com/check_proximity
```

Or hardcode it in the controller:

```php
$response = Http::post('https://flask-proximity-alert-n0v7.onrender.com/check_proximity', [...]);
```