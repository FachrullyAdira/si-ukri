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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')->required(),
                Forms\Components\DatePicker::make('tanggal')->required()->default(now()),
                Forms\Components\Textarea::make('deskripsi')->required()->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('tanggal')->date()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
