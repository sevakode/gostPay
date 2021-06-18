<?php namespace App\Traits;

use App\Models\Company;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasRolesAndPermissions
 * @package App\Traits
 */
trait HasCompanyAndPermissions
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function company(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function companyPermissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->company()->first()->permissions();
    }

    public function companyUsers()
    {
        return self::where('company_id', $this->company_id)->where('id', '!=', $this->id);
    }

    /** Для проверки прав доступа текущего компании
     * @param string $permission
     * @param string|null $role
     * @return bool
     */
    public function hasCompanyPermission(string $permission): bool
    {
        return $this->companyPermissions()
            ->where('slug', $permission)
            ->whereNull('role_id')
            ->exists();
    }

    /** Для проверки прав доступа роли текущей компании
     * @param string $permission
     * @param string|null $role
     * @return bool
     */
    public function hasCompanyPermissionWithRole(string $permission): bool
    {
        $role = request()->user()->role()->select('id')->first()->id;

        return $this->companyPermissions()
            ->where('slug', $permission)
            ->where('role_id', $role)
            ->exists();
    }

    /** Метод проверяет, содержат ли права компании заданное право
     * @param string $permission
     * @return bool
     */
    public function hasCompanyPermissionTo(string $permission): bool
    {
        return $this->hasCompanyPermission($permission);
    }

    public function hasCompanyPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->companyPermissions()->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /** Первый метод получает все Права на основе переданного массива.
     * @param array $permission
     * @return Builder
     */
    public function allCompanyPermissions(array $permission): Builder
    {
        return Permission::whereIn('slug', $permission);
    }

    /** Прикрепляет Права к текущему Пользователю
     * @param mixed ...$permissions
     * @return $this
     */
    public function giveCompanyPermissionsTo(... $permissions)
    {
        if($this->allCompanyPermissions($permissions)->doesntExist())
            return $this;

        $this->permissions()->saveMany($this->allCompanyPermissions($permissions)->get());

        return $this;
    }

    /** Удаляем все прикрепленные Права
     * @param mixed ...$permissions
     * @return $this
     */
    public function deleteCompanyPermissions(... $permissions)
    {
        $this->giveCompanyPermissionsTo()->detach($permissions);

        return $this;
    }

    /** Метод фактически удаляет все Права Пользователя, а затем переназначает предоставленные для него Права.
     * @param mixed ...$permissions
     * @return \App\Models\User|HasRolesAndPermissions
     */
    public function refreshCompanyPermissions(... $permissions )
    {
        $this->giveCompanyPermissionsTo()->detach();
        return $this->givePermissionsTo($permissions);
    }
}
