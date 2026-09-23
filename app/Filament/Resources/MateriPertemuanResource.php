<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriPertemuanResource\Pages;
use App\Filament\Resources\MateriPertemuanResource\RelationManagers;
use App\Models\MateriPertemuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MateriPertemuanResource extends Resource
{
    protected static ?string $model = MateriPertemuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'LMS';

    protected static ?string $modelLabel = 'Materi Pertemuan';
    protected static ?string $pluralModelLabel = 'Data Materi Pertemuan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kelas_id')
                    ->relationship('kelas', 'kode_kelas')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Pilih Kelas'),
                Forms\Components\TextInput::make('pertemuan_ke')
                    ->required()
                    ->numeric()
                    ->label('Pertemuan Ke-'),
                Forms\Components\TextInput::make('judul_materi')
                    ->required()
                    ->label('Judul Materi / Topik')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi / Catatan Tambahan')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Unggah Berkas Materi (Opsional)')
                    ->directory('materi_pertemuan')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-powerpoint',
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/zip',
                        'application/x-zip-compressed',
                        'application/x-rar-compressed',
                        'text/plain',
                        'image/*',
                    ])
                    ->maxSize(20480) // 20MB
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kelas.kode_kelas')
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pertemuan_ke')
                    ->label('Pertemuan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul_materi')
                    ->label('Topik / Materi')
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
            'index' => Pages\ListMateriPertemuans::route('/'),
            'create' => Pages\CreateMateriPertemuan::route('/create'),
            'edit' => Pages\EditMateriPertemuan::route('/{record}/edit'),
        ];
    }
}
