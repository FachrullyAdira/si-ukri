<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SejarahResource\Pages;
use App\Models\Sejarah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SejarahResource extends Resource
{
    protected static ?string $model = Sejarah::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Profil & Legalitas';
    protected static ?string $label = 'Sejarah & Milestone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tahun')->numeric()->required(),
                Forms\Components\TextInput::make('judul_peristiwa')->required(),
                Forms\Components\Textarea::make('deskripsi')->required()->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('foto')
                    ->collection('foto')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tahun')->sortable(),
                Tables\Columns\TextColumn::make('judul_peristiwa')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSejarahs::route('/'),
            'create' => Pages\CreateSejarah::route('/create'),
            'edit' => Pages\EditSejarah::route('/{record}/edit'),
        ];
    }
}
