<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Contracts\Service\Attribute\Required;

class SportsController extends Controller
{
    // public function getData(){
    //     $data=DB::table('assets')->selectRaw('sport,COUNT(*) as sport_user')->groupBy('sport')->whereNotNull('sport')->get();
    //     // dd($data);
    //     return view('sports',compact('data'));
    // }
    public function storeData(Request $request)
    {
        // $request->validate([
        //     'start'=>'required'
        // ]);
        // return $request;
        // dd($request);
        $query = DB::table('assets')
            ->whereNotNull('published_date')
            ->join('asset_user', 'assets.created_by', '=', 'asset_user.id','left')
            ->whereNotNull('created_by')
            ->select('sport', DB::raw('count(*) as total'))
            ->groupBy('sport');

        if ($request->filled('start') && $request->filled('end')) {
            $query->whereBetween('published_date', [$request->start, $request->end]);
        }
        $data = $query->pluck('total', 'sport')->all();
        $sports = array_keys($data);
        $dataCount = array_values($data);
        return response()->json([
            'sports' => $sports,
            'dataCount' => $dataCount,
        ]);
    }
    public function getPostBySport(Request $request)
    {
        // dd($request);
        $data = DB::table('assets')->whereNotNull('sport')->whereNotNull('published_date')->whereNotNull('created_by')->select('sport', DB::raw('count(*) as total'))->groupBy('sport')->where(DB::raw('MONTH(published_date)'), $request->month)->where(DB::raw('YEAR(published_date)'), $request->year)->pluck('total', 'sport')->all();
        $sports = array_keys($data);
        $dataCount = array_values($data);
        return response()->json([
            'sports' => $sports,
            'dataCount' => $dataCount
        ]);
    }
    public function getPostByYear(Request $request)
    {
        // return $request;
        $query = DB::table('assets')->select(DB::raw('YEAR(published_date) as year, MONTH(published_date) as month
        ,COUNT(*) as blogs_published'))->whereNotNull('published_date')
            ->groupBy('year', 'month');
        if ($request->filled('month')) {
            // if($request->year)
            $query->where(DB::raw('MONTH(published_date)'), $request->month);
        }
        // if($request->filled('year')){
        //     // if($request->year)
        //     $query->where(DB::raw('YEAR(published_date)'),$request->year);
        // }
        $data = $query->get();

        $year = [];
        $count = [];
        $month = [];
        foreach ($data as $value) {
            array_push($year, $value->year);
            array_push($month, $value->month);
            array_push($count, $value->blogs_published);
        }
        // dd($count);
        return response()->json([
            'count' => $count,
            'month' => $month,
            'year' => $year
        ]);
    }
    public function getPostByauthor(Request $req)
{
    // Subtract one day from the start date
    // $start_date = date('Y-m-d', strtotime("-1 day", strtotime($req->start)));

    $query = DB::table('assets')
        ->join('asset_user', 'assets.created_by', '=', 'asset_user.id','left')
        ->whereNotNull('assets.published_date')
        ->whereNotNull('created_by')
        ->select('asset_user.name as name', DB::raw('count(*) as total'));

    if ($req->start) {
        $query->whereBetween('assets.published_date', [$req->start, $req->end]);
    }

    $data = $query->where('assets.sport', $req->sport)
        ->groupBy('asset_user.name')
        ->pluck('total', 'name')->all();

    $authors = array_keys($data);
    $dataCount = array_values($data);

    return response()->json([
        'authors' => $authors,
        'dataCount' => $dataCount
    ]);
}

}
