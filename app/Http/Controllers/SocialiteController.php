<?php

namespace App\Http\Controllers;

use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Jenssegers\Agent\Agent;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        // $authUser = $this->findOrCreateUser($user, 'google');
        $authUser = User::where('email', $user->email)->first();


        if ($authUser) {
            if ($authUser->allowed) {
                Auth::login($authUser, true);
                $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );
                $foto = file_get_contents($user->getAvatar(), false, stream_context_create($arrContextOptions));
                File::put(public_path() . '/profile/' . $authUser->id . '.jpg', $foto);

                //Loging User Login
                log_authenticated(Auth::user()->id);

                //Check Device
                $agent = new  \Jenssegers\Agent\Agent;
                if ($agent->isMobile()) {
                    return redirect()->to('/konsultasi');
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }

    // public function findOrCreateUser($user, $provider)
    // {
    //     $authUser = User::where('email', $user->email)->first();
    //     if ($authUser) {
    //         return $authUser;
    //     } else {
    //         // $data = User::create([
    //         //     'name' => $user->name,
    //         //     'email' => $user->email,
    //         //     'provider' => $provider,
    //         //     'provider_id' => $user->id
    //         // ]);
    //         // $authUser->assignRole('user');

    //         // return $data;
    //     }
    // }
}
