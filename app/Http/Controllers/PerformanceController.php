<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    private const ITEMS_PER_PAGE = 10;

    public function list(Request $request)
    {
        $queryString = $request->query->get('query');
        $startDate = \DateTime::createFromFormat('Y-m-d', $request->query->get('startDate'));
        $endDate = \DateTime::createFromFormat('Y-m-d', $request->query->get('endDate'));

        $performances = Performance::search($queryString)
            ->query(function ($builder) use ($startDate, $endDate) {
                $builder
                    ->select(
                        'performances.id',
                        'performances.name',
                        'performances.performance_date',
                        'performances.poster',
                        'theaters.name as theaterName',
                        'cities.name as cityName')
                    ->join('theaters', 'theaters.id', '=', 'performances.theater_id')
                    ->join('cities', 'cities.id', '=', 'theaters.city_id')
                    ->orderBy('performance_date');

                if ($startDate) {
                    $builder->whereDate('performance_date', '>=', $startDate->format('Y-m-d'));
                }

                if ($endDate) {
                    $builder->whereDate('performance_date', '<=', $endDate->format('Y-m-d'));
                }
            })
            ->paginate(static::ITEMS_PER_PAGE);

        return view('performance.list', [
            'title' => 'Performances',
            'performances' => $performances,
            'queryString' => $queryString,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
