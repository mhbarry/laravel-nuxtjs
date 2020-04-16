<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Laravel\Passport\Client;
use App\User;
//use EllipseSynergie\ApiResponse\Contracts\Response;
use Hash;

trait TokenTrait
{
    public function token(Request $request, $grant_type, $scope = '*')
    {
        $client = Client::find(2);


        if ($grant_type == 'password') {
            $params = [
                'grant_type' => $grant_type,
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $request->username ?: $request->email,
                'password' => request('password'),
                'scopte' => $scope,
            ];
        } elseif ($grant_type == 'refresh_token') {
            $params = [
                'grant_type' => 'refresh_token',
                'refresh_token' => request('refresh_token'),
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'scope' => $scope,
            ];
        } else {
            $params = [];
        }


        request()->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        $response = \Route::dispatch($proxy)->getContent();

        return json_decode($response, true);
    }

    public function withUser(Request $request, $access)
    {
        $user = User::with([])->where('email', $request->email)->first();
        $_user = [];
        $error = false;
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $_user = $user;
            }else{
                $error = true;
            }
        }else{
            $error = true;
        }
        if ($error) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'email' => ["Ces identifiants ne correspondent pas à nos enregistrements"]
            ]);
            throw $error;
        }

        return [
            'user' => $_user,
            'access_token' => 'Bearer '.$access['access_token'],
            'refresh_token' => 'Bearer '.$access['refresh_token']
        ];
    }
}
