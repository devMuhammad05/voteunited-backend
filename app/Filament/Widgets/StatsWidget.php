<?php

namespace App\Filament\Widgets;

use App\Models\Vote;
use App\Models\Member;
use App\Enums\VoteType;
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

            Stat::make('Total Upvoted Members', Vote::query()->where('type', VoteType::Upvote)->count())
                ->description('Total members who received upvotes')
                ->url(route('filament.admin.resources.members.index'))
                ->descriptionIcon('heroicon-m-hand-thumb-up', IconPosition::Before)
                ->color('success'),

        ];
    }
}
