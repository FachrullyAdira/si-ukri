<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten & Berita';
    protected static ?string $label = 'Berita & Pengumuman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(Berita::class, 'slug', ignoreRecord: true),
                Forms\Components\Select::make('kategori')
                    ->options([
                        'Akademik' => 'Akademik',
                        'Prestasi' => 'Prestasi',
                        'Kemitraan' => 'Kemitraan',
                        'Kemahasiswaan' => 'Kemahasiswaan',
                        'Umum' => 'Umum',
                    ])
                    ->required()
                    ->default('Akademik'),
                Forms\Components\DatePicker::make('tanggal_publikasi')
                    ->required()
                    ->default(now()),
                Forms\Components\TextInput::make('penulis')
                    ->default('Humas SI UKRI'),
                Forms\Components\Toggle::make('is_penting')
                    ->label('Highlight / Berita Penting')
                    ->default(false),
                Forms\Components\RichEditor::make('isi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                    ->collection('cover')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable()->limit(50),
                Tables\Columns\TextColumn::make('kategori')->badge()->sortable(),
                Tables\Columns\IconColumn::make('is_penting')->boolean()->label('Penting'),
                Tables\Columns\TextColumn::make('tanggal_publikasi')->date()->sortable(),
                Tables\Columns\TextColumn::make('penulis')->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'Akademik' => 'Akademik',
                        'Prestasi' => 'Prestasi',
                        'Kemitraan' => 'Kemitraan',
                        'Kemahasiswaan' => 'Kemahasiswaan',
                        'Umum' => 'Umum',
                    ]),
                Tables\Filters\TernaryFilter::make('is_penting')->label('Berita Penting'),
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
