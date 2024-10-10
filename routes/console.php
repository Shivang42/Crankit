<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Mail;
use App\Models\Friends;use App\Models\User;
use App\Mail\FriendRequest;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Schedule::call(function (){
    $pending = Friends::all()->filter(function ($friends){
        return $friends->type=='pending';
    });
    foreach($pending as $request){
        $friend1 = User::find($request->friend1);
        $friend2 = User::find($request->friend1);
        $from = $friend1->uname;
        $to = $friend2->email;
        $redirectURL = $friend2->identifier;
        $params = [$from,$to,$redirectURL];
        Mail::to($to)->send(new FriendRequest(fromname:$from,fromlink:$redirectURL));
    }
    
    
})->everyMinute()->timezone('Asia/Kolkata');
