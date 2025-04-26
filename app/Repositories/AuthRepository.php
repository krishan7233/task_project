<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function findByEmail(string $email): ? User
    {
        return User::where('email', $email)->first();
    }

    public function checkPassword(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }


    public function createUser(array $data)
    {
        return \App\Models\User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'mobile'   => $data['mobile'],
            'password' => bcrypt($data['password']),
            'usertype' => 2, // default to user
            'status'   => 1, // active
        ]);
    }




}

