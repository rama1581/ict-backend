<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('link')->required()->placeholder('/layanan/jaringan'),
                Forms\Components\Select::make('icon')
                ->options([
                    'Network' => 'Jaringan',
                    'MailOpen' => 'Email',
                    'AppWindow' => 'Akademik',
                    'LifeBuoy' => 'Bantuan Teknis',
                ])
                ->required()
                ->label('Ikon'),
            ]);
    }

    public static function table(Table $table): Table
    {
    return $table->columns([
        Tables\Columns\TextColumn::make('title')->searchable(),
        Tables\Columns\TextColumn::make('description')->limit(50),
        Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
