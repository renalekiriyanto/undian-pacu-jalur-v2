<?php

namespace App\Filament\Resources\CanoeResource\Pages;

use App\Filament\Resources\CanoeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCanoes extends ListRecords
{
    protected static string $resource = CanoeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
