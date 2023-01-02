<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    private const ITEMS_PER_PAGE = 10;
    private const PAGINATION_ON_EACH_SIDE = 2;

    private const PERFORMANCE_LIST_VALIDATIONS = [
        'query' => 'nullable|max:100',
        'startDate' => 'nullable|date_format:Y-m-d|before_or_equal:endDate',
        'endDate' => 'nullable|date_format:Y-m-d|after_or_equal:startDate',
    ];

    public function list(Request $request)
    {
        $data = $request->validate(self::PERFORMANCE_LIST_VALIDATIONS);

        $startDate = isset($data['startDate']) ? Carbon::parse($data['startDate']) : null;
        $endDate = isset($data['endDate']) ? Carbon::parse($data['endDate']) : null;

        $performances = Performance::search($data['query'] ?? '')
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

                $builder->whereDate('performance_date', '>=', $startDate ?? Carbon::now());

                if ($endDate) {
                    $builder->whereDate('performance_date', '<=', $endDate);
                }
            })
            ->paginate(static::ITEMS_PER_PAGE)
            ->onEachSide(static::PAGINATION_ON_EACH_SIDE)
            ->withQueryString();

        return view('performance.list', [
            'title' => 'Performances',
            'performances' => $performances,
            'queryString' => $data->query ?? null,
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
