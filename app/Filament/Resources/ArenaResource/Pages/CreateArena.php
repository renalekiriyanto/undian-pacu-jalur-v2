<?php

namespace App\Filament\Resources\ArenaResource\Pages;

use App\Filament\Resources\ArenaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArena extends CreateRecord
{
    protected static string $resource = ArenaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}