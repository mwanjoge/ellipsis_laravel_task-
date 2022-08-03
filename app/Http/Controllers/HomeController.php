<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UrlService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $urls = UrlService::findAll();
        return view('home',compact('urls'));
    }

    public function userProfile($id){
        $user = User::find($id);
        if($user){
            return view('auth.profile',compact('user'));
        }
        else{
            flash('User not found','error');
            return back();
        }
    }

    public function userUpdate(Request $request,$id){
        $user = User::find($id);
        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            flash('User profile updated','success');
            return redirect()->route('user.profile',$user->id);
        }
        else{
            flash('User not found','error');
            return back();
        }
    }
}
