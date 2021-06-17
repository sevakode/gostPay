<?php namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;
use App\Notifications\DataNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

/**
 * Trait HasRolesAndPermissions
 * @package App\Traits
 */
trait HasRolesAndPermissions
{
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function permissions()
    {
        return $this->role()->first() ? $this->role()->first()->permissions() : null;
    }

    /** В функцию мы передаем массив $roles и проверяем в цикле, содержат ли роли текущего пользователя заданную роль.
     * @param string ...$roles
     * @return bool
     */
    public function hasRole(string ... $roles): bool
    {
        foreach ($roles as $role)
            if($this->role()->first()->slug === Str::slug($role)) return true;

        return false;
    }

    /** Для проверки прав доступа текущего пользователя
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        $result = ($permission and $this->permissions()) ?
            $this->permissions()->where('slug', Str::slug($permission))->exists() :
            true;
        return $result;
    }

    /** Метод проверяет, содержат ли права пользователя заданное право
     * @param string $permission
     * @return bool
     */
    public function hasPermissionTo(string $permission): bool
    {
        return $this->hasPermission($permission);
    }

    /** Первый метод получает все Права на основе переданного массива.
     * @param array $permission
     * @return Builder
     */
    public function allPermissions(array $permission): Builder
    {
        return Permission::whereIn('slug', $permission);
    }

    /** Прикрепляет Права к текущему Пользователю
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(... $permissions)
    {
        if($this->allPermissions($permissions)->doesntExist())
            return $this;

        $this->permissions()->saveMany($this->allPermissions($permissions)->get());

        return $this;
    }

    /** Удаляем все прикрепленные Права
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(... $permissions)
    {
        $this->permissions()->detach($permissions);

        return $this;
    }

    /** Метод фактически удаляет все Права Пользователя, а затем переназначает предоставленные для него Права.
     * @param mixed ...$permissions
     * @return \App\Models\User|HasRolesAndPermissions
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function getRolesListForPermissions()
    {
        $roles = collect();
        foreach ($this->permissions()->select('id')->get() as $permission) {
            $roles = $roles->merge($permission->roles()->get());
        }

        return $roles->unique('id');
    }

    public function setRole($roleId)
    {
        $this->role_id = $roleId;
        $this->save();
        Notification::send(request()->user(), DataNotification::success());
    }
}
