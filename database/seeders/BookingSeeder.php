<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\PlayStation;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $playstations = PlayStation::all();
        
        if ($playstations->count() > 0) {
            $bookings = [
                [
                    'play_station_id' => $playstations->first()->id,
                    'customer_name' => 'Ahmad Rizki',
                    'customer_email' => 'ahmad.rizki@email.com',
                    'customer_phone' => '081234567890',
                    'delivery_address' => 'Jl. Merdeka No. 123',
                    'delivery_city' => 'Jakarta Pusat',
                    'delivery_postal_code' => '10110',
                    'start_datetime' => Carbon::today()->setHour(10)->setMinute(0),
                    'end_datetime' => Carbon::today()->setHour(14)->setMinute(0),
                    'rental_type' => 'hourly',
                    'duration' => 4,
                    'total_price' => $playstations->first()->hourly_rate * 4,
                    'status' => 'confirmed',
                    'notes' => 'Mohon diantar tepat waktu',
                ],
                [
                    'play_station_id' => $playstations->skip(1)->first()->id ?? $playstations->first()->id,
                    'customer_name' => 'Siti Nurhaliza',
                    'customer_email' => 'siti.nurhaliza@email.com',
                    'customer_phone' => '081987654321',
                    'delivery_address' => 'Jl. Sudirman No. 456',
                    'delivery_city' => 'Jakarta Selatan',
                    'delivery_postal_code' => '12190',
                    'start_datetime' => Carbon::today()->setHour(15)->setMinute(0),
                    'end_datetime' => Carbon::today()->setHour(19)->setMinute(0),
                    'rental_type' => 'hourly',
                    'duration' => 4,
                    'total_price' => ($playstations->skip(1)->first()->hourly_rate ?? $playstations->first()->hourly_rate) * 4,
                    'status' => 'pending',
                    'notes' => 'Untuk acara ulang tahun anak',
                ],
                [
                    'play_station_id' => $playstations->skip(2)->first()->id ?? $playstations->first()->id,
                    'customer_name' => 'Budi Santoso',
                    'customer_email' => 'budi.santoso@email.com',
                    'customer_phone' => '081122334455',
                    'delivery_address' => 'Jl. Gatot Subroto No. 789',
                    'delivery_city' => 'Jakarta Barat',
                    'delivery_postal_code' => '11460',
                    'start_datetime' => Carbon::today()->setHour(20)->setMinute(0),
                    'end_datetime' => Carbon::today()->setHour(22)->setMinute(0),
                    'rental_type' => 'hourly',
                    'duration' => 2,
                    'total_price' => ($playstations->skip(2)->first()->hourly_rate ?? $playstations->first()->hourly_rate) * 2,
                    'status' => 'confirmed',
                    'notes' => 'Gaming malam dengan teman-teman',
                ],
            ];

            foreach ($bookings as $booking) {
                Booking::create($booking);
            }
        }
    }
}
