<?php

namespace App\Http\Controllers;

use App\Services\UrlService;
use Illuminate\Http\Request;

class URLController extends Controller
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

    public function generate(Request $request){
        $request->validate([
            'url'  =>  'required|string',
            'expires'    =>  'date|nullable'
        ]);

        $url = UrlService::generate($request);
        $url->user_id = auth()->user()->id;
        $url->save();
        flash("URL successfully created", "success");
        return view('url.created',compact('url'));
    }

    public function disable($id){
        $url = UrlService::getUrl($id);
        if($url){
            $url->deactivated_at = now();
            $url->save();
            flash("URL successfully deactivated", "success");
            return back();
        }
        else{
            flash("URL not found", "error");
            return back();
        }
    }

    public function exits(){
        $urls = UrlService::findAll();
        return view('url.exits',compact('urls'));
    }

    public function destroy($id){
        $url = UrlService::getUrl($id);
        if($url){
            $url->delete();
            flash("URL successfully delete", "success");
            return back();
        }
        else{
            flash("URL not found", "error");
            return back();
        }
    }
}
