<?php

namespace App\Filament\Widgets;

use App\Models\Family;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ServicFamilyChart extends ChartWidget
{
    protected static ?string $heading = 'العائلات';
    protected static ?int $sort=3;


    protected function getData(): array
    {
        $data = Trend::model(Family::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'العائلات',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
