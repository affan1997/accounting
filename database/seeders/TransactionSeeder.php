<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'description' => 'Bought a car',
                'date_of_transaction' => '06-02-2026',
            ]
        ];
        DB::table('transactions')->insert($transactions);
    }
}
