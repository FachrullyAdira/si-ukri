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
    protected static ?string $navigationGroup = 'Publikasi';
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita & Pengumuman';
    protected static ?string $label = 'Berita & Pengumuman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Konten Utama')
                        ->description('Judul dan isi dari berita atau pengumuman.')
                        ->schema([
                            Forms\Components\TextInput::make('judul')
                                ->label('Judul Berita')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(Berita::class, 'slug', ignoreRecord: true),
                            Forms\Components\RichEditor::make('isi')
                                ->label('Isi Konten')
                                ->required()
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Media & Pengaturan')
                        ->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                                ->collection('cover')
                                ->image()
                                ->maxSize(51200)
                                ->label('Gambar Sampul (Thumbnail)')
                                ->helperText('Format: JPG, PNG, WEBP (Maks 50MB)'),
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
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover')
                    ->label('Cover'),
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
