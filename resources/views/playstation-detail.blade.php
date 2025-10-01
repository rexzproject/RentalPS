<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $playstation->name }} - Rental PlayStation</title>
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
                <a href="{{ route('landing') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </header>

    <!-- PlayStation Detail -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- PlayStation Info -->
                <div>
                    @if($playstation->image_url)
                        <img src="{{ $playstation->image_url }}" alt="{{ $playstation->name }}" class="w-full h-96 object-cover rounded-lg mb-6">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center rounded-lg mb-6">
                            <i class="fas fa-gamepad text-8xl text-white"></i>
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-3xl font-bold">{{ $playstation->name }}</h2>
                        <span class="px-4 py-2 bg-{{ $playstation->type == 'PS5' ? 'green' : 'blue' }}-500 text-white rounded-full">
                            {{ $playstation->type }}
                        </span>
                    </div>
                    
                    <p class="text-gray-300 text-lg mb-6">{{ $playstation->description }}</p>
                    
                    <!-- Specifications -->
                    <div class="bg-gray-800 rounded-lg p-6 mb-6">
                        <h3 class="text-xl font-semibold mb-4">Spesifikasi</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <i class="fas fa-gamepad text-blue-400 mr-3"></i>
                                <span>{{ $playstation->controller_count }} Controller</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-400 mr-3"></i>
                                <span>{{ $playstation->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Included Games -->
                    @if($playstation->included_games && count($playstation->included_games) > 0)
                        <div class="bg-gray-800 rounded-lg p-6 mb-6">
                            <h3 class="text-xl font-semibold mb-4">Game yang Disertakan</h3>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($playstation->included_games as $game)
                                    <div class="flex items-center">
                                        <i class="fas fa-play text-purple-400 mr-2"></i>
                                        <span class="text-sm">{{ $game }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Pricing -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-4">Harga Rental</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <p class="text-sm text-blue-200">Per Jam</p>
                                <p class="text-2xl font-bold">Rp {{ number_format($playstation->hourly_rate, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-green-200">Per Hari</p>
                                <p class="text-2xl font-bold">Rp {{ number_format($playstation->daily_rate, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Booking Form -->
                <div class="bg-gray-800 rounded-lg p-8">
                    <h3 class="text-2xl font-bold mb-6">Form Pemesanan</h3>
                    
                    <form id="bookingForm" class="space-y-6">
                        <input type="hidden" name="play_station_id" value="{{ $playstation->id }}">
                        
                        <!-- Customer Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Nama Lengkap *</label>
                                <input type="text" name="customer_name" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Email *</label>
                                <input type="email" name="customer_email" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">No. Telepon *</label>
                            <input type="tel" name="customer_phone" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <!-- Delivery Address -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Alamat Lengkap *</label>
                            <textarea name="delivery_address" required rows="3" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Kota *</label>
                                <input type="text" name="delivery_city" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Kode Pos *</label>
                                <input type="text" name="delivery_postal_code" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Tipe Rental *</label>
                                <select name="rental_type" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Pilih Tipe</option>
                                    <option value="hourly">Per Jam</option>
                                    <option value="daily">Per Hari</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Durasi *</label>
                                <select name="duration" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Pilih Durasi</option>
                                    <!-- Hourly options (will be shown when rental_type is hourly) -->
                                    <option value="3" data-type="hourly">3 Jam - Rp 55.000</option>
                                    <option value="8" data-type="hourly">8 Jam - Rp 125.000</option>
                                    <option value="12" data-type="hourly">12 Jam - Rp 165.000</option>
                                    <option value="24" data-type="hourly">24 Jam - Rp 225.000</option>
                                    <!-- Daily options (will be shown when rental_type is daily) -->
                                    <option value="1" data-type="daily">1 Hari - Rp 225.000</option>
                                    <option value="2" data-type="daily">2 Hari - Rp 450.000</option>
                                    <option value="3" data-type="daily">3 Hari - Rp 675.000</option>
                                    <option value="4" data-type="daily">4 Hari - Rp 900.000</option>
                                    <option value="5" data-type="daily">5 Hari - Rp 1.125.000</option>
                                    <option value="6" data-type="daily">6 Hari - Rp 1.350.000</option>
                                    <option value="7" data-type="daily">7 Hari - Rp 1.400.000</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Tanggal & Waktu Mulai *</label>
                                <input type="datetime-local" name="start_datetime" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Tanggal & Waktu Selesai *</label>
                                <input type="datetime-local" name="end_datetime" required disabled class="w-full px-4 py-2 bg-gray-600 border border-gray-600 rounded-lg cursor-not-allowed opacity-75">
                            </div>
                        </div>
                        <!-- Total Price Display -->
                        <div class="bg-gray-700 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium">Total Harga:</span>
                                <span id="totalPrice" class="text-2xl font-bold text-green-400">Rp 0</span>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2">Catatan Tambahan</label>
                            <textarea name="notes" rows="3" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Catatan khusus untuk pesanan Anda..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                            <i class="fas fa-shopping-cart mr-2"></i>Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-8 max-w-md mx-4">
            <div class="text-center">
                <i class="fas fa-check-circle text-6xl text-green-400 mb-4"></i>
                <h3 class="text-2xl font-bold mb-4">Pesanan Berhasil!</h3>
                <p class="text-gray-300 mb-4">Booking Anda telah berhasil dikirim!</p>
                <p id="successMessage" class="text-green-400 font-medium mb-6">Kami akan menghubungi Anda segera untuk konfirmasi.</p>
                <button onclick="closeModal()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        const hourlyRate = {{ $playstation->hourly_rate }};
        const dailyRate = {{ $playstation->daily_rate }};
        
        function calculateTotal() {
            const rentalType = document.querySelector('[name="rental_type"]').value;
            const duration = parseInt(document.querySelector('[name="duration"]').value) || 0;
            
            if (rentalType && duration) {
                fetch('/api/calculate-price', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        play_station_id: {{ $playstation->id }},
                        rental_type: rentalType,
                        duration: parseInt(duration)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalPrice').textContent = data.formatted_price;
                    document.querySelector('[name="total_price"]').value = data.total_price;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
            
            // Calculate end date automatically
            calculateEndDate();
        }
        
        function calculateEndDate() {
            const startDatetime = document.querySelector('[name="start_datetime"]').value;
            const duration = parseInt(document.querySelector('[name="duration"]').value) || 0;
            const rentalType = document.querySelector('[name="rental_type"]').value;
            
            if (startDatetime && duration && rentalType) {
                const startDate = new Date(startDatetime);
                let endDate;
                
                if (rentalType === 'hourly') {
                    endDate = new Date(startDate.getTime() + (duration * 60 * 60 * 1000)); // Add hours
                } else {
                    endDate = new Date(startDate.getTime() + (duration * 24 * 60 * 60 * 1000)); // Add days
                }
                
                // Format end date to match datetime-local input format
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, '0');
                const day = String(endDate.getDate()).padStart(2, '0');
                const hours = String(endDate.getHours()).padStart(2, '0');
                const minutes = String(endDate.getMinutes()).padStart(2, '0');
                
                const formattedEndDate = `${year}-${month}-${day}T${hours}:${minutes}`;
                document.querySelector('[name="end_datetime"]').value = formattedEndDate;
            }
        }
        
        // Add hidden input for total_price
        const form = document.getElementById('bookingForm');
        const totalPriceInput = document.createElement('input');
        totalPriceInput.type = 'hidden';
        totalPriceInput.name = 'total_price';
        form.appendChild(totalPriceInput);
        
        // Function to filter duration options based on rental type
        function filterDurationOptions() {
            const rentalType = document.querySelector('[name="rental_type"]').value;
            const durationSelect = document.querySelector('[name="duration"]');
            const options = durationSelect.querySelectorAll('option');
            
            // Reset duration selection
            durationSelect.value = '';
            
            options.forEach(option => {
                if (option.value === '') {
                    // Always show the default "Pilih Durasi" option
                    option.style.display = 'block';
                } else if (rentalType === '') {
                    // Hide all options if no rental type is selected
                    option.style.display = 'none';
                } else {
                    // Show options that match the selected rental type
                    const optionType = option.getAttribute('data-type');
                    option.style.display = (optionType === rentalType) ? 'block' : 'none';
                }
            });
            
            // Clear total price when rental type changes
            document.getElementById('totalPrice').textContent = 'Rp 0';
        }
        
        // Event listeners for calculation
        document.querySelector('[name="rental_type"]').addEventListener('change', function() {
            filterDurationOptions();
            calculateTotal();
        });
        document.querySelector('[name="duration"]').addEventListener('change', calculateTotal);
        document.querySelector('[name="start_datetime"]').addEventListener('change', calculateEndDate);
        
        // Form submission
        document.getElementById('bookingForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Validate required fields
            if (!data.customer_name || !data.customer_email || !data.customer_phone || 
                !data.rental_type || !data.duration || !data.start_datetime) {
                alert('Mohon lengkapi semua field yang wajib diisi!');
                return;
            }
            
            // Add missing required fields for backend
            data.delivery_city = data.delivery_city || 'Jakarta';
            data.delivery_postal_code = data.delivery_postal_code || '12345';
            
            try {
                // First, save booking to database
                const response = await fetch('/api/booking', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                // Check if response is ok
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Response error:', errorText);
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                
                // Try to parse JSON
                let result;
                try {
                    result = await response.json();
                } catch (parseError) {
                    const responseText = await response.text();
                    console.error('JSON parse error:', parseError);
                    console.error('Response text:', responseText);
                    throw new Error('Server returned invalid JSON response');
                }
                
                if (!result.success) {
                    throw new Error(result.message || 'Terjadi kesalahan saat menyimpan booking');
                }
                
                // If booking saved successfully, create WhatsApp message
                const playstationName = '{{ $playstation->name }}';
                const totalPrice = document.getElementById('totalPrice').textContent;
                const rentalTypeText = data.rental_type === 'hourly' ? 'Per Jam' : 'Per Hari';
                const durationText = data.rental_type === 'hourly' ? data.duration + ' Jam' : data.duration + ' Hari';
                
                // Format dates
                const startDate = new Date(data.start_datetime);
                const endDate = new Date(data.end_datetime);
                const formatDate = (date) => {
                    return date.toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                };
                
                const message = `*BOOKING PLAYSTATION*\n\n` +
                    `🎮 *PlayStation:* ${playstationName}\n` +
                    `👤 *Nama:* ${data.customer_name}\n` +
                    `📧 *Email:* ${data.customer_email}\n` +
                    `📱 *Telepon:* ${data.customer_phone}\n` +
                    `📍 *Alamat:* ${data.delivery_address}\n\n` +
                    `⏰ *Tipe Rental:* ${rentalTypeText}\n` +
                    `⏱️ *Durasi:* ${durationText}\n` +
                    `📅 *Mulai:* ${formatDate(startDate)}\n` +
                    `📅 *Selesai:* ${formatDate(endDate)}\n\n` +
                    `💰 *Total Harga:* ${totalPrice}\n\n` +
                    `📝 *Catatan:* ${data.notes || 'Tidak ada catatan'}\n\n` +
                    `ID Booking: #${result.booking_id}\n\n` +
                    `Mohon konfirmasi ketersediaan dan detail pembayaran. Terima kasih! 🙏`;
                
                // Encode message for WhatsApp URL
                const encodedMessage = encodeURIComponent(message);
                const whatsappURL = `https://wa.me/6282251748002?text=${encodedMessage}`;
                
                // Open WhatsApp
                window.open(whatsappURL, '_blank');
                
                // Show success modal
                document.getElementById('successMessage').textContent = 'Booking berhasil disimpan! Anda akan diarahkan ke WhatsApp untuk konfirmasi.';
                document.getElementById('successModal').classList.remove('hidden');
                document.getElementById('successModal').classList.add('flex');
                
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        });
        
        function closeModal() {
            document.getElementById('successModal').classList.add('hidden');
            document.getElementById('successModal').classList.remove('flex');
            
            // Reset form
            document.getElementById('bookingForm').reset();
            document.getElementById('totalPrice').textContent = 'Rp 0';
        }
    </script>
</body>
</html>