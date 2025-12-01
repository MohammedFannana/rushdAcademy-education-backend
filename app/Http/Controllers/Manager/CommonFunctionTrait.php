<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App;
use App\User as AppUser;
use DB;

trait CommonFunctionTrait
{
    public function __construct()
    {
        $this->key = 'WbUVSk7i3ZLhF1fYjqPPKQZGKdACOsmXQ87Xk06pMj9ZPpZ6WVHtSRbTHeziuyMp';
    }

    protected function decodeKey($token)
    {


        $oritoken = $this->deEncryptToken($token);
        $tokenPayload = JWT::decode($oritoken, new Key($this->key, 'HS256'));

        // dd($tokenPayload->role);

        // dd($tokenPayload);
        //      return $tokenPayload;
        //try {
        // JWT::$leeway += 1;


        //  $tokenPayload = JWT::decode($oritoken, new Key(config('jwt.secret'), 'HS256'));


        $user = AppUser::query()->where('user_uid', $tokenPayload->user_uid)->first();


        if ($user) {
            if (!Auth::check()) {
                auth()->login($user, true);
            }
            return true;
        } else {
            $getName = $this->splitName($tokenPayload->full_name);

            $user = new AppUser([
                'user_uid' => $tokenPayload->user_uid,
                'full_name' => $tokenPayload->full_name,
                'role_name' => 'user',
                'role_id' => 1,
                //'first_name' => array_key_exists(0, $getName) ? $getName[0] : '',
                //'last_name' => array_key_exists(1, $getName) ? $getName[1] : '',
                // 'email' => $tokenPayload->email ?? '',
                // 'mobile'=> $tokenPayload->phone ?? '',
                //   //'password' => bcrypt($request->password),
                'verified' => 1,
                'created_at' => now()->timestamp
            ]);


            //$user->email_verified_at = date('Y-m-d H:m:s');


            $user->save();


            auth()->login($user, true);




            return true;
        }


        /*} catch (\Throwable $e) {
            return $this->respondInternalError($e->getMessage());
        } */
    }

    function splitName($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
        return array($first_name, $last_name);
    }


    function loadUserByUid($uid)
    {
        $user = AppUser::query()->where('user_uid', $uid)->first();
        if ($user) {
            return $user;
        } else {
            return '';
        }
    }


    function deEncryptToken($token)
    {
        $explode = explode('-=', $token);
        if (count($explode) == 5) {
            $explode = array_replace(array_flip(array('3', '0', '2', '1', '4')), $explode);
            $explode = implode("-=", $explode);
            $deCode = explode("-=", $explode, -2); // get only 3 element in array
            return implode(".", $deCode);
        }
        return 0;
    }
}
