<?php

namespace App\Filament\Resources\CanoeResource\Pages;

use App\Filament\Resources\CanoeResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateCanoe extends CreateRecord
{
    protected static string $resource = CanoeResource::class;
    protected static ?string $title = 'Tambah Jalur';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}