<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AkreditasiResource\Pages;
use App\Models\Akreditasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AkreditasiResource extends Resource
{
    protected static ?string $model = Akreditasi::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Profil & Legalitas';
    protected static ?string $label = 'Akreditasi Prodi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jenis')->default('Sarjana (S1) Sistem Informasi')->required(),
                Forms\Components\TextInput::make('lembaga')->default('BAN-PT Kemendikbudristek')->required(),
                Forms\Components\TextInput::make('peringkat')
                    ->placeholder('Contoh: A / Unggul, B (Baik)')
                    ->required()
                    ->default('A / Unggul'),
                Forms\Components\TextInput::make('tahun')->numeric()->required()->default(date('Y')),
                Forms\Components\TextInput::make('masa_berlaku')->placeholder('Contoh: 2023 s.d. 2028')->required(),
                Forms\Components\TextInput::make('no_sk')->label('Nomor SK Resmi')->placeholder('Contoh: SK BAN-PT No. 4281/SK/BAN-PT/2023'),
                Forms\Components\Textarea::make('deskripsi')->label('Deskripsi Milestone')->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('file_sertifikat')
                    ->collection('dokumen_pdf')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tahun')->sortable(),
                Tables\Columns\TextColumn::make('peringkat')->badge()->sortable(),
                Tables\Columns\TextColumn::make('no_sk')->label('Nomor SK')->searchable(),
                Tables\Columns\TextColumn::make('masa_berlaku'),
                Tables\Columns\TextColumn::make('lembaga'),
            ])
            ->defaultSort('tahun', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAkreditasis::route('/'),
            'create' => Pages\CreateAkreditasi::route('/create'),
            'edit' => Pages\EditAkreditasi::route('/{record}/edit'),
        ];
    }
}
