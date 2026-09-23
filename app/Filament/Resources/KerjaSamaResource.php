<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KerjaSamaResource\Pages;
use App\Models\KerjaSama;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KerjaSamaResource extends Resource
{
    protected static ?string $model = KerjaSama::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Publikasi';
    protected static ?string $label = 'Kemitraan & Kerja Sama';

    protected static ?string $modelLabel = 'Kerja Sama';
    protected static ?string $pluralModelLabel = 'Data Kerja Sama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_mitra')->required(),
                Forms\Components\Select::make('bentuk_kerja_sama')
                    ->options([
                        'Industri Teknologi' => 'Industri Teknologi',
                        'Pemerintahan' => 'Pemerintahan',
                        'Akademik' => 'Akademik',
                        'BUMN' => 'BUMN',
                    ])
                    ->required()
                    ->default('Industri Teknologi'),
                Forms\Components\Textarea::make('deskripsi')->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('logo')
                    ->collection('logo')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_mitra')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('bentuk_kerja_sama')->badge(),
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
            'index' => Pages\ListKerjaSamas::route('/'),
            'create' => Pages\CreateKerjaSama::route('/create'),
            'edit' => Pages\EditKerjaSama::route('/{record}/edit'),
        ];
    }
}
