<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\ServiceStatusLog;
use Illuminate\Database\Eloquent\Model;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
{
    $oldStatus = $record->status;

    $updatedRecord = parent::handleRecordUpdate($record, $data); // update dulu

    // Setelah update, cek apakah status berubah
    if ($oldStatus !== $updatedRecord->status) {
        ServiceStatusLog::create([
            'service_id' => $updatedRecord->id,
            'status' => $updatedRecord->status,
            'description' => 'Status changed to ' . $updatedRecord->status,
            'logged_at' => now(),
        ]);
    }

    return $updatedRecord;
}

}
