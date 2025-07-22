<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestFormResource\Pages;
use App\Models\RequestForm;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RequestFormResource extends Resource
{
    protected static ?string $model = RequestForm::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(100),
                TextInput::make('email')->email()->required(),
                Select::make('category')
                    ->options([
                        'jaringan' => 'Permintaan Jaringan',
                        'hardware' => 'Permintaan Hardware',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                Textarea::make('message')->required()->rows(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email'),
                TextColumn::make('category'),
                TextColumn::make('message')->limit(50)->searchable(),
                TextColumn::make('created_at')->dateTime('d M Y, H:i'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequestForms::route('/'),
            'create' => Pages\CreateRequestForm::route('/create'),
            'edit' => Pages\EditRequestForm::route('/{record}/edit'),
        ];
    }
}
