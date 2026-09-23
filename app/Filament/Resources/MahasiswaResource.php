<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'LMS';
    protected static ?string $modelLabel = 'Mahasiswa';
    protected static ?string $pluralModelLabel = 'Data Mahasiswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Data Induk Mahasiswa')
                        ->description('Masukkan data lengkap mahasiswa sesuai dengan identitas resmi.')
                        ->schema([
                            Forms\Components\TextInput::make('nim')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->label('NIM (Nomor Induk Mahasiswa)')
                                ->prefixIcon('heroicon-m-identification'),
                            Forms\Components\TextInput::make('nama_lengkap')
                                ->required()
                                ->label('Nama Lengkap')
                                ->prefixIcon('heroicon-m-user'),
                            Forms\Components\TextInput::make('angkatan')
                                ->required()
                                ->numeric()
                                ->placeholder('Contoh: 2026')
                                ->prefixIcon('heroicon-m-calendar-days'),
                            Forms\Components\Select::make('status')
                                ->options([
                                    'Aktif' => 'Aktif',
                                    'Cuti' => 'Cuti',
                                    'Lulus' => 'Lulus',
                                ])
                                ->required()
                                ->default('Aktif')
                                ->prefixIcon('heroicon-m-check-badge'),
                        ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Akun & Profil')
                        ->schema([
                            Forms\Components\SpatieMediaLibraryFileUpload::make('foto_mahasiswa')
                                ->collection('foto_mahasiswa')
                                ->avatar()
                                ->imageEditor()
                                ->circleCropper()
                                ->label('Foto Mahasiswa')
                                ->alignCenter(),
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->label('Tautkan ke Akun Pengguna')
                                ->helperText('Kosongkan jika mahasiswa belum memiliki akun login.'),
                        ])
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nim')
                    ->searchable()
                    ->sortable()
                    ->label('NIM'),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('angkatan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Cuti' => 'warning',
                        'Lulus' => 'info',
                        default => 'gray',
                    }),
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
