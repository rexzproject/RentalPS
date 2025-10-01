<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental PlayStation - Ponti Gaming House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-purple-600 shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-gamepad text-3xl"></i>
                    <h1 class="text-2xl font-bold">Ponti Gaming House</h1>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="#home" class="hover:text-blue-200 transition">Beranda</a>
                    <a href="#bookings" class="hover:text-blue-200 transition">Jadwal Hari Ini</a>
                    <a href="#catalog" class="hover:text-blue-200 transition">Katalog</a>
                    <a href="#contact" class="hover:text-blue-200 transition">Kontak</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="bg-gradient-to-br from-gray-800 to-gray-900 py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-6 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                Sewa PlayStation Terbaik
            </h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Nikmati pengalaman gaming terbaik dengan PlayStation terbaru. Kami menyediakan layanan rental dengan harga terjangkau dan kualitas terbaik.
            </p>
            <a href="#catalog" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                Lihat Katalog
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-800">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12">Mengapa Memilih Kami?</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-gray-700 rounded-lg">
                    <i class="fas fa-truck text-4xl text-blue-400 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-3">Antar Jemput</h4>
                    <p class="text-gray-300">Layanan antar jemput gratis ke seluruh area kota</p>
                </div>
                <div class="text-center p-6 bg-gray-700 rounded-lg">
                    <i class="fas fa-shield-alt text-4xl text-green-400 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-3">Aman & Terpercaya</h4>
                    <p class="text-gray-300">Semua perangkat dijamin bersih dan berfungsi dengan baik</p>
                </div>
                <div class="text-center p-6 bg-gray-700 rounded-lg">
                    <i class="fas fa-clock text-4xl text-purple-400 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-3">Fleksibel</h4>
                    <p class="text-gray-300">Rental per jam atau per hari sesuai kebutuhan Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Today's Bookings Section -->
    <section id="bookings" class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Jadwal Booking Hari Ini</h2>
                <p class="text-xl text-gray-300">Lihat jadwal yang sudah terisi dan slot yang masih tersedia</p>
            </div>

            @if($todayBookings->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($todayBookings as $booking)
                        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                                <h3 class="text-lg font-semibold text-white">{{ $booking->playStation->name }}</h3>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center text-gray-300">
                                    <i class="fas fa-user mr-3 text-blue-400"></i>
                                    <span>{{ $booking->customer_name }}</span>
                                </div>
                                
                                <div class="flex items-center text-gray-300">
                                    <i class="fas fa-clock mr-3 text-green-400"></i>
                                    <span>{{ $booking->start_datetime->format('H:i') }} - {{ $booking->end_datetime->format('H:i') }}</span>
                                </div>
                                
                                <div class="flex items-center text-gray-300">
                                    <i class="fas fa-map-marker-alt mr-3 text-yellow-400"></i>
                                    <span>{{ $booking->delivery_city }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between mt-4">
                                    <span class="px-3 py-1 bg-{{ $booking->status === 'confirmed' ? 'green' : ($booking->status === 'pending' ? 'yellow' : 'red') }}-500 text-white text-sm rounded-full">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                    <span class="text-blue-400 font-semibold">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-calendar-check text-6xl text-gray-600 mb-4"></i>
                    <h3 class="text-2xl font-semibold text-white mb-2">Belum Ada Booking Hari Ini</h3>
                    <p class="text-gray-400">Semua PlayStation tersedia untuk disewa!</p>
                </div>
            @endif

            <!-- Available Time Slots -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-white text-center mb-8">Slot Waktu Tersedia</h3>
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @php
                            $timeSlots = [];
                            for ($hour = 8; $hour <= 22; $hour++) {
                                $timeSlots[] = sprintf('%02d:00', $hour);
                            }
                            
                            $bookedSlots = $todayBookings->flatMap(function($booking) {
                                $slots = [];
                                $start = $booking->start_datetime->hour;
                                $end = $booking->end_datetime->hour;
                                for ($i = $start; $i < $end; $i++) {
                                    $slots[] = sprintf('%02d:00', $i);
                                }
                                return $slots;
                            })->toArray();
                        @endphp
                        
                        @foreach($timeSlots as $slot)
                            <div class="text-center p-3 rounded-lg {{ in_array($slot, $bookedSlots) ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                                <div class="font-semibold">{{ $slot }}</div>
                                <div class="text-xs mt-1">
                                    {{ in_array($slot, $bookedSlots) ? 'Terisi' : 'Tersedia' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="flex justify-center mt-6 space-x-6">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                            <span class="text-gray-300">Tersedia</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-red-500 rounded mr-2"></div>
                            <span class="text-gray-300">Terisi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PlayStation Catalog -->
    <section id="catalog" class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12">Katalog PlayStation</h3>
            
            @if($playstations->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($playstations as $playstation)
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                            @if($playstation->image_url)
                                <img src="{{ $playstation->image_url }}" alt="{{ $playstation->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                                    <i class="fas fa-gamepad text-6xl text-white"></i>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-xl font-bold">{{ $playstation->name }}</h4>
                                    <span class="px-3 py-1 bg-{{ $playstation->type == 'PS5' ? 'green' : 'blue' }}-500 text-white text-sm rounded-full">
                                        {{ $playstation->type }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-300 mb-4">{{ Str::limit($playstation->description, 100) }}</p>
                                
                                <div class="flex items-center mb-3">
                                    <i class="fas fa-gamepad text-blue-400 mr-2"></i>
                                    <span class="text-sm">{{ $playstation->controller_count }} Controller</span>
                                </div>
                                
                                @if($playstation->included_games && count($playstation->included_games) > 0)
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-400 mb-2">Game Tersedia:</p>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(array_slice($playstation->included_games, 0, 3) as $game)
                                                <span class="px-2 py-1 bg-gray-700 text-xs rounded">{{ $game }}</span>
                                            @endforeach
                                            @if(count($playstation->included_games) > 3)
                                                <span class="px-2 py-1 bg-gray-700 text-xs rounded">+{{ count($playstation->included_games) - 3 }} lainnya</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="border-t border-gray-700 pt-4">
                                    <div class="flex justify-between items-center mb-3">
                                        <div>
                                            <p class="text-sm text-gray-400">Per Jam</p>
                                            <p class="text-lg font-bold text-blue-400">Rp {{ number_format($playstation->hourly_rate, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-400">Per Hari</p>
                                            <p class="text-lg font-bold text-green-400">Rp {{ number_format($playstation->daily_rate, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('playstation.show', $playstation) }}" class="w-full bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-2 px-4 rounded transition duration-300 block text-center">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-gamepad text-6xl text-gray-600 mb-4"></i>
                    <p class="text-xl text-gray-400">Belum ada PlayStation yang tersedia saat ini.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-800">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-8">Hubungi Kami</h3>
            <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div>
                    <i class="fas fa-phone text-3xl text-blue-400 mb-3"></i>
                    <h4 class="text-lg font-semibold mb-2">Telepon</h4>
                    <p class="text-gray-300">+62 822-5174-8002</p>
                </div>
                <div>
                    <i class="fas fa-envelope text-3xl text-green-400 mb-3"></i>
                    <h4 class="text-lg font-semibold mb-2">Email</h4>
                    <p class="text-gray-300">rexzproject@gmail.com</p>
                </div>
                <div>
                    <i class="fas fa-map-marker-alt text-3xl text-purple-400 mb-3"></i>
                    <h4 class="text-lg font-semibold mb-2">Alamat</h4>
                    <p class="text-gray-300">Jl. Abdurrahman Wahid Gg Keramat Komplek Kurnia Asri Blok C8</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-700 py-8">
        <div class="container mx-auto px-4 text-center">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <i class="fas fa-gamepad text-2xl text-blue-400"></i>
                <h5 class="text-xl font-bold">Ponti Gaming House</h5>
            </div>
            <p class="text-gray-400">&copy; 2024 Ponti Gaming House. Semua hak dilindungi.</p>
        </div>
    </footer>

    <!-- Smooth Scrolling Script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>