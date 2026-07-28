<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Carbon\Carbon;
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
                'date_of_transaction' => Carbon::parse('06-02-2026'),
            ],
            [
                'description' => 'Paid the University Fee',
                'date_of_transaction' => Carbon::parse('05-05-2026')
            ],
            [
                'description' => 'Received Software Subscription',
                'date_of_transaction' => Carbon::parse('12-12-2026')
            ],
            [
                'description' => 'Received Salaray',
                'date_of_transaction' => Carbon::parse('01-08-2026')
            ],
            [
                'description' => 'Bought Medicines',
                'date_of_transaction' => Carbon::parse('18-07-2026')
            ],
            [
                'description' => 'Bought Vegetables',
                'date_of_transaction' => Carbon::parse('18-07-2026')
            ],
            [
                'description' => 'Bought Fruits',
                'date_of_transaction' => Carbon::parse('18-07-2026')
            ],
            [
                'description' => 'Bought House',
                'date_of_transaction' => Carbon::parse('18-07-2026')
            ],
            [
                'description' => 'Bought Motorcycle',
                'date_of_transaction' => Carbon::parse('18-07-2026')
            ],
            [
                'description' => 'Received Software Subscription Fee',
                'date_of_transaction' => Carbon::parse('18-07-2026')
            ]
        ];
        foreach($transactions as $transaction){
            // DB::table('transactions')->insert($transaction);
            Transaction::create($transaction);
        }
        
    }
}
