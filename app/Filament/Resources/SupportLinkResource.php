<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupportLinkResource\Pages;
use App\Filament\Resources\SupportLinkResource\RelationManagers;
use App\Models\SupportLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;


class SupportLinkResource extends Resource
{
    protected static ?string $model = SupportLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
    return $form
        ->schema([
            TextInput::make('title')->required(),
            Textarea::make('description')->required(),
            TextInput::make('link')->required(),
            Select::make('icon')
                ->options([
                    'Activity' => 'Status Layanan',
                    'HelpCircle' => 'FAQ',
                    'Settings' => 'Ajukan Bantuan',
                ])
                ->required()
                ->label('Ikon'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListSupportLinks::route('/'),
            'create' => Pages\CreateSupportLink::route('/create'),
            'edit' => Pages\EditSupportLink::route('/{record}/edit'),
        ];
    }
}
