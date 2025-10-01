<?php

namespace App\Filament\Resources\PlayStations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;

class PlayStationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama PlayStation'),
                
                Textarea::make('description')
                    ->required()
                    ->maxLength(1000)
                    ->label('Deskripsi'),
                
                Select::make('type')
                    ->required()
                    ->options([
                        'PS4' => 'PlayStation 4',
                        'PS5' => 'PlayStation 5',
                    ])
                    ->label('Tipe PlayStation'),
                
                TextInput::make('controller_count')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(4)
                    ->label('Jumlah Controller'),
                
                TextInput::make('hourly_rate')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Tarif per Jam'),
                
                TextInput::make('daily_rate')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Tarif per Hari'),
                
                TagsInput::make('included_games')
                    ->label('Game yang Disertakan')
                    ->placeholder('Masukkan nama game'),
                
                TextInput::make('image_url')
                    ->url()
                    ->label('URL Gambar'),
                
                Toggle::make('is_available')
                    ->default(true)
                    ->label('Tersedia'),
            ]);
    }
}
