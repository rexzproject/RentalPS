<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                
                TextColumn::make('playStation.name')
                    ->label('PlayStation')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('customer_phone')
                    ->label('No. Telepon')
                    ->searchable(),
                
                TextColumn::make('delivery_city')
                    ->label('Kota')
                    ->searchable(),
                
                TextColumn::make('start_datetime')
                    ->label('Mulai')
                    ->dateTime()
                    ->sortable(),
                
                TextColumn::make('end_datetime')
                    ->label('Selesai')
                    ->dateTime()
                    ->sortable(),
                
                BadgeColumn::make('rental_type')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'hourly',
                        'success' => 'daily',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'hourly' => 'Per Jam',
                        'daily' => 'Per Hari',
                        default => $state,
                    }),
                
                TextColumn::make('duration')
                    ->label('Durasi')
                    ->suffix(fn ($record) => $record->rental_type === 'hourly' ? ' jam' : ' hari'),
                
                TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
                
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'confirmed',
                        'primary' => 'delivered',
                        'success' => ['active', 'completed'],
                        'danger' => 'cancelled',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'confirmed' => 'Dikonfirmasi',
                        'delivered' => 'Dikirim',
                        'active' => 'Aktif',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    }),
                
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
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update(['status' => 'confirmed']);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Booking')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui booking ini?')
                    ->modalSubmitActionLabel('Ya, Setujui'),
                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update(['status' => 'cancelled']);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Booking')
                    ->modalDescription('Apakah Anda yakin ingin menolak booking ini?')
                    ->modalSubmitActionLabel('Ya, Tolak'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
