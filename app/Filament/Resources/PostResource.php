<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Konten Post')->schema([
                    // Input untuk Judul Post
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                    // Input untuk Slug
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    // Dropdown untuk memilih Kategori
                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),

                    // Upload untuk gambar banner
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('post-images'),

                    // Editor untuk isi berita
                    Forms\Components\RichEditor::make('body')
                        ->required()
                        ->columnSpanFull(), // Agar lebarnya penuh

                    // Field tersembunyi untuk menyimpan ID penulis
                    Forms\Components\Hidden::make('user_id')
                        ->default(auth()->id()),
                ])->columns(2), // Membuat layout form menjadi 2 kolom
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk gambar
                Tables\Columns\ImageColumn::make('image'),

                // Kolom untuk judul
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                // Kolom untuk nama kategori (dari relasi)
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),

                // Kolom untuk nama penulis (dari relasi)
                Tables\Columns\TextColumn::make('author.name')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}