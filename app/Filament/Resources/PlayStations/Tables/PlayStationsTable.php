<?php

namespace App\Filament\Resources\PlayStations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;

class PlayStationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Gambar')
                    ->circular()
                    ->size(60),
                
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                
                BadgeColumn::make('type')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'PS4',
                        'success' => 'PS5',
                    ]),
                
                TextColumn::make('controller_count')
                    ->label('Controller')
                    ->suffix(' buah'),
                
                TextColumn::make('hourly_rate')
                    ->label('Tarif/Jam')
                    ->money('IDR')
                    ->sortable(),
                
                TextColumn::make('daily_rate')
                    ->label('Tarif/Hari')
                    ->money('IDR')
                    ->sortable(),
                
                BooleanColumn::make('is_available')
                    ->label('Tersedia')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
