<?php namespace App\Classes\TochkaBank\Traits;

use App\Classes\TochkaBank\BankAPI;
use App\Models\Bank\BankToken;
use Illuminate\Support\Facades\Http;

/**
 * Trait OpenBanking
 * @package App\Classes\TochkaBank\Traits
 */
trait ConnectBanking
{
    /**
     * @param BankToken $token
     * @return mixed
     * @var BankAPI $this
     * @var BankToken $bank
     */
    public function connectTokenCredentials()
    {
        $bank = $this->bank;

        $response = $this->send(
            'https://enter.tochka.com/connect/token',
            [
                'Host' => '<calculated when request is sent>',
                'Accept' => '*/*',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            [
                'client_id' => $bank->bankId,
                'client_secret' => $bank->bankSecret,
                'grant_type' => 'client_credentials',
                'scope' => 'accounts',
            ]
        );

        $this->bank->accessToken = $response['access_token'];
        $this->bank->save();


        return $response;
    }

    public function connectTokenRefresh()
    {
        $url = $this->bank->url.'/connect/token';
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $data = [
            'client_id' => $this->bank->bankId,
            'client_secret' => $this->bank->bankSecret,
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->bank->refreshToken,
        ];

        $response = Http::asForm()->post($url, $data)
            ->object();

        if(isset($response->error)) dd($response);

        return (object) $response;
    }

    public function connectAuthorize()
    {
        $redirect_uri = 'https://app.gost.agency/api/tauth';
        $token = 'ew0KICJ0eXAiOiAiSldUIiwNCiAiYWxnIjogIm5vbmUiDQp9.eyJpc3MiOiJ0b2Noa2EiLCJyZXNwb25zZV90eXBlIjoiY29kZSBpZF90b2tlbiIsImNsaWVudF9pZCI6InRtVmNBQklDUmFBVjVQcDR6SDNnbDNLOGVEWDhKb0RaIiwicmVkaXJlY3RfdXJpIjoiaHR0cHM6Ly9hcHAuZ29zdC5hZ2VuY3kvYXBpL3RhdXRoIiwic3RhdGUiOiJWdWlodnNkcyIsInNjb3BlIjoiYWNjb3VudHMgY2FyZHMgY3VzdG9tZXJzIHNicCBwYXltZW50cyIsIm5vbmNlIjoic2Rmc2ZkcyIsIm1heF9hZ2UiOiI4NjQwMCIsImNsYWltcyI6eyJ1c2VyaW5mbyI6eyJvcGVuYmFua2luZ19pbnRlbnRfaWQiOnsidmFsdWUiOiI1ZTQ0NzYzNy1kYTUxLTQ1MTUtOGExYS0yOTU3NmE0ODIyMDIiLCJlc3NlbnRpYWwiOnRydWV9fSwiaWRfdG9rZW4iOnsib3BlbmJhbmtpbmdfaW50ZW50X2lkIjp7InZhbHVlIjoiNWU0NDc2MzctZGE1MS00NTE1LThhMWEtMjk1NzZhNDgyMjAyIiwiZXNzZW50aWFsIjp0cnVlfSwiYWNyIjp7InZhbHVlcyI6WyJ1cm46cnViYW5raW5nOnNjYSIsInVybjpydWJhbmtpbmc6Y2EiXSwiZXNzZW50aWFsIjp0cnVlfX19LCJhdWQiOiJodHRwczovL2VudGVyLnRvY2hrYS5jb20ifQ.';
        $linkAuth = 'https://enter.tochka.com/connect/authorize'.
            '?client_id='. $this->bank->bankId.
            '&response_type=code%20id_token'.
            '&state=Vuihvsds'.
            "&redirect_uri=$redirect_uri".
            '&nonce=sdfsfds'.
            '&scope=accounts%20cards%20customers%20sbp%20payments'.
            '&request='.$token;

        return redirect($linkAuth);
    }

}
