<?php

namespace App\Filament\Widgets;

use App\Models\Member;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Members', Member::count())
                ->description('Total members')
                ->url(route('filament.admin.resources.members.index'))
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('success'),

            Stat::make('Total Deleted Members', Member::query()->onlyTrashed()->count())
                ->description('Total members')
                ->url(route('filament.admin.resources.members.index'))
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('danger'),
        ];
    }
}
