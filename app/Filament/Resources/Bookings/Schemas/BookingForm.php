<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use App\Models\PlayStation;

class BookingForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('play_station_id')
                    ->label('PlayStation')
                    ->options(PlayStation::where('is_available', true)->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                
                TextInput::make('customer_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Pelanggan'),
                
                TextInput::make('customer_email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Email Pelanggan'),
                
                TextInput::make('customer_phone')
                    ->tel()
                    ->required()
                    ->maxLength(20)
                    ->label('No. Telepon'),
                
                Textarea::make('delivery_address')
                    ->required()
                    ->maxLength(500)
                    ->label('Alamat Pengiriman'),
                
                TextInput::make('delivery_city')
                    ->required()
                    ->maxLength(100)
                    ->label('Kota'),
                
                TextInput::make('delivery_postal_code')
                    ->required()
                    ->maxLength(10)
                    ->label('Kode Pos'),
                
                DateTimePicker::make('start_datetime')
                    ->required()
                    ->label('Tanggal & Waktu Mulai'),
                
                DateTimePicker::make('end_datetime')
                    ->required()
                    ->label('Tanggal & Waktu Selesai'),
                
                Select::make('rental_type')
                    ->required()
                    ->options([
                        'hourly' => 'Per Jam',
                        'daily' => 'Per Hari',
                    ])
                    ->label('Tipe Rental'),
                
                TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->label('Durasi'),
                
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Total Harga'),
                
                Select::make('status')
                    ->required()
                    ->options([
                        'pending' => 'Menunggu',
                        'confirmed' => 'Dikonfirmasi',
                        'delivered' => 'Dikirim',
                        'active' => 'Aktif',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->default('pending')
                    ->label('Status'),
                
                Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }
}
