<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public $data;
    public function __construct()
    {
        $this->data=Data::all();
    }
    public function getData(){
        $data =DB::table('natours_tours')->get();
        return view('charts',compact('data'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function getBarChartData(){
        $data =DB::table('natours_tours')->get();
        // $sport = DB::table('assets')->select(['sport'])->distinct()->get();
        // dd($sport);
        // dd($data);
        return view('welcome',compact('data'));
    }
    public function getBubbleChart(){
        $data = Data::all();
        // dd($data);
        return view('bubble',compact('data'));
    }
    public function getPieChart(){
        $data = Data::all();
        // dd($data);
        return view('pie',compact('data'));
    }
    public function getLineChart(){
        $data = Data::all();
        // dd($data);
        return view('line',compact('data'));
    }
    public function getPolarChart(){
        $data = Data::all();
        // dd($data);
        return view('polar',compact('data'));
    }
    public function getMixedChart(){
        $data =DB::table('natours_tours')->get();
        // dd($data);
        return view('mixed',compact('data'));
    }
}
