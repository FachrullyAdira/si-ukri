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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\TextInput::make('ikon')->placeholder('Contoh: heroicon-o-data-table'),
                Forms\Components\Textarea::make('deskripsi')->columnSpanFull(),
                Forms\Components\Textarea::make('capaian_pembelajaran')->columnSpanFull(),
                Forms\Components\Textarea::make('prospek_karier')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('ikon'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
