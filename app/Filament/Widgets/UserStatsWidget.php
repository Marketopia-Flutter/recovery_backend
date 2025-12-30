<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Relapse;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class UserStatsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalUsers = User::where('is_guest', false)->count();
        $totalGuestUsers = User::where('is_guest', true)->count();
        $activeStreaks = User::whereNotNull('clean_date')->count();
        
        // Average streak length (only for users with active streaks)
        $avgStreak = User::whereNotNull('clean_date')
            ->get()
            ->avg(function ($user) {
                return $user->streak_days;
            });
        
        $relapsesThisMonth = Relapse::whereMonth('relapse_date', Carbon::now()->month)->count();

        return [
            Stat::make('إجمالي المستخدمين', $totalUsers)
                ->description('المستخدمين المسجلين')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
                
            Stat::make('المستخدمين الزوار', $totalGuestUsers)
                ->description('جلسات مجهولة')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
                
            Stat::make('العدادات النشطة', $activeStreaks)
                ->description('مستخدمون في رحلة التعافي')
                ->descriptionIcon('heroicon-m-fire')
                ->color('warning'),
                
            Stat::make('متوسط العداد', round($avgStreak, 1) . ' يوم')
                ->description('متوسط أيام التعافي')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('primary'),
                
            Stat::make('الانتكاسات هذا الشهر', $relapsesThisMonth)
                ->description('إجمالي مرات إعادة العداد هذا الشهر')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('danger'),
        ];
    }
}
