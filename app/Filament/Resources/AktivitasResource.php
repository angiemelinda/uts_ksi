<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AktivitasResource\Pages;
use App\Filament\Resources\AktivitasResource\RelationManagers;
use App\Models\Aktivitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AktivitasResource extends Resource
{
    protected static ?string $model = Aktivitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Log Aktivitas';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Aktivitas')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('aksi')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('entitas')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('entitas_id')
                            ->numeric()
                            ->required(),
                        Forms\Components\DateTimePicker::make('waktu')
                            ->required()
                            ->default(now()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('aksi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('entitas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('entitas_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Pengguna')
                    ->relationship('user', 'name')
                    ->preload()
                    ->searchable(),
                Tables\Filters\SelectFilter::make('entitas')
                    ->options([
                        'pelanggan' => 'Pelanggan',
                        'toko' => 'Toko',
                        'transaksi' => 'Transaksi',
                        'user' => 'Pengguna',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAktivitas::route('/'),
            'create' => Pages\CreateAktivitas::route('/create'),
            'edit' => Pages\EditAktivitas::route('/{record}/edit'),
        ];
    }
}
