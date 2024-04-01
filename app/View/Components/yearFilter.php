<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class yearFilter extends Component
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
        $months=DB::table('assets')->select(DB::raw('DISTINCT MONTH(published_date) as month'))->whereNotNull('published_date')->orderBy('month')->pluck('month')->all();;
        $years=DB::table('assets')->select(DB::raw('DISTINCT YEAR(published_date) as year'))->whereNotNull('published_date')->pluck('year')->all();
        // dd($years);
        return view('components.year-filter',compact('years','months'));
    }
}
