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

    protected static ?string $modelLabel = 'Mata Kuliah';
    protected static ?string $pluralModelLabel = 'Data Mata Kuliah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Informasi Mata Kuliah')
                        ->schema([
                            Forms\Components\TextInput::make('kode')
                                ->required()
                                ->label('Kode MK'),
                            Forms\Components\TextInput::make('nama')
                                ->required()
                                ->label('Nama Mata Kuliah'),
                            Forms\Components\Select::make('kelompok_keahlian_id')
                                ->relationship('kelompokKeahlian', 'nama')
                                ->searchable()
                                ->preload()
                                ->label('Kelompok Keahlian (Opsional)')
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Sistem SKS & Penjadwalan')
                        ->schema([
                            Forms\Components\TextInput::make('sks')
                                ->numeric()
                                ->required()
                                ->default(3)
                                ->label('Beban SKS'),
                            Forms\Components\Select::make('semester')
                                ->options([
                                    1 => 'Semester 1', 2 => 'Semester 2', 3 => 'Semester 3', 4 => 'Semester 4',
                                    5 => 'Semester 5', 6 => 'Semester 6', 7 => 'Semester 7', 8 => 'Semester 8',
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
                            Forms\Components\TextInput::make('prasyarat')
                                ->label('MK Prasyarat (Opsional)'),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
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
            'index' => Pages\ListMataKuliahs::route('/'),
            'create' => Pages\CreateMataKuliah::route('/create'),
            'edit' => Pages\EditMataKuliah::route('/{record}/edit'),
        ];
    }
}
