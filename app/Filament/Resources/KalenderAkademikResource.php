<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KalenderAkademikResource\Pages;
use App\Models\KalenderAkademik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KalenderAkademikResource extends Resource
{
    protected static ?string $model = KalenderAkademik::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Akademik & Kurikulum';
    protected static ?string $label = 'Kalender Akademik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul_kegiatan')->required(),
                Forms\Components\TextInput::make('tahun_akademik')->required()->placeholder('Contoh: 2026/2027 Ganjil'),
                Forms\Components\DatePicker::make('tanggal_mulai')->required(),
                Forms\Components\DatePicker::make('tanggal_selesai'),
                Forms\Components\Textarea::make('keterangan')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul_kegiatan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tahun_akademik')->badge()->sortable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')->date()->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tahun_akademik')
                    ->options(fn () => KalenderAkademik::pluck('tahun_akademik', 'tahun_akademik')->toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKalenderAkademiks::route('/'),
            'create' => Pages\CreateKalenderAkademik::route('/create'),
            'edit' => Pages\EditKalenderAkademik::route('/{record}/edit'),
        ];
    }
}
