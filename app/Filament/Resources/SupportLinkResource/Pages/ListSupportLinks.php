<?php

namespace App\Filament\Resources\SupportLinkResource\Pages;

use App\Filament\Resources\SupportLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSupportLinks extends ListRecords
{
    protected static string $resource = SupportLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
