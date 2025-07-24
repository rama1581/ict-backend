<?php

namespace App\Filament\Resources\ServiceStatusLogResource\Pages;

use App\Filament\Resources\ServiceStatusLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceStatusLog extends EditRecord
{
    protected static string $resource = ServiceStatusLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
