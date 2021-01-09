<?php

namespace Database\Seeders;

use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @var Role $ownerRole
     * @return void
     */
    public function run()
    {
        Payment::refreshApi();

//        foreach (Payment::all() as $payment) {
//            $payment->company_id = Company::first()->id;
//            $payment->save();
//        }
    }
}
