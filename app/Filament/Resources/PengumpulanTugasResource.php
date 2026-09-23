<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengumpulanTugasResource\Pages;
use App\Filament\Resources\PengumpulanTugasResource\RelationManagers;
use App\Models\PengumpulanTugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengumpulanTugasResource extends Resource
{
    protected static ?string $model = PengumpulanTugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'LMS';

    protected static ?string $modelLabel = 'Pengumpulan Tugas';
    protected static ?string $pluralModelLabel = 'Data Pengumpulan Tugas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Informasi Pengumpulan')
                        ->schema([
                            Forms\Components\Select::make('tugas_id')
                                ->relationship('tugas', 'judul_tugas')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->label('Pilih Tugas'),
                            Forms\Components\Select::make('mahasiswa_id')
                                ->relationship('mahasiswa', 'nama_lengkap')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->label('Mahasiswa Pengumpul'),
                            Forms\Components\DateTimePicker::make('waktu_pengumpulan')
                                ->required()
                                ->default(now()),
                        ]),
                    Forms\Components\Section::make('Berkas Jawaban')
                        ->schema([
                            Forms\Components\FileUpload::make('file_jawaban_path')
                                ->label('Unggah Berkas Jawaban (PDF, Word, ZIP, Gambar)')
                                ->directory('tugas_jawaban')
                                ->acceptedFileTypes([
                                    'application/pdf',
                                    'application/zip',
                                    'application/x-zip-compressed',
                                    'application/x-rar-compressed',
                                    'application/vnd.rar',
                                    'application/msword',
                                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                    'image/*',
                                    'text/plain',
                                ])
                                ->maxSize(30720) // 30MB
                                ->columnSpanFull(),
                        ])
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Penilaian Dosen')
                        ->schema([
                            Forms\Components\TextInput::make('nilai')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(100)
                                ->label('Nilai Akhir (0-100)'),
                            Forms\Components\Textarea::make('catatan_dosen')
                                ->label('Catatan / Feedback Dosen')
                                ->rows(5)
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tugas.judul_tugas')
                    ->label('Judul Tugas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mahasiswa.nama_lengkap')
                    ->label('Mahasiswa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mahasiswa.nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu_pengumpulan')
                    ->label('Waktu Kumpul')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai')
                    ->badge()
                    ->color(fn ($state) => $state >= 75 ? 'success' : ($state >= 60 ? 'warning' : 'danger'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
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
            'index' => Pages\ListPengumpulanTugas::route('/'),
            'create' => Pages\CreatePengumpulanTugas::route('/create'),
            'edit' => Pages\EditPengumpulanTugas::route('/{record}/edit'),
        ];
    }
}
