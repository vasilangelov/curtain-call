<?php

namespace Database\Seeders;

use App\Models\Performance;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    private const PERFORMANCES = [
        'La Traviata',
        'Romeo and Juliet',
        'Hamlet',
        'Star Wars',
        'The Godfather',
        'Antigone',
        'Odissey',
        'The Phoney Civilisation',
        'The Iron Candlestick',
        'Prespanski bells',
    ];

    private const LOREM_IPSUM_DESCRIPTION = "<h1>Cum natus mollitia sit porro nihil sed iure earum? </h1><p>Lorem ipsum dolor sit amet. Et beatae praesentium <strong>A officiis qui delectus itaque ut facilis explicabo</strong> est placeat delectus vel deleniti porro? Qui rerum fugitSed eveniet ad consequatur officiis sed ducimus repudiandae est omnis veritatis est accusamus aliquid. Quo odit vitae vel sint commodicum adipisci? </p><blockquote cite=\"https://www.loremipzum.com\">Non sint odio eum nihil sunt in soluta placeat aut commodi fugiat non veritatis labore qui vitae cupiditate. </blockquote><h2>Aut vitae officia qui nisi quisquam et ipsum quibusdam. </h2><p>Sit obcaecati amet qui facilis possimus <strong>Nam delectus sit sunt quaerat et pariatur quibusdam</strong>. Aut magnam ipsa ea blanditiis quamin fuga aut distinctio inventore. Ut maxime reprehenderit sed suscipit rerumIn necessitatibus non necessitatibus fuga. </p>";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $performance_models = [];

        $performances_count = count(static::PERFORMANCES);

        for ($id = 1; $id <= 120; $id++) {
            $performance_models[] = [
                'name' => static::PERFORMANCES[rand(0, $performances_count - 1)],
                'description' => static::LOREM_IPSUM_DESCRIPTION,
                'performance_date' => $this->getRandomDate('2023-01-01', '2023-12-31'),
                'theater_id' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Performance::query()
            ->insert($performance_models);
    }

    private function getRandomDate(string $from, string $to, int $fromHour = 13, int $toHour = 21): Carbon
    {
        $fromTimestamp = strtotime($from);
        $toTimestamp = strtotime($to);

        $dateTimestamp = rand($fromTimestamp, $toTimestamp);

        $date = Carbon::createFromTimestamp($dateTimestamp);

        $hour = rand($fromHour, $toHour);

        $date->setTime($hour, 0);

        return $date;
    }
}
