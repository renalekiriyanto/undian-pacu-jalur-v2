<?php

namespace App\Filament\Resources\LapResource\Pages;

use App\Filament\Resources\LapResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLap extends CreateRecord
{
    protected static string $resource = LapResource::class;
    protected static ?string $title = 'Tambah Lap';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}