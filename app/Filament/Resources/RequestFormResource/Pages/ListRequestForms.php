<?php

namespace App\Filament\Resources\RequestFormResource\Pages;

use App\Filament\Resources\RequestFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequestForms extends ListRecords
{
    protected static string $resource = RequestFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
