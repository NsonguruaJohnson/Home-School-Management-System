<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){
        return view('auth.login');
    }

    public function store(Request $request, User $user){
        $this->validate($request, [
            'username' => ['required'],
            'password' => 'required'
        ]);

        Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->remember);

        if (auth()->user() === null){
            return back()->with('msg', 'Invalid login details');
        } else {
            switch(auth()->user()->role_id){
                case 1:
                    return redirect()->route('admin.dashboard');
                    break;

                case 2:
                    return redirect()->route('teacher.dashboard');
                    break;

                case 3:
                    return redirect()->route('student.dashboard');
                    break;
            }
        }

    }
}
