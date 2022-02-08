<?php

namespace App\Models;

use App\Interfaces\OptionsPermissions;
use App\Models\Bank\Account;
use App\Models\Bank\Card;
use App\Models\Bank\TransactionBalance;
use App\Traits\HasCompanyAndPermissions;
use App\Traits\Imageable;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 * @package App\Models
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $password
 * @property $phone
 * @property $role_id
 * @property $company_id
 * @property $telegram
 * @property Company $company
 * @method static User companyValidate(int $user): User
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndPermissions, HasCompanyAndPermissions, Imageable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'role_id',
        'company_id',
        'telegram'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeCompanyValidate($query, int $userId)
    {
        return $query
            ->where('id', $userId)
            ->whereHas('company', function ($query) {
                $requestUser = request()->user();
                if (! $requestUser->hasPermission(OptionsPermissions::MANAGER_ROLE_SET['slug']))
                    $query->where('id', $requestUser->company_id);
            })
            ->firstOr(['*'], function () {
                return response()->view('pages.errors.error-1', [
                    'code' => 500,
                    'message' => 'У вас недостаточно прав!'
                ]);
            });
    }

    public function checkBalance(Account $account)
    {
        $balance = (integer) $this->balance($account->id)->getSum();
        $cards = $this->cards()->where('account_code', $account->refresh()->account_id);

        if ($balance <= 0) {
            $cards->blocks();
        }
        else if ($balance > 0) {
            $cards->unblocks();
        }
    }

    public function balance($account_id = null): BelongsToMany
    {
        $belongsToMany = $this
            ->belongsToMany(TransactionBalance::class, 'transaction_balances_companies_users',
                'user_id', 'transaction_id')
            ->where('company_id', $this->company->id);

        if ($account_id) $belongsToMany->where('bank_account_id', $account_id);

        return $belongsToMany;
    }

    public function cards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Card::class)->where('company_id', $this->company_id);
    }

    public function projects()
    {
        return $this->company->projects()->first()->users()->get();
    }

    public function hasPermission(string $permission): bool
    {
        return ($this->hasRolePermission($permission) or $this->hasCompanyPermissionWithRole($permission));
    }

    /** Метод проверяет, содержат ли права пользователя заданное право
     * @param string $permission
     * @return bool
     */
    public function hasPermissionTo(string $permission): bool
    {
        return $this->hasPermission($permission);
    }

    /**
     * @param $value
     * @return string
     */
    public function getFirstNameAttribute($value): string
    {
        return ucfirst($value);
    }
    /**
     * @param $value
     * @return string
     */
    public function getLastNameAttribute($value): string
    {
        return ucfirst($value);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * @return string
     */
    public function getShortnameAttribute(): string
    {
        $first = $this->first_name[0] ?? '';
        $last = $this->last_name[0] ?? '';
        return strtoupper("$first $last");
    }

    public function getTelegramLinkAttribute(): string
    {
        return  $this->telegram ?
            "https://t.me/$this->telegram" :
            '';
    }

    public function getAvatarAttribute(): string
    {
        return $this->getImage('avatar')->attributes['medium'] ?? '';
    }

    public function getAvatarSmallAttribute(): string
    {
        return $this->getImage('avatar')->attributes['small'] ?? '';
    }

    public function getCompanyAttribute()
    {
        return $this->company()->first();
    }

    public function scopeWithPermissionInvisible($query)
    {
        if ($this->hasPermission(Permission::ACCESS_TO_SHOW_INVISIBLE['slug']))
            return $query;

        $queryInvisible = clone $query;
        $queryInvisible->whereHas('role', function ( $query) {
            $query->whereHas('permissions', function ($query) {
                $query->where('slug', OptionsPermissions::ACCESS_TO_INVISIBLE['slug']);
            });
        });

        $idsInvisible = array_column($queryInvisible->select('id')->get()->toArray(), 'id');
        return $query->whereNotIn('id', $idsInvisible);
    }

    public function getRoleAttribute()
    {
        return $this->role()->first();
    }

    public function logoutCompany()
    {
        $this->company_id = null;
        $this->save();
    }


}
