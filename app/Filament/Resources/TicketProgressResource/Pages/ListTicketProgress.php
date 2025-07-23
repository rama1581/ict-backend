<?php

namespace App\Filament\Resources\TicketProgressResource\Pages;

use App\Filament\Resources\TicketProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketProgress extends ListRecords
{
    protected static string $resource = TicketProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
