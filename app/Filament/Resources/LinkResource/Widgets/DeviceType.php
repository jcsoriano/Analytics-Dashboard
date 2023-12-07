<?php

namespace App\Filament\Resources\LinkResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;

class DeviceType extends ChartWidget
{
    protected static ?string $heading = 'Number of Clicks by device type';

    public ?Model $record = null;

    public ?string $filter = 'today';

    protected function getData(): array
    {
        $labels = ['Mobile', 'Tablet', 'Desktop'];

        return [
            'datasets' => [
                [
                    'label' => 'Clicks',
                    'data' => array_map(
                        fn ($label) => (
                            $this->record->clicks()
                                ->whereHas('deviceType', fn ($q) => $q->where('name', $label))
                                ->count()
                        ),
                        $labels
                    ),
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Last 24 hours',
            'week' => 'Last 7 days',
            'month' => 'Last 30 days',
            'quarter' => 'Last 90 days',
            'year' => 'Last 365 days',
            'all' => 'All time',
        ];
    }
}
