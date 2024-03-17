<?php

use Google\Service\Docs\Request;
use Illuminate\Support\Carbon;

function isMobileDevice()
{
    return preg_match(
        "/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
        $_SERVER["HTTP_USER_AGENT"]
    );
}

//Loging User Login
function log_authenticated($id_user)
{
    // // If User Noted in this Day
    // $check = \App\Models\LogingAuth::where('id_user', $id_user)
    //     ->whereDate('time', Carbon::now()->format('Y-m-d'))
    //     ->first();

    // if (!$check) {
    session()->put('last_login', Carbon::now());
    \App\Models\LogingAuth::create([
        'id_user' => $id_user,
        'time' => Carbon::now(),
    ]);
    // }
}
