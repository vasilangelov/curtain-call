<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Illuminate\Database\Query\Builder;
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

    public function details(int $id)
    {
        $performance = Performance::with([
            'tickets' => function ($query) {
                $query
                    ->select('type', 'price')
                    ->orderBy('price');
            }
        ])
            ->where('performances.id', '=', $id)
            ->join('theaters', 'theaters.id', '=', 'performances.theater_id')
            ->join('cities', 'cities.id', '=', 'theaters.city_id')
            ->select(
                'performances.id',
                'performances.name',
                'performances.description',
                'performances.performance_date',
                'performances.poster',
                'cities.name as city',
                'theaters.name as theater',
            )
            ->first();

        // If the performance is not present in the database return 404
        if (is_null($performance)) {
            return abort(404);
        }

        return view('performance.details', [
            'title' => 'Performance Details',
            'performance' => $performance,
        ]);
    }
}
