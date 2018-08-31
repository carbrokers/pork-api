<?php

namespace App\Http\Controllers\Backend\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositories as User;

class LoginController extends Controller
{
    //
    protected $user;
    protected $redirectTo = '/admin';

    public function __construct(User $user) 
    {
        $this->user = $user;
    }

    public function index() 
    {
        return view('admin.login');
    }

    public function login(Request $request) 
    {
        return $this->user->login($request);
    }
}
