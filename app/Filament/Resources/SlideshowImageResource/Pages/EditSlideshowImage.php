<?php

namespace App\Filament\Resources\SlideshowImageResource\Pages;

use App\Filament\Resources\SlideshowImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSlideshowImage extends EditRecord
{
    protected static string $resource = SlideshowImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
