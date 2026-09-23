<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelasResource\Pages;
use App\Filament\Resources\KelasResource\RelationManagers;
use App\Models\Kelas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'LMS';

    protected static ?string $modelLabel = 'Kelas';
    protected static ?string $pluralModelLabel = 'Data Kelas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Informasi Kelas')
                        ->schema([
                            Forms\Components\Select::make('mata_kuliah_id')
                                ->relationship('mataKuliah', 'nama')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->label('Mata Kuliah'),
                            Forms\Components\Select::make('dosen_staf_id')
                                ->relationship('dosenStaf', 'nama')
                                ->searchable()
                                ->preload()
                                ->label('Dosen Pengajar'),
                            Forms\Components\TextInput::make('kode_kelas')
                                ->required()
                                ->placeholder('Contoh: IF-1A'),
                            Forms\Components\TextInput::make('tahun_akademik')
                                ->required()
                                ->placeholder('Contoh: 2026/2027 Ganjil'),
                        ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Jadwal Pelaksanaan (Opsional)')
                        ->schema([
                            Forms\Components\Select::make('hari')
                                ->options([
                                    'Senin' => 'Senin',
                                    'Selasa' => 'Selasa',
                                    'Rabu' => 'Rabu',
                                    'Kamis' => 'Kamis',
                                    'Jumat' => 'Jumat',
                                    'Sabtu' => 'Sabtu',
                                ])
                                ->nullable(),
                            Forms\Components\TimePicker::make('jam_mulai')
                                ->nullable(),
                            Forms\Components\TimePicker::make('jam_selesai')
                                ->nullable(),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mataKuliah.nama')
                    ->label('Mata Kuliah')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('dosenStaf.nama')
                    ->label('Dosen Pengajar')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_kelas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun_akademik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hari')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->time(),
                Tables\Columns\TextColumn::make('jam_selesai')
                    ->time(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelas::route('/'),
            'create' => Pages\CreateKelas::route('/create'),
            'edit' => Pages\EditKelas::route('/{record}/edit'),
        ];
    }
}
