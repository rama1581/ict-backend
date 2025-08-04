<?php

namespace App\Filament\Resources\ServiceStatusResource\Pages;

use App\Filament\Resources\ServiceStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceStatus extends CreateRecord
{
    protected static string $resource = ServiceStatusResource::class;

    protected function afterCreate(): void
    {
        // $this->record berisi data ServiceStatus yang baru saja dibuat.
        $serviceStatus = $this->record;

        // Buat log pertama saat data diciptakan
        $serviceStatus->logs()->create([
            'description' => 'Status layanan dibuat dengan status awal "' . $serviceStatus->status . '"',
            'logged_at' => now(),
        ]);
    }
}
