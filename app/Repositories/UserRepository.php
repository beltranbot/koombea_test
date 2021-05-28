<?php

namespace App\Repositories;

use App\DTO\User;
use App\Models\User as UserModel;
use App\Utils\IndexRequests\UserIndexRequest;

class UserRepository implements UserRepositoryInterface
{

    public function register(User $user) : UserModel
    {
        $user = new UserModel($user->asArray());
        $user->save();
        return $user;
    }

    public function getPaginated(UserIndexRequest $request)
    {
        $users = UserModel::paginate($request->getPerPage());
        return $users;
    }
}
