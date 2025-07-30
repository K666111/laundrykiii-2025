<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'customer_id' => 1, // pastikan customer dengan ID 1 ada
            'service_id' => 1,  // pastikan service dengan ID 1 ada
            'quantity' => 3,
            'total' => 15000,
            'status' => 'completed', // ← enum yang valid
            'transaction_date' => Carbon::now(), // ← tanggal valid
        ]);
    }
}
