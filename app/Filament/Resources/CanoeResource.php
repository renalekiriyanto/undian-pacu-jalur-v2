<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CanoeResource\Pages;
use App\Filament\Resources\CanoeResource\RelationManagers;
use App\Models\Canoe;
use App\Models\Region;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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

class CanoeResource extends Resource
{
    protected static ?string $model = Canoe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Nama Jalur')
                ->live(debounce:'1000')
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Hidden::make('slug'),
                Select::make('region_id')
                ->label('Asal')
                ->options(Region::all()->pluck('name', 'id'))
                ->searchable(),
                TextInput::make('est_year')
                ->label('Tahun Pembuatan')
                ->maxLength(4)
                ->minLength(4)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()
                ->label('Nama Jalur'),
                TextColumn::make('region.name')->label('Asal'),
                TextColumn::make('region.district.slug')->label('Kecamatan')
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListCanoes::route('/'),
            'create' => Pages\CreateCanoe::route('/create'),
            'edit' => Pages\EditCanoe::route('/{record}/edit'),
        ];
    }
}