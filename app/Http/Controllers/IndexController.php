<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private const LATEST_COUNT = 3;

    public function index()
    {
        $upcomingPerformances = Performance::query()
            ->where('performances.performance_date', '>=', Carbon::now())
            ->join('theaters as t', 't.id', '=', 'performances.theater_id')
            ->join('cities as c', 'c.id', '=', 't.city_id')
            ->select(
                'performances.id',
                'performances.name as performance',
                'performances.performance_date',
                'performances.poster',
                't.name as theater',
                'c.name as city')
            ->orderBy('performances.performance_date')
            ->take(static::LATEST_COUNT)
            ->get();

        return view('index.index', [
            'title' => 'Home',
            'upcomingPerformances' => $upcomingPerformances
        ]);
    }
}
