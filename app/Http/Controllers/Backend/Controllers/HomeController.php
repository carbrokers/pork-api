<?php

namespace App\Http\Controllers\Backend\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HomeRepositories as Home;
use Auth;

class HomeController extends Controller
{
    //
    protected $home;

    public function __construct(Home $home) 
    {
        $this->home = $home;
    }

    public function index() 
    {
        $data = $this->home->count();
        return view('admin.home',compact('data'));
    }

    public function logout()
    {
    //    Auth::logout();
        auth()->logout();   
        return [
            'code'=>200,
            'status'=>true
        ];
    }
}
