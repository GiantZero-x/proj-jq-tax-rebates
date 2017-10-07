<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 9:04
 */

namespace App\Repositories\Impl;

use App\Model;
use App\Repositories\UserRepositoryInterface;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepositoryImpl implements UserRepositoryInterface
{
    public function save(array $params, ...$args):int
    {
        $user = new User($params);

        return $user->save();
    }

    public function update(array $params, int $id):int
    {
        $user = User::find($id);

        $user->detachRoles();

        $user->attachRoles(explode(',', array_get($params, 'role_id')));

        return (int) $user->update($params);
    }

    public function delete(int $id):int
    {
        return User::destroy($id);
    }

    public function select(int $id):?Model
    {
        return User::findOrFail($id);
    }

    public function getUsersByRole(string $name):?Collection
    {
        $role = Role::whereName($name)->first();

        if ($role) {
            return $role->users;
        }
        return null;
    }
}