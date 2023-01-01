<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerformanceTicketSeeder extends Seeder
{
    private const TICKET_IDS = [2, 3, 4];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $performanceTicketModels = [];

        for ($performanceId = 1; $performanceId <= 120; $performanceId++) {
            $additionalTicketsCount = rand(0, 3);

            $ticketIds = [];

            if ($additionalTicketsCount > 0) {
                $ticketIds = array_rand(static::TICKET_IDS, $additionalTicketsCount);
            }

            // In the case of single item returned.
            if (is_int($ticketIds)) {
                $ticketIds = [$ticketIds];
            }

            // Add the 'Normal' ticket if it is not present in the array.
            if (!in_array(1, $ticketIds)) {
                $ticketIds[] = 1;
            }

            foreach ($ticketIds as $ticketId) {
                $performanceTicketModels[] = [
                    'performance_id' => $performanceId,
                    'ticket_id' => $ticketId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('performance_tickets')
            ->insert($performanceTicketModels);
    }
}
