<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KrsEnrollmentResource\Pages;
use App\Filament\Resources\KrsEnrollmentResource\RelationManagers;
use App\Models\KrsEnrollment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KrsEnrollmentResource extends Resource
{
    protected static ?string $model = KrsEnrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'LMS';

    protected static ?string $modelLabel = 'Krs Enrollment';
    protected static ?string $pluralModelLabel = 'Data Krs Enrollment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mahasiswa_id')
                    ->relationship('mahasiswa', 'nama_lengkap')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Mahasiswa'),
                Forms\Components\Select::make('kelas_id')
                    ->relationship('kelas', 'kode_kelas')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Kelas Kuliah'),
                Forms\Components\Select::make('status')
                    ->options([
                        'Menunggu' => 'Menunggu',
                        'Disetujui' => 'Disetujui',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->default('Disetujui')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nama_lengkap')
                    ->label('Nama Mahasiswa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mahasiswa.nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas.kode_kelas')
                    ->label('Kode Kelas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas.mataKuliah.nama')
                    ->label('Mata Kuliah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Disetujui' => 'success',
                        'Menunggu' => 'warning',
                        'Ditolak' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
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
            'index' => Pages\ListKrsEnrollments::route('/'),
            'create' => Pages\CreateKrsEnrollment::route('/create'),
            'edit' => Pages\EditKrsEnrollment::route('/{record}/edit'),
        ];
    }
}
