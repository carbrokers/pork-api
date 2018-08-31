<?php
    namespace App\Repositories;
    use Illuminate\Support\Facades\Auth;
    use App\User;

    class UserRepositories
    {
        public function login($request)
        {
            $username = $request->get('username');
            $password = $request->get('password');
            if(Auth::attempt(['name' => $request->get('username'), 'password' => $request->get('password')])) {
                return 'login';
            }
            return 'failure';
        }
    }