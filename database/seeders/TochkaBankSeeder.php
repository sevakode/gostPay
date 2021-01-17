<?php

namespace Database\Seeders;

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
        $token->bankId = 'tmVcABICRaAV5Pp4zH3gl3K8eDX8JoDZ';
        $token->bankSecret = 'weZwcRuvBjDyFHtkpAgKVcyV81J1Z4LV';

        $token->accessToken = 'zEnuyDaH1DsGLrKXc0zszGSPxOMY5U8x';
        $token->refreshToken = 'LTlMEd649eL8nNrw3qb2tBMr2tzgSWEc';

        $token->jwtToken = 'ew0KICJ0eXAiOiAiSldUIiwNCiAiYWxnIjogIm5vbmUiDQp9.eyJpc3MiOiJ0b2Noa2EiLCJyZXNwb25zZV90eXBlIjoiY29kZSBpZF90b2tlbiIsImNsaWVudF9pZCI6InRtVmNBQklDUmFBVjVQcDR6SDNnbDNLOGVEWDhKb0RaIiwicmVkaXJlY3RfdXJpIjoiaHR0cHM6Ly9hcHAuZ29zdC5hZ2VuY3kvYXBpL3RhdXRoIiwic3RhdGUiOiJWdWlodnNkcyIsInNjb3BlIjoiYWNjb3VudHMgY2FyZHMgY3VzdG9tZXJzIHNicCBwYXltZW50cyIsIm5vbmNlIjoic2Rmc2ZkcyIsIm1heF9hZ2UiOiI4NjQwMCIsImNsYWltcyI6eyJ1c2VyaW5mbyI6eyJvcGVuYmFua2luZ19pbnRlbnRfaWQiOnsidmFsdWUiOiI0NDAwN2U0NC01MWY3LTQ3NzMtOTU3MC02YzdiYzM1NmQzYzkiLCJlc3NlbnRpYWwiOnRydWV9fSwiaWRfdG9rZW4iOnsib3BlbmJhbmtpbmdfaW50ZW50X2lkIjp7InZhbHVlIjoiNDQwMDdlNDQtNTFmNy00NzczLTk1NzAtNmM3YmMzNTZkM2M5IiwiZXNzZW50aWFsIjp0cnVlfSwiYWNyIjp7InZhbHVlcyI6WyJ1cm46cnViYW5raW5nOnNjYSIsInVybjpydWJhbmtpbmc6Y2EiXSwiZXNzZW50aWFsIjp0cnVlfX19LCJhdWQiOiJodHRwczovL2VudGVyLnRvY2hrYS5jb20ifQ';

        $token->save();
    }
}
