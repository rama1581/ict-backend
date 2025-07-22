<?php

namespace App\Filament\Resources\ServiceStatusResource\Pages;

use App\Filament\Resources\ServiceStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceStatuses extends ListRecords
{
    protected static string $resource = ServiceStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
