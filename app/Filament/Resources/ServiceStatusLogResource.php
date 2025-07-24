<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceStatusLogResource\Pages;
use App\Models\ServiceStatusLog;
use App\Models\ServiceStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceStatusLogResource extends Resource
{
    protected static ?string $model = ServiceStatusLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Monitoring Layanan';
    protected static ?string $navigationLabel = 'Log Status Layanan';
    protected static ?string $pluralModelLabel = 'Log Status Layanan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('service_status_id')
                ->label('Status Layanan')
                ->relationship('serviceStatus', 'name')
                ->searchable()
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Keterangan')
                ->columnSpanFull(),

            Forms\Components\DateTimePicker::make('logged_at')
                ->label('Waktu Log')
                ->required()
                ->default(now()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('serviceStatus.name')
                ->label('Layanan')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('serviceStatus.status')
                ->label('Status')
                ->badge()
                ->colors([
                    'success' => 'Normal',
                    'warning' => 'Pemeliharaan',
                    'danger' => 'Gangguan',
                ]),

            Tables\Columns\TextColumn::make('description')
                ->label('Keterangan')
                ->limit(50),

            Tables\Columns\TextColumn::make('logged_at')
                ->label('Waktu Log')
                ->dateTime('d M Y H:i'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceStatusLogs::route('/'),
            'create' => Pages\CreateServiceStatusLog::route('/create'),
            'edit' => Pages\EditServiceStatusLog::route('/{record}/edit'),
        ];
    }
}
