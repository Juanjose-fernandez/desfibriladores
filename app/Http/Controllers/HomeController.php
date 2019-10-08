<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->hasRole('webmaster')){
            return redirect()->action('User\UserController@getList');
        }
        elseif (Auth::user()->hasRole('thenical')){
            return 'is technical';
           /* return redirect()->action('DashboardController@getMainView');*/
        }
    }
}
