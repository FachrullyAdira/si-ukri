<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HimaPengurusResource\Pages;
use App\Models\HimaPengurus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HimaPengurusResource extends Resource
{
    protected static ?string $model = HimaPengurus::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Kemahasiswaan & Alumni';
    protected static ?string $label = 'Pengurus HIMASI';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\TextInput::make('jabatan')->required(),
                Forms\Components\TextInput::make('periode')->required()->default('2026/2027'),
                Forms\Components\FileUpload::make('foto')->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('jabatan'),
                Tables\Columns\TextColumn::make('periode')->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHimaPengurus::route('/'),
            'create' => Pages\CreateHimaPengurus::route('/create'),
            'edit' => Pages\EditHimaPengurus::route('/{record}/edit'),
        ];
    }
}
