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
    protected static ?string $label = 'Dosen & Staf';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\TextInput::make('nidn'),
                Forms\Components\TextInput::make('jabatan')->placeholder('Contoh: Lektor, Asisten Ahli'),
                Forms\Components\TextInput::make('jabatan_struktural')->placeholder('Contoh: Kepala Program Studi'),
                Forms\Components\Select::make('kelompok_keahlian_id')
                    ->relationship('kelompokKeahlian', 'nama')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('bidang_keahlian'),
                Forms\Components\TextInput::make('urutan_struktural')->numeric()->default(99),
                Forms\Components\Textarea::make('riwayat_pendidikan')->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('foto_profil')
                    ->collection('foto_profil')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
