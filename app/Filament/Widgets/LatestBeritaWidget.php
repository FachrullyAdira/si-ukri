<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Berita;

class LatestBeritaWidget extends BaseWidget
{
    protected static ?string $heading = 'Berita & Pengumuman Terbaru';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Berita::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Berita')
                    ->weight('bold')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Akademik' => 'primary',
                        'Kemahasiswaan' => 'success',
                        'Umum' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Rilis')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
