<?php

namespace App\Filament\Resources\PlayStations;

use App\Filament\Resources\PlayStations\Pages\CreatePlayStation;
use App\Filament\Resources\PlayStations\Pages\EditPlayStation;
use App\Filament\Resources\PlayStations\Pages\ListPlayStations;
use App\Filament\Resources\PlayStations\Schemas\PlayStationForm;
use App\Filament\Resources\PlayStations\Tables\PlayStationsTable;
use App\Models\PlayStation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PlayStationResource extends Resource
{
    protected static ?string $model = PlayStation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PlayStationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlayStationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlayStations::route('/'),
            'create' => CreatePlayStation::route('/create'),
            'edit' => EditPlayStation::route('/{record}/edit'),
        ];
    }
}
