<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HimaKegiatanResource\Pages;
use App\Models\HimaKegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HimaKegiatanResource extends Resource
{
    protected static ?string $model = HimaKegiatan::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Kemahasiswaan & Alumni';
    protected static ?string $label = 'Kegiatan HIMASI';

    protected static ?string $modelLabel = 'Hima Kegiatan';
    protected static ?string $pluralModelLabel = 'Data Hima Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->label('Nama / Judul Kegiatan')
                    ->placeholder('Contoh: SI-CODE Hackathon & Competitive Programming 2026')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\DatePicker::make('tanggal')
                        ->label('Tanggal Mulai')
                        ->required()
                        ->default(now()),

                    Forms\Components\DatePicker::make('tanggal_selesai')
                        ->label('Tanggal Selesai (Opsional)')
                        ->afterOrEqual('tanggal')
                        ->helperText('Kosongkan jika kegiatan hanya berlangsung 1 hari.'),
                ]),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Kegiatan')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

                Forms\Components\SpatieMediaLibraryFileUpload::make('foto')
                    ->collection('foto')
                    ->image()
                    ->maxSize(51200)
                    ->label('Foto / Banner Dokumentasi Kegiatan')
                    ->helperText('Format: JPG, PNG, WEBP (Maks 50MB)')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('foto')
                    ->collection('foto')
                    ->label('Foto'),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Kegiatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Waktu Pelaksanaan')
                    ->formatStateUsing(fn ($record) => $record->tanggal_rentang)
                    ->sortable(),
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
            'index' => Pages\ListHimaKegiatans::route('/'),
            'create' => Pages\CreateHimaKegiatan::route('/create'),
            'edit' => Pages\EditHimaKegiatan::route('/{record}/edit'),
        ];
    }
}
