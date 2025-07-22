<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceStatusResource\Pages;
use App\Filament\Resources\ServiceStatusResource\RelationManagers;
use App\Models\ServiceStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceStatusResource extends Resource
{
    protected static ?string $model = ServiceStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
    return $form->schema([
        Forms\Components\TextInput::make('name')->required(),
        Forms\Components\Select::make('status')
            ->options([
                'Normal' => 'Normal',
                'Gangguan' => 'Gangguan',
                'Pemeliharaan' => 'Pemeliharaan',
            ])->required(),
        Forms\Components\Textarea::make('description')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('status')->sortable(),
            Tables\Columns\TextColumn::make('description')->limit(50),
            Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'Normal' => 'Normal',
                    'Gangguan' => 'Gangguan',
                    'Pemeliharaan' => 'Pemeliharaan',
                ]),
        ])
        // ->headerActions([ Tables\Actions\CreateAction::make(), ]) <-- HAPUS INI
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceStatuses::route('/'),
            'create' => Pages\CreateServiceStatus::route('/create'),
            'edit' => Pages\EditServiceStatus::route('/{record}/edit'),
        ];
    }
}
