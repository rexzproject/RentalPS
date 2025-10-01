<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PlayStation;

class PlayStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $playstations = [
            [
                'name' => 'PlayStation 5 Standard Edition',
                'description' => 'PlayStation 5 terbaru dengan teknologi SSD ultra-cepat dan ray tracing. Dilengkapi dengan controller DualSense yang revolusioner dengan haptic feedback.',
                'type' => 'PS5',
                'controller_count' => 2,
                'hourly_rate' => 18334, // Base rate untuk kalkulasi
                'daily_rate' => 220000, // 24 jam
                'included_games' => [
                    'Spider-Man: Miles Morales',
                    'Demon\'s Souls',
                    'Ratchet & Clank: Rift Apart',
                    'Horizon Forbidden West',
                    'God of War Ragnarök'
                ],
                'image_url' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?w=500',
                'is_available' => true,
            ],
            [
                'name' => 'PlayStation 5 Digital Edition',
                'description' => 'PlayStation 5 Digital Edition tanpa optical drive. Sempurna untuk gaming digital dengan performa yang sama dengan PS5 standard.',
                'type' => 'PS5',
                'controller_count' => 2,
                'hourly_rate' => 18334, // Base rate untuk kalkulasi
                'daily_rate' => 220000, // 24 jam
                'included_games' => [
                    'Astro\'s Playroom',
                    'Ghost of Tsushima Director\'s Cut',
                    'The Last of Us Part II',
                    'Uncharted: Legacy of Thieves Collection'
                ],
                'image_url' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?w=500',
                'is_available' => true,
            ],
            [
                'name' => 'PlayStation 4 Pro',
                'description' => 'PlayStation 4 Pro dengan kemampuan 4K gaming dan HDR. Dilengkapi dengan library game yang sangat luas dan controller yang nyaman.',
                'type' => 'PS4',
                'controller_count' => 2,
                'hourly_rate' => 18334, // Base rate untuk kalkulasi
                'daily_rate' => 220000, // 24 jam
                'included_games' => [
                    'The Last of Us Part II',
                    'God of War (2018)',
                    'Spider-Man',
                    'Horizon Zero Dawn',
                    'Uncharted 4',
                    'Bloodborne',
                    'Persona 5'
                ],
                'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=500',
                'is_available' => true,
            ],
            [
                'name' => 'PlayStation 4 Slim',
                'description' => 'PlayStation 4 Slim yang compact dan hemat energi. Cocok untuk gaming casual dengan koleksi game eksklusif PlayStation.',
                'type' => 'PS4',
                'controller_count' => 2,
                'hourly_rate' => 18334, // Base rate untuk kalkulasi
                'daily_rate' => 220000, // 24 jam
                'included_games' => [
                    'Grand Theft Auto V',
                    'FIFA 23',
                    'Call of Duty: Modern Warfare II',
                    'Minecraft',
                    'Crash Bandicoot N. Sane Trilogy'
                ],
                'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=500',
                'is_available' => true,
            ],
            [
                'name' => 'PlayStation 5 + VR Bundle',
                'description' => 'Paket lengkap PlayStation 5 dengan PlayStation VR untuk pengalaman gaming immersive yang tak terlupakan.',
                'type' => 'PS5',
                'controller_count' => 4,
                'hourly_rate' => 18334, // Base rate untuk kalkulasi
                'daily_rate' => 220000, // 24 jam
                'included_games' => [
                    'Horizon Call of the Mountain',
                    'Beat Saber',
                    'Resident Evil 4 VR',
                    'Gran Turismo 7',
                    'Astro Bot Rescue Mission'
                ],
                'image_url' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?w=500',
                'is_available' => true,
            ],
            [
                'name' => 'PlayStation 4 Family Pack',
                'description' => 'PlayStation 4 dengan 4 controller untuk gaming bersama keluarga. Dilengkapi dengan game multiplayer yang seru.',
                'type' => 'PS4',
                'controller_count' => 4,
                'hourly_rate' => 18334, // Base rate untuk kalkulasi
                'daily_rate' => 220000, // 24 jam
                'included_games' => [
                    'Overcooked! All You Can Eat',
                    'Moving Out',
                    'Fall Guys',
                    'Rocket League',
                    'Gang Beasts',
                    'Mortal Kombat 11'
                ],
                'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=500',
                'is_available' => false,
            ]
        ];

        foreach ($playstations as $playstation) {
            PlayStation::create($playstation);
        }
    }
}
