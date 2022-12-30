<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    private const TICKETS = [
        [
            'type' => 'Normal',
            'price' => 10,
        ],
        [
            'type' => 'Premium',
            'price' => 50,
        ],
        [
            'type' => 'Elder',
            'price' => 5,
        ],
        [
            'type' => 'Child',
            'price' => 5,
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticketModels = array_map(fn($ticket) => [
            'type' => $ticket['type'],
            'price' => $ticket['price'],
            'created_at' => now(),
            'updated_at' => now(),
        ], static::TICKETS);

        Ticket::query()->insert($ticketModels);
    }
}
