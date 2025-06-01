<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function login()
    {
        return $this->render('auth/login', [
            'title' => 'Login'
        ]);
    }

    public function register()
    {
        return $this->render('auth/register', [
            'title' => 'Register'
        ]);
    }

    public function forgotPassword()
    {
        return $this->render('auth/forgot-password', [
            'title' => 'Forgot Password'
        ]);
    }

    public function resetPassword()
    {
        return $this->render('auth/reset-password', [
            'title' => 'Reset Password'
        ]);
    }
}