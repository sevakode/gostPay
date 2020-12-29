<?php


namespace App\Models\Bank;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BankToken
 * @package App\Models\Bank
 * @property int id
 * @property string url
 * @property string bankId
 * @property string bankSecret
 * @property null|string authCode
 * @property null|Carbon authCodeDate
 * @property null|string accessToken
 * @property null|Carbon accessTokenDate
 * @property null|string refreshToken
 * @property null|Carbon refreshTokenDate
 * @property null|string jwtToken
 * @property null|string rsUrl
 * @property null|string apiVersion
 */
class BankToken extends Model
{
    protected $dates = [
        'authCodeDate',
        'accessTokenDate',
        'refreshTokenDate',
    ];

	public function token()
	{
		return $this->hasMany(BankRequest::class);
	}

    public function getAPIUrl(string $method)
    {
        return $this->url . $method;
    }

    public function getAuthCodeAttribute($value)
    {
        return $this->getToken('authCode', 2 * 60);
    }

//    public function getAccessTokenAttribute($value)
//    {
//        return $this->getToken('accessToken', 24 * 60 * 60);
//    }

    public function getRefreshTokenAttribute($value)
    {
        return $this->getToken('refreshToken', 30 * 24 * 60 * 60);
    }

    public function setAuthCodeAttribute($value)
    {
        $this->setToken('authCode', $value);
    }

    public function setAccessTokenAttribute($value)
    {
        $this->setToken('accessToken', $value);
    }

    public function setRefreshTokenAttribute($value)
    {
        $this->setToken('refreshToken', $value);
    }

    protected function getToken(string $attribute, int $timeout)
    {
        /** @var null|Carbon $date */
        $date = $this->attributes["{$attribute}Date"];
        if (!$date) {
            return null;
        }
        $elapsed = time() - $date->getTimestamp();
        if ($elapsed > $timeout) {
            $this->setToken($attribute, null);
            $this->save();
            return null;
        }
        return $this->attributes[$attribute];
    }

    protected function setToken(string $attribute, $value)
    {
        if ($value) {
            $this->attributes[$attribute] = $value;
            $this->attributes["{$attribute}Date"] = Carbon::now();
        } else {
            $this->attributes[$attribute] = null;
            $this->attributes["{$attribute}Date"] = null;
        }
    }
}
