<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Content;
use Filament\Widgets\ChartWidget;

class ContentDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'توزيع المحتوى';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 4; // 1/4 of 12 columns

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Content::join('categories', 'contents.category_id', '=', 'categories.id')
            ->select('categories.type', \DB::raw('count(*) as count'))
            ->groupBy('categories.type')
            ->get();

        $labels = $data->map(fn ($item) => match($item->type) {
            'article' => 'مقال',
            'video' => 'فيديو',
            'audio' => 'صوتي',
            default => $item->type
        });

        return [
            'datasets' => [
                [
                    'label' => 'المحتوى',
                    'data' => $data->pluck('count'),
                    'backgroundColor' => [
                        '#3b82f6', // blue
                        '#10b981', // green
                        '#f59e0b', // orange
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
