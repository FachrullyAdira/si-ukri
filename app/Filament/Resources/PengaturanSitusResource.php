<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanSitusResource\Pages;
use App\Models\PengaturanSitus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengaturanSitusResource extends Resource
{
    protected static ?string $model = PengaturanSitus::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Pengaturan & Sistem';
    protected static ?string $label = 'Pengaturan Konten Situs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')->required()->unique(PengaturanSitus::class, 'key', ignoreRecord: true),
                Forms\Components\Select::make('group')
                    ->options([
                        'general' => 'Umum',
                        'beranda' => 'Beranda Utama',
                        'kontak' => 'Info Kontak',
                    ])
                    ->default('general')
                    ->required(),
                Forms\Components\Textarea::make('value')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('group')->badge(),
                Tables\Columns\TextColumn::make('value')->limit(50),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options(['general' => 'Umum', 'beranda' => 'Beranda Utama', 'kontak' => 'Info Kontak']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaturanSitus::route('/'),
            'create' => Pages\CreatePengaturanSitus::route('/create'),
            'edit' => Pages\EditPengaturanSitus::route('/{record}/edit'),
        ];
    }
}
