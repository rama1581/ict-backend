<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuideResource\Pages;
use App\Models\Guide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use FilamentTiptapEditor\TiptapEditor;
use FilamentTiptapEditor\Enums\TiptapOutput;

class GuideResource extends Resource
{
    protected static ?string $model = Guide::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(Guide::class, 'slug', ignoreRecord: true),

            Forms\Components\TextInput::make('category')
                ->required()
                ->maxLength(255),

            Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->directory('guide-thumbnails'),

            TiptapEditor::make('content')
            ->label('Konten')
            ->directory('uploads/guides')
            ->disk('public')
            ->visibility('public')
            ->profile('default')
            ->tools([
                'heading',
                'bold',
                'italic',
                'underline',
                'strike',
                'color',
                'highlight',
                'bullet-list',
                'ordered-list',
                'blockquote',
                'code-block',
                'hr',
                'align-left',
                'align-center',
                'align-right',
                'align-justify',
                'superscript',
                'subscript',
                'link',
                'undo',
                'redo',
                'media',
            ])
            ->output(TiptapOutput::Html)
            ->required()
            ->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')->width(100),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('category')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => Pages\ListGuides::route('/'),
            'create' => Pages\CreateGuide::route('/create'),
            'edit' => Pages\EditGuide::route('/{record}/edit'),
        ];
    }
}
