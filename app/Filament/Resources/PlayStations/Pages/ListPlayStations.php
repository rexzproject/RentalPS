<?php

namespace App\Filament\Resources\PlayStations\Pages;

use App\Filament\Resources\PlayStations\PlayStationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlayStations extends ListRecords
{
    protected static string $resource = PlayStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
