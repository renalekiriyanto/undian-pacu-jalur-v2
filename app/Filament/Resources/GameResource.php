<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Canoe;
use App\Models\Game;
use App\Models\Lap;
use App\Models\Lottery;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        TextInput::make('urutan_hilir')
                            ->label('Urutan Hilir')
                            ->numeric()
                            ->columnSpan(12),
                    ]),
                Select::make('lottery_id')
                    ->label('Undian')
                    ->options(Lottery::all()->pluck('name', 'id')),
                Select::make('lap_id')
                    ->label('Putaran')
                    ->options(Lap::all()->pluck('name', 'id')),
                Select::make('jalur_kiri')
                    ->label('Kiri')
                    ->options(Canoe::all()->pluck('name', 'id'))->searchable(),
                Select::make('jalur_kanan')
                    ->label('Kanan')
                    ->options(Canoe::all()->pluck('name', 'id'))->searchable(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'PENDING' => 'PENDING',
                        'LIVE' => 'LIVE',
                        'FAILED' => 'FAILED',
                        'ANNOUNCEMENT' => 'ANNOUNCEMENT',
                        'FINISH' => 'FINISH'
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('undian.name')
                    ->label('Undian')->searchable(),
                TextColumn::make('urutan_hilir'),
                TextColumn::make('name_jalur_kiri.name')->searchable(),
                TextColumn::make('name_jalur_kanan.name')->searchable(),
            ])->defaultSort('urutan_hilir')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
