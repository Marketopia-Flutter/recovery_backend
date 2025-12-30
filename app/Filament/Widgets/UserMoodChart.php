<?php

namespace App\Filament\Widgets;

use App\Models\MoodTracker;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserMoodChart extends ChartWidget
{
    protected static ?string $heading = 'متوسط الحالة المزاجية (آخر 30 يوم)';
    
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 8; // 3/4 of 12 columns

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = MoodTracker::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('AVG(mood_level) as average_mood')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'متوسط السعادة',
                    'data' => $data->map(fn ($row) => $row->average_mood),
                    'borderColor' => '#10b981',
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->map(fn ($row) => Carbon::parse($row->date)->format('M d')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
