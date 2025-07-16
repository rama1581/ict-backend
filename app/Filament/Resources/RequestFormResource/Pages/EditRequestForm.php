<?php

namespace App\Filament\Resources\RequestFormResource\Pages;

use App\Filament\Resources\RequestFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestForm extends EditRecord
{
    protected static string $resource = RequestFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
