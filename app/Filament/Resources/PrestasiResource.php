<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Models\Prestasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Kemahasiswaan & Alumni';
    protected static ?string $label = 'Prestasi Mahasiswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')->required(),
                Forms\Components\TextInput::make('nama_mahasiswa')->required(),
                Forms\Components\TextInput::make('tahun')->numeric()->required()->default(date('Y')),
                Forms\Components\Select::make('kategori')
                    ->options([
                        'Nasional' => 'Nasional',
                        'Internasional' => 'Internasional',
                        'Regional' => 'Regional',
                        'Internal' => 'Internal',
                    ])
                    ->required()
                    ->default('Nasional'),
                Forms\Components\Textarea::make('deskripsi')->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_mahasiswa')->searchable(),
                Tables\Columns\TextColumn::make('kategori')->badge(),
                Tables\Columns\TextColumn::make('tahun')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options(['Nasional' => 'Nasional', 'Internasional' => 'Internasional', 'Regional' => 'Regional']),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
