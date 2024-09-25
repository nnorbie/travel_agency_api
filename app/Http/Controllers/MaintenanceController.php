<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return response()->json(['message' => 'All caches cleared successfully']);
    }

    public function migrate()
    {
        Artisan::call('migrate');

        return response()->json(['message' => 'Migrations run successfully']);
    }
}
