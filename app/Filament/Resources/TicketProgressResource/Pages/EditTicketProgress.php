<?php

namespace App\Filament\Resources\TicketProgressResource\Pages;

use App\Filament\Resources\TicketProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketProgress extends EditRecord
{
    protected static string $resource = TicketProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
