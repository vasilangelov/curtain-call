<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $latestCount = 3;

        $upcomingPerformances = DB::table('events as e')
            ->whereDate('performance_date', '>=', date('Y-m-d'))
            ->join('performances as p', 'p.id', '=', 'e.performance_id')
            ->join('theaters as t', 't.id', '=', 'e.theater_id')
            ->join('cities as c', 'c.id', '=', 't.city_id')
            ->select('e.performance_date', 't.name as theater', 'p.name as performance', 'p.poster', 'c.name as city')
            ->orderBy('performance_date')
            ->take($latestCount)
            ->get();

        return view('index.index', [
            'title' => 'Home',
            'upcomingPerformances' => $upcomingPerformances
        ]);
    }
}
