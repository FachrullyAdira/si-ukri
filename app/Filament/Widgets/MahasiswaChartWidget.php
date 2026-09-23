<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class MahasiswaChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pertumbuhan Mahasiswa';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '280px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Total Mahasiswa Baru',
                    'data' => [120, 150, 180, 220, 250, 310, 380],
                    'backgroundColor' => 'rgba(10, 107, 57, 0.2)', // Light green fill
                    'borderColor' => '#0A6B39',
                    'borderWidth' => 3,
                    'fill' => true,
                    'tension' => 0.4, // Makes the line smooth/curved
                    'pointBackgroundColor' => '#ffffff',
                    'pointBorderColor' => '#0A6B39',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                ],
            ],
            'labels' => ['2018', '2019', '2020', '2021', '2022', '2023', '2024'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
