<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DosenStafResource\Pages;
use App\Models\DosenStaf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DosenStafResource extends Resource
{
    protected static ?string $model = DosenStaf::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Akademik & Kurikulum';
    protected static ?string $modelLabel = 'Dosen & Staf';
    protected static ?string $pluralModelLabel = 'Data Dosen & Staf';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Informasi Pribadi & Jabatan')
                        ->schema([
                            Forms\Components\TextInput::make('nama')
                                ->label('Nama Lengkap (beserta gelar)')
                                ->required(),
                            Forms\Components\TextInput::make('nidn')
                                ->label('NIDN / NIP'),
                            Forms\Components\TextInput::make('jabatan')
                                ->label('Jabatan Akademik')
                                ->placeholder('Contoh: Lektor, Asisten Ahli'),
                            Forms\Components\TextInput::make('jabatan_struktural')
                                ->label('Jabatan Struktural')
                                ->placeholder('Contoh: Kepala Program Studi'),
                        ])->columns(2),
                    
                    Forms\Components\Section::make('Keahlian & Pendidikan')
                        ->schema([
                            Forms\Components\Select::make('kelompok_keahlian_id')
                                ->relationship('kelompokKeahlian', 'nama')
                                ->searchable()
                                ->preload()
                                ->label('Kelompok Keahlian'),
                            Forms\Components\TextInput::make('bidang_keahlian')
                                ->label('Fokus Bidang Keahlian'),
                            Forms\Components\RichEditor::make('riwayat_pendidikan')
                                ->label('Riwayat Pendidikan')
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(['lg' => 2]),
                
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Foto Profil')
                        ->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('foto_profil')
                                ->collection('foto_profil')
                                ->image()
                                ->imageCropAspectRatio('1:1')
                                ->imageResizeTargetWidth('600')
                                ->imageResizeTargetHeight('600')
                                ->label('Unggah Foto Profil')
                                ->helperText('Format: JPG, PNG, WEBP (Maks 20MB). Rasio 1:1 disarankan.')
                                ->maxSize(20480),
                            Forms\Components\TextInput::make('urutan_struktural')
                                ->numeric()
                                ->default(99)
                                ->label('Urutan Tampil (Struktural)')
                                ->helperText('Makin kecil angkanya, makin di atas.'),
                        ])
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('foto_profil')
                    ->collection('foto_profil')
                    ->circular()
                    ->label('Foto'),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nidn')->searchable(),
                Tables\Columns\TextColumn::make('jabatan_struktural')->badge(),
                Tables\Columns\TextColumn::make('kelompokKeahlian.nama')->sortable(),
                Tables\Columns\TextColumn::make('urutan_struktural')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kelompok_keahlian_id')
                    ->relationship('kelompokKeahlian', 'nama'),
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
            'index' => Pages\ListDosenStafs::route('/'),
            'create' => Pages\CreateDosenStaf::route('/create'),
            'edit' => Pages\EditDosenStaf::route('/{record}/edit'),
        ];
    }
}
