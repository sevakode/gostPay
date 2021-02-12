<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class TochkaBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = new \App\Models\Bank\BankToken();
        $token->url = 'https://enter.tochka.com';
        $token->rsUrl = 'https://enter.tochka.com/uapi';
        $token->apiVersion = 'v1.0';
        $token->bankId = 'RWN9klVG8aBD9Jf8WZZx0e8WKVdyRccF';
        $token->bankSecret = 'fPIOPTSBbpdnzyka8psZyZ1nTyJRTamC';

        $token->accessToken = 'qSd1dpkL4vmY35ksEMZu6A1A8fwdnDH5';
        $token->refreshToken = '3dT0gyxV0ApKE5HljEy5iKuVtbdm5SsI';

        $token->company_id = Company::whereName('Gost Agency')->first()->id;

        $token->save();
    }
}
