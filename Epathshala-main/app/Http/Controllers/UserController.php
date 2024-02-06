<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        // $user = User::where(['email'=>$request->email])->first();

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // User exists, perform further operations
            if (Hash::check($request->password, $user->password)) {
                // Password matches, proceed with authentication logic
                $request->session()->put('user',$user);
                return redirect('/');
            } else {
                // Password does not match, handle accordingly
                return "No match";
            }
        } else {
            // User does not exist, handle accordingly
            // $users = DB::table('users')->get();
            // dd($users);
            // $request->session()->put('user',$user);
            // return redirect('/');
            return "No User Exist";
        }
        // $users = DB::table('users')->get();
        // dd($user);
        // if($user || Hash::check($request->password,$user->password))
        // {
        //     return "No match";
        // }
        // else{
        //     $request->session()->put('user',$user);
        //     return redirect('/');
        // }
    }
}
