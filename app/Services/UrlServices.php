<?php
namespace App\Services;

use App\Mail\URLExpiresMail;
use App\Notifications\URLExpiresMailNotification;
use AshAllenDesign\ShortURL\Models\ShortURL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class UrlService{

    public static function findAll(){
       return  \AshAllenDesign\ShortURL\Models\ShortURL::where('user_id',auth()->user()->id)->get();
    }

    public static function generate($request){
        $builder = new \AshAllenDesign\ShortURL\Classes\Builder();

        $shortURLObject = $builder->destinationUrl($request->url);
        if($request->expires != null)
            $shortURLObject->deactivateAt(Carbon::parse($request->expires));
        $shortURLObject->user_id = auth()->user()->id;
        $shortURL = $shortURLObject->make();
        if($request->expires != null)
            self::sendExpireNotificationEmail($shortURL->default_short_url, $shortURL->deactivated_at);
        return $shortURL;
    }

    public static function sendExpireNotificationEmail($url,$date){
        auth()->user()->notify(new URLExpiresMailNotification($url,$date->format('d M Y')));
    }

    public static function getUrl($id){
        return ShortURL::find($id);
    }

    public static function disableUrl($url){

    }
}
