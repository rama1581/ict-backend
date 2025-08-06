<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupportLinkResource\Pages;
use App\Models\SupportLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// Pastikan semua komponen ini di-import
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;


class SupportLinkResource extends Resource
{
    protected static ?string $model = SupportLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';// Menggunakan ikon yang lebih sesuai
    protected static ?string $navigationLabel = 'Support Link';
    protected static ?string $slug = 'support-links';
    protected static ?string $navigationGroup = 'Manajemen Konten';

    /**
     * Ini adalah FORMULIR yang akan muncul saat Anda klik "Buat Support Link"
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->label('Judul Link'),

                Textarea::make('description')
                    ->required()
                    ->label('Deskripsi Singkat')
                    ->columnSpanFull(),

                TextInput::make('link')
                    ->required()
                    ->label('Link Tujuan')
                    ->placeholder('Contoh: /dukungan/faq'),

                Select::make('icon')
                    ->options([
                        'Settings'   => 'Pengajuan Layanan',
                        'HelpCircle' => 'FAQ',
                        'Activity'   => 'Status Layanan',
                        'Ticket'     => 'Status Pengajuan',
                    ])
                    ->required()
                    ->native(false) // Tampilan dropdown modern
                    ->label('Ikon'),
            ]);
    }

    /**
     * Ini adalah TABEL yang tampil di halaman daftar (seperti di screenshot Anda)
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Judul'),
                
                TextColumn::make('link')
                    ->label('Link'),
                
                TextColumn::make('icon')
                    ->label('Nama Ikon'),
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