<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelompokKeahlianResource\Pages;
use App\Models\KelompokKeahlian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KelompokKeahlianResource extends Resource
{
    protected static ?string $model = KelompokKeahlian::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Akademik & Kurikulum';
    protected static ?string $label = 'Kelompok Keahlian (KBK)';

    protected static ?string $modelLabel = 'Kelompok Keahlian';
    protected static ?string $pluralModelLabel = 'Data Kelompok Keahlian';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kelompok Keahlian')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Kelompok Keahlian')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('ikon')
                            ->collection('ikon')
                            ->image()
                            ->label('Unggah Gambar / Ikon Keahlian')
                            ->helperText('Format: PNG, JPG, SVG, atau WEBP. Rekomendasi rasio 1:1. Maks 10MB.')
                            ->maxSize(10240),
                        Forms\Components\TextInput::make('ikon')
                            ->label('Nama Ikon / Fallback Heroicon (Opsional)')
                            ->placeholder('Contoh: heroicon-o-cpu-chip'),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('capaian_pembelajaran')
                            ->label('Capaian Pembelajaran')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('prospek_karier')
                            ->label('Prospek Karier')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('ikon')
                    ->collection('ikon')
                    ->circular()
                    ->label('Ikon'),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')->limit(60),
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
            'index' => Pages\ListKelompokKeahlians::route('/'),
            'create' => Pages\CreateKelompokKeahlian::route('/create'),
            'edit' => Pages\EditKelompokKeahlian::route('/{record}/edit'),
        ];
    }
}
