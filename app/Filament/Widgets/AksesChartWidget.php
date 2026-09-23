<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\KunjunganSitus;
use Illuminate\Support\Carbon;

class AksesChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Grafik Kunjungan Sistem';
    protected static ?int $sort = 4;
    protected static ?string $maxHeight = '280px';
    protected static ?string $pollingInterval = '10s';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hari Ini (Per Jam)',
            'week' => '7 Hari Terakhir',
            'month' => '4 Minggu Terakhir',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? 'today';
        $labels = [];
        $data = [];

        if ($activeFilter === 'today') {
            $visits = KunjunganSitus::whereDate('tanggal', today())
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('H');
                });
            
            for ($i = 0; $i < 24; $i++) {
                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                if (isset($visits[$hour]) || $i <= now()->format('H')) {
                    $labels[] = $hour . ':00';
                    $data[] = isset($visits[$hour]) ? $visits[$hour]->count() : 0;
                }
            }
        } elseif ($activeFilter === 'week') {
            for ($i = 6; $i >= 0; $i--) {
                $date = today()->subDays($i);
                $labels[] = $date->translatedFormat('l'); // Senin, Selasa
                $data[] = KunjunganSitus::whereDate('tanggal', $date)->count();
            }
        } else {
            for ($i = 3; $i >= 0; $i--) {
                $start = today()->subWeeks($i)->startOfWeek();
                $end = today()->subWeeks($i)->endOfWeek();
                $labels[] = 'Minggu ' . (4 - $i);
                $data[] = KunjunganSitus::whereBetween('tanggal', [$start, $end])->count();
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Akses / Kunjungan',
                    'data' => $data,
                    'backgroundColor' => 'rgba(2, 132, 199, 0.2)', // Light Sky Blue
                    'borderColor' => '#0284C7',
                    'borderWidth' => 3,
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#ffffff',
                    'pointBorderColor' => '#0284C7',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
