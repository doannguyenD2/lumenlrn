<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// use App\User as User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'username'=> 'required|string|unique:users',
            'password' => 'required|string',
        ];
        $this->validate($request,$rules);
        $user = new User([
            'name' => $request->name,
            'username'=> $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function index()
    {
        return response(User::all(),200);
    }

    //
}
