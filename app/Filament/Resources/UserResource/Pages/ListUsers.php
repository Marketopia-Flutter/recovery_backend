<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('الكل'),
            'admins' => Tab::make('المشرفين')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_admin', true)),
            'users' => Tab::make('المستخدمين')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_admin', false)->where('is_guest', false)),
            'guests' => Tab::make('الزوار')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_guest', true)),
        ];
    }
}
