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

    protected function afterSave(): void
    {
        // $this->record berisi data ServiceStatus yang baru saja di-update.
        $serviceStatus = $this->record;

        // Buat log baru menggunakan relasi `logs()` yang sudah ada di Model.
        // Laravel akan otomatis mengisi `service_status_id`.
        $serviceStatus->logs()->create([
            'description' => 'Status diubah menjadi "' . $serviceStatus->status . '"',
            'logged_at' => now(),
        ]);
    }
}
