<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArenaResource\Pages;
use App\Filament\Resources\ArenaResource\RelationManagers;
use App\Models\Arena;
use App\Models\District;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ArenaResource extends Resource
{
    protected static ?string $model = Arena::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Nama Arena')
                ->live(debounce:'500')
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Hidden::make('slug'),
                Select::make('district_id')
                ->label('Kecamatan')
                ->options(District::all()->pluck('name', 'id'))
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Arena'),
                TextColumn::make('district.name')->label('Kecamatan')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label('Hapus')
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
            'index' => Pages\ListArenas::route('/'),
            'create' => Pages\CreateArena::route('/create'),
            'edit' => Pages\EditArena::route('/{record}/edit'),
        ];
    }
}