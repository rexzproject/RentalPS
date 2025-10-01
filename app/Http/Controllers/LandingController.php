<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayStation;
use App\Models\Booking;

class LandingController extends Controller
{
    public function index()
    {
        $playstations = PlayStation::where('is_available', true)->get();
        
        // Get today's bookings
        $todayBookings = Booking::with('playStation')
            ->whereDate('start_datetime', today())
            ->where('status', '!=', 'cancelled')
            ->orderBy('start_datetime')
            ->get();
        
        return view('landing', compact('playstations', 'todayBookings'));
    }

    public function show(PlayStation $playstation)
    {
        return view('playstation-detail', compact('playstation'));
    }
}
