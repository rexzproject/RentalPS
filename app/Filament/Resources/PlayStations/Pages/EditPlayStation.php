<?php

namespace App\Filament\Resources\PlayStations\Pages;

use App\Filament\Resources\PlayStations\PlayStationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPlayStation extends EditRecord
{
    protected static string $resource = PlayStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
