<?php

namespace App\Filament\Resources\LinkResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;

class ByDate extends ChartWidget
{
    protected static ?string $heading = 'Number of Clicks by date';

    public ?Model $record = null;

    public ?string $filter = 'today';

    protected function getData(): array
    {
        $range = collect(range(0, 11));

        return [
            'datasets' => [
                [
                    'label' => 'Clicks',
                    'data' => $range->map(
                        fn ($i) => $this->record->clicks()->whereMonth('created_at', $i + 1)->count()
                    ),
                ],
            ],
            'labels' => $range->map(
                fn ($i) => now()->startOfYear()->addMonths($i)->format('M')
            ),
        ];
    }

    protected function getType(): string
    {
        return 'line';
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
