<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function loginForm()
    {
        if (session()->get('user_id')) {
            return redirect()->to(site_url('customers'));
        }

        return view('pos/login', ['title' => 'Log In']);
    }

    public function login()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = $username !== '' && strlen($username) <= 50 && $password !== ''
            ? (new UserModel())->where('username', $username)->first()
            : null;

        if ($user === null || ! password_verify($password, (string) ($user['password'] ?? ''))) {
            // Never flash the password to the session, including on failed login.
            return redirect()->to(site_url('login'))
                ->with('error', 'Invalid username or password.')
                ->with('login_username', strlen($username) <= 50 ? $username : '');
        }

        $session = session();
        $session->regenerate(true);
        $session->set([
            'user_id'  => (int) $user['id'],
            'username' => $user['username'],
        ]);

        return redirect()->to(site_url('customers'));
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }
}
