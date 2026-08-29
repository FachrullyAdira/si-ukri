<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MataKuliahResource\Pages;
use App\Models\MataKuliah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MataKuliahResource extends Resource
{
    protected static ?string $model = MataKuliah::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Akademik & Kurikulum';
    protected static ?string $label = 'Mata Kuliah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')->required(),
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\TextInput::make('sks')->numeric()->required()->default(3),
                Forms\Components\Select::make('semester')
                    ->options([
                        1 => 'Semester 1',
                        2 => 'Semester 2',
                        3 => 'Semester 3',
                        4 => 'Semester 4',
                        5 => 'Semester 5',
                        6 => 'Semester 6',
                        7 => 'Semester 7',
                        8 => 'Semester 8',
                    ])
                    ->required(),
                Forms\Components\Select::make('sifat')
                    ->options([
                        'Wajib' => 'Wajib',
                        'Pilihan KBK' => 'Pilihan KBK',
                        'Pilihan Bebas' => 'Pilihan Bebas',
                    ])
                    ->default('Wajib')
                    ->required(),
                Forms\Components\TextInput::make('prasyarat'),
                Forms\Components\Select::make('kelompok_keahlian_id')
                    ->relationship('kelompokKeahlian', 'nama')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('sks')->sortable(),
                Tables\Columns\TextColumn::make('semester')->sortable(),
                Tables\Columns\TextColumn::make('sifat')->badge(),
                Tables\Columns\TextColumn::make('kelompokKeahlian.nama')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('semester')
                    ->options([
                        1 => 'Semester 1', 2 => 'Semester 2', 3 => 'Semester 3', 4 => 'Semester 4',
                        5 => 'Semester 5', 6 => 'Semester 6', 7 => 'Semester 7', 8 => 'Semester 8',
                    ]),
                Tables\Filters\SelectFilter::make('sifat')
                    ->options([
                        'Wajib' => 'Wajib',
                        'Pilihan KBK' => 'Pilihan KBK',
                        'Pilihan Bebas' => 'Pilihan Bebas',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMataKuliahs::route('/'),
            'create' => Pages\CreateMataKuliah::route('/create'),
            'edit' => Pages\EditMataKuliah::route('/{record}/edit'),
        ];
    }
}
