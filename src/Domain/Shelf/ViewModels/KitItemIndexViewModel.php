<?php

namespace Domain\Shelf\ViewModels;

use Domain\Shelf\Models\KitItem;
use Spatie\ViewModels\ViewModel;

class KitItemIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function kitItems()
    {
        return KitItem::query()
            ->select('kit_items.id', 'kit_items.name', 'kit_items.slug', 'kit_items.created_at', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'kit_items.user_id')
            ->orderBy('id', 'DESC')
            ->paginate(200)
            ->withQueryString();
    }
}
