<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tkiosk as Kiosk;
use App\Http\Requests\CreateUserRequest;

use EllipseSynergie\ApiResponse\Contracts\Response;
use App\User;
use Illuminate\Support\Facades\DB;
use Route;
use Laravel\Passport\Client;

class RegisterController extends Controller
{
    use TokenTrait;

    public function register(Request $request)
    {
        $rules = [
            'fullname'=>'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|string'
        ];
        $this->validate($request, $rules);
        DB::beginTransaction();
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::firstOrCreate($data);


        $data = $this->withUser($request, $this->token($request, 'password'));
        DB::commit();
        return $data;
    }


}
