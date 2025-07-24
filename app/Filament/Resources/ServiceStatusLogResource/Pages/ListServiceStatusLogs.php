<?php

namespace App\Filament\Resources\ServiceStatusLogResource\Pages;

use App\Filament\Resources\ServiceStatusLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceStatusLogs extends ListRecords
{
    protected static string $resource = ServiceStatusLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
