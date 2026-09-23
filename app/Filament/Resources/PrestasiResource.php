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

    protected static ?string $modelLabel = 'Prestasi';
    protected static ?string $pluralModelLabel = 'Data Prestasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Prestasi')
                    ->description('Informasi lengkap mengenai prestasi yang diraih.')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Prestasi')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('nama_mahasiswa')
                            ->label('Nama Mahasiswa / Tim')
                            ->required(),
                        Forms\Components\TextInput::make('tahun')
                            ->label('Tahun Perolehan')
                            ->numeric()
                            ->required()
                            ->default(date('Y')),
                        Forms\Components\Select::make('kategori')
                            ->label('Tingkat / Kategori')
                            ->options([
                                'Nasional' => 'Nasional',
                                'Internasional' => 'Internasional',
                                'Regional' => 'Regional',
                                'Internal' => 'Internal',
                            ])
                            ->required()
                            ->default('Nasional'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Dokumentasi')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('foto')
                            ->collection('foto')
                            ->image()
                            ->label('Unggah Foto / Sertifikat (Opsional)')
                            ->helperText('Format: JPG, PNG, WEBP (Maks 20MB).')
                            ->maxSize(20480)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi Tambahan')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('foto')
                    ->collection('foto')
                    ->label('Foto / Sertifikat'),
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
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
