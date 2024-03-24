<?php

namespace App\Filament\Widgets;

use App\Models\Child;
use App\Models\Education;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ServicEducationChart extends ChartWidget
{
    protected static ?string $heading = 'الاولاد';
    protected static ?int $sort=4;

    protected function getData(): array
    {
        $data = Trend::model(Child::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'الاولاد',
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
