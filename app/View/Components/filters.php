<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class filters extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $authors= DB::table('asset_user')->select('asset_user.name','asset_user.id')->join('assets','assets.created_by','asset_user.id')->distinct()->get();
        return view('components.filters',compact('authors'));
    }
}
