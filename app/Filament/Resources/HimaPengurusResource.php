<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HimaPengurusResource\Pages;
use App\Models\HimaPengurus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HimaPengurusResource extends Resource
{
    protected static ?string $model = HimaPengurus::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Kemahasiswaan & Alumni';
    protected static ?string $label = 'Pengurus HIMASI';

    protected static ?string $modelLabel = 'Hima Pengurus';
    protected static ?string $pluralModelLabel = 'Data Hima Pengurus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required(),
                Forms\Components\TextInput::make('jabatan')
                    ->label('Jabatan di Himpunan')
                    ->placeholder('Contoh: Ketua Himpunan (Kahim)')
                    ->required(),
                Forms\Components\TextInput::make('periode')
                    ->label('Periode Kepengurusan')
                    ->required()
                    ->default('2026/2027'),
                Forms\Components\SpatieMediaLibraryFileUpload::make('foto')
                    ->collection('foto')
                    ->image()
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('600')
                    ->imageResizeTargetHeight('600')
                    ->maxSize(20480)
                    ->label('Foto Pengurus')
                    ->helperText('Format: JPG, PNG, WEBP (Maks 20MB). Rasio 1:1 disarankan.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('foto')
                    ->collection('foto')
                    ->circular()
                    ->label('Foto'),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('jabatan')->searchable(),
                Tables\Columns\TextColumn::make('periode')->badge(),
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
            'index' => Pages\ListHimaPengurus::route('/'),
            'create' => Pages\CreateHimaPengurus::route('/create'),
            'edit' => Pages\EditHimaPengurus::route('/{record}/edit'),
        ];
    }
}
