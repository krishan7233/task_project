<?php

namespace App\Services;
use App\Repositories\AuthRepository;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->authRepository->findByEmail($email);

        if (!$user || !$this->authRepository->checkPassword($user, $password)) {
            return false;
        }

        Auth::login($user);
        return true;
    }



    public function register(array $data)
    {
        return $this->authRepository->createUser($data);
    }



}
