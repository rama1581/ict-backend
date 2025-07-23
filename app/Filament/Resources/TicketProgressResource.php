<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketProgressResource\Pages;
use App\Models\TicketProgress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TicketProgressResource extends Resource
{
    protected static ?string $model = TicketProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Riwayat Progress Tiket';
    protected static ?string $navigationGroup = 'Layanan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('request_form_id')
                ->label('Kode Tiket')
                ->relationship('requestForm', 'ticket_code')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Status Progress')
                ->options([
                    'info'       => 'Informasi',
                    'working'    => 'Sedang Dikerjakan',
                    'need_user'  => 'Butuh Tanggapan Pengguna',
                    'resolved'   => 'Selesai',
                ])
                ->default('info'),

            Forms\Components\Textarea::make('note')
                ->label('Catatan Progress')
                ->required()
                ->autosize()
                ->rows(5),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('requestForm.ticket_code')
                    ->label('Kode Tiket')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'info'      => 'info',
                        'working'   => 'warning',
                        'need_user' => 'danger',
                        'resolved'  => 'success',
                    ]),

                Tables\Columns\TextColumn::make('note')
                    ->label('Catatan')
                    ->wrap()
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y - H:i')
                    ->sortable(),
            ])
            ->filters([])
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTicketProgress::route('/'),
            'create' => Pages\CreateTicketProgress::route('/create'),
            'edit'   => Pages\EditTicketProgress::route('/{record}/edit'),
        ];
    }
}
