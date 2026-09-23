<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasResource\Pages;
use App\Filament\Resources\TugasResource\RelationManagers;
use App\Models\Tugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TugasResource extends Resource
{
    protected static ?string $model = Tugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'LMS';

    protected static ?string $modelLabel = 'Tugas';
    protected static ?string $pluralModelLabel = 'Data Tugas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Informasi Tugas')
                        ->schema([
                            Forms\Components\Select::make('kelas_id')
                                ->relationship('kelas', 'kode_kelas')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->label('Pilih Kelas'),
                            Forms\Components\TextInput::make('judul_tugas')
                                ->required()
                                ->label('Judul Tugas'),
                            Forms\Components\RichEditor::make('deskripsi_instruksi')
                                ->label('Instruksi Pengerjaan Tugas')
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Pengaturan & Berkas')
                        ->schema([
                            Forms\Components\DateTimePicker::make('tenggat_waktu')
                                ->required()
                                ->label('Tenggat Waktu (Deadline)'),
                            Forms\Components\FileUpload::make('file_lampiran_path')
                                ->label('Unggah Berkas Soal/Lampiran (Opsional)')
                                ->directory('tugas_lampiran')
                                ->maxSize(10240), // 10MB
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kelas_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul_tugas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tenggat_waktu')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_lampiran_path')
                    ->searchable(),
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
            'index' => Pages\ListTugas::route('/'),
            'create' => Pages\CreateTugas::route('/create'),
            'edit' => Pages\EditTugas::route('/{record}/edit'),
        ];
    }
}
