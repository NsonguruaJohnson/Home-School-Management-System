<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function create(){
        return view('auth.register');
    }

    public function store(Request $request, User $user){
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => ['required', 'email','unique:users,email'],
            'password' => 'required|confirmed|min:5',
            'agree' => 'required'
        ], [
            'agree.required' => 'Agree to the privacy policy'
        ]);

        $student = Role::where('name', 'Student')->first();
        // dd($student);
        // Add student to the users db
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $student->id;
        $user->save();

        auth()->attempt($request->only('username', 'password'));

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
