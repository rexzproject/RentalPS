<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\PlayStation;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'play_station_id' => 'required|exists:play_stations,id',
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'required|string|max:20',
                'delivery_address' => 'required|string',
                'delivery_city' => 'required|string|max:100',
                'delivery_postal_code' => 'required|string|max:10',
                'start_datetime' => 'required|date',
                'rental_type' => 'required|in:hourly,daily',
                'duration' => 'required|integer|min:1',
                'notes' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            $playStation = PlayStation::findOrFail($request->play_station_id);
            
            // Calculate end datetime and total price
            $startDatetime = Carbon::parse($request->start_datetime);
            
            if ($request->rental_type === 'hourly') {
                $endDatetime = $startDatetime->copy()->addHours((int) $request->duration);
                $totalPrice = $this->getHourlyPrice((int) $request->duration);
            } else {
                $endDatetime = $startDatetime->copy()->addDays((int) $request->duration);
                $totalPrice = $this->getDailyPrice((int) $request->duration);
            }

            // Create booking
            $booking = Booking::create([
                'play_station_id' => $request->play_station_id,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'delivery_address' => $request->delivery_address,
                'delivery_city' => $request->delivery_city,
                'delivery_postal_code' => $request->delivery_postal_code,
                'start_datetime' => $startDatetime,
                'end_datetime' => $endDatetime,
                'rental_type' => $request->rental_type,
                'duration' => $request->duration,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat! Kami akan menghubungi Anda segera.',
                'booking_id' => $booking->id,
                'total_price' => number_format($totalPrice, 0, ',', '.')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function calculatePrice(Request $request)
    {
        $request->validate([
            'play_station_id' => 'required|exists:play_stations,id',
            'rental_type' => 'required|in:hourly,daily',
            'duration' => 'required|integer|min:1',
        ]);

        $playStation = PlayStation::findOrFail($request->play_station_id);
        
        if ($request->rental_type === 'hourly') {
            // Struktur harga baru berdasarkan jam
            $totalPrice = $this->getHourlyPrice((int) $request->duration);
        } else {
            // Struktur harga baru berdasarkan hari
            $totalPrice = $this->getDailyPrice((int) $request->duration);
        }

        return response()->json([
            'total_price' => $totalPrice,
            'formatted_price' => 'Rp ' . number_format($totalPrice, 0, ',', '.')
        ]);
    }

    private function getHourlyPrice($hours)
    {
        // Harga tetap berdasarkan durasi yang dipilih
        $fixedPrices = [
            3 => 55000,   // 3 jam = Rp 55.000
            8 => 125000,  // 8 jam = Rp 125.000
            12 => 165000, // 12 jam = Rp 165.000
            24 => 225000, // 24 jam = Rp 225.000
        ];
        
        // Jika durasi ada dalam array harga tetap, gunakan harga tersebut
        if (isset($fixedPrices[$hours])) {
            return $fixedPrices[$hours];
        }
        
        // Default fallback untuk durasi lain (seharusnya tidak pernah tercapai dengan dropdown)
        return 20000 * $hours;
    }

    private function getDailyPrice($days)
    {
        // Harga berdasarkan hari
        if ($days == 1) {
            return 225000; // 1 hari = Rp 225.000
        } elseif ($days >= 2 && $days <= 6) {
            return 225000 * $days; // 2-6 hari = Rp 225.000 x hari
        } elseif ($days == 7) {
            return 1400000; // 7 hari = Rp 1.400.000
        }
        
        // Default fallback untuk durasi lain
        return 225000 * $days;
    }
}
