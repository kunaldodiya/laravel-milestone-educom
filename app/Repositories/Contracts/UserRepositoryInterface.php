<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getUserById($user_id);
    public function basicAuth($request);
    public function otpAuth($request);
    public function refreshToken();
    public function generateToken($token, $user);
}
