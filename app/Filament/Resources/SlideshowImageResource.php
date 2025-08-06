<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlideshowImageResource\Pages;
use App\Filament\Resources\SlideshowImageResource\RelationManagers;
use App\Models\SlideshowImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class SlideshowImageResource extends Resource
{
    protected static ?string $model = SlideshowImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manajemen Konten';

     public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image_path')
                    ->label('Upload Gambar')
                    ->image() // Memastikan hanya file gambar yang bisa diupload
                    ->disk('public') // Simpan di disk 'public'
                    ->directory('slideshows') // Buat folder 'slideshows' di dalam storage
                    ->required(),

                Toggle::make('is_active')
                    ->label('Aktifkan Gambar Ini')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')->label('Preview Gambar'),
                IconColumn::make('is_active')->boolean()->label('Status Aktif'),
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
            'index' => Pages\ListSlideshowImages::route('/'),
            'create' => Pages\CreateSlideshowImage::route('/create'),
            'edit' => Pages\EditSlideshowImage::route('/{record}/edit'),
        ];
    }
}
