<?php

namespace App\Filament\Resources\SupportLinkResource\Pages;

use App\Filament\Resources\SupportLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupportLink extends EditRecord
{
    protected static string $resource = SupportLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
