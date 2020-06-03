<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Arr;

class UserRepository extends Repository
{
    public function user($id)
    {
        return User::findOrFail($id);
    }

    public function userByNickName($nickname)
    {
        return User::find($nickname);
    }

    public function store(array $attributes)
    {
        $u = app(User::class);
        $u->fill($attributes);
        $u->position()->associate(Arr::get($attributes, 'position_id'));
        $u->save();
        return $u->fresh();
    }

    public function update(User $user, array $attributes)
    {
        return $user->fill($attributes)->save();
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
