<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // validated accounts by waleed
        $accounts = [
            [
                'name' => 'Cash',
                'head' => 'Asset',
                'normal_balance' => 'Debit'
            ],
            [
                'name' => 'Accounts Payable',
                'head' => 'Liability',
                'normal_balance' => 'Credit'
            ],
            [
                'name' => 'Accounts Payable',
                'head' => 'Expense',
                'normal_balance' => 'Debit'
            ],
            [
                'name' => 'Sales Income',
                'head' => 'Income',
                'normal_balance' => 'Credit'
            ],
            [
                'name' => 'Salaries',
                'head' => 'Expense',
                'normal_balance' => 'Debit'
            ],
            [
                'name' => 'Common Stocks',
                'head' => 'Asset',
                'normal_balance' => 'Debit'
            ],
            [
                'name' => 'Accounts Receivable',
                'head' => 'Asset',
                'normal_balance' => 'Debit'
            ],
            [
                'name' => 'Capital',
                'head' => 'Equity',
                'normal_balance' => 'Credit'
            ],
            
        ];
        DB::table('accounts')->insert($accounts);
    }
}
