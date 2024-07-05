<?php

namespace App\Filament\Resources\RegionResource\Pages;

use App\Filament\Resources\RegionResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Panel;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Cancel;
use Illuminate\Contracts\Support\Htmlable;

class CreateRegion extends CreateRecord
{
    protected static string $resource = RegionResource::class;
    protected static ?string $title = 'Tambah Daerah';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}