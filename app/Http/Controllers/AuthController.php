<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use Auth;
use App\Book;

class AuthController extends Controller
{
    public function register(Request $request,User $user)
    {
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',

        ]);

        $user = $user->create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'api_token' => bcrypt($request->email)
        ]);

        $response = fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();

        return response()->json($response, 201);
    }

    public function login(Request $request,User $user)
    {
        if(!Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return response()->json(['error' => 'Your credential is wrong'],401);
        }

        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();
    }
}
