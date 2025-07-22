<?php

namespace App\Filament\Resources\ServiceStatusResource\Pages;

use App\Filament\Resources\ServiceStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceStatus extends EditRecord
{
    protected static string $resource = ServiceStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
