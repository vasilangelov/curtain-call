<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $latestCount = 3;

        $upcomingPerformances = DB::table('performances as p')
            ->whereDate('p.performance_date', '>=', time())
            ->join('theaters as t', 't.id', '=', 'p.theater_id')
            ->join('cities as c', 'c.id', '=', 't.city_id')
            ->select('p.name as performance', 'p.performance_date', 'p.poster', 't.name as theater', 'c.name as city')
            ->orderBy('p.performance_date')
            ->take($latestCount)
            ->get();

        return view('index.index', [
            'title' => 'Home',
            'upcomingPerformances' => $upcomingPerformances
        ]);
    }
}
