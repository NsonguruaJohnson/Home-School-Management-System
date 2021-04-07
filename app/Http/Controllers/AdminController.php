<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Course;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\AdminRepository;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository){
        $this->middleware('auth');
        $this->adminRepository = $adminRepository;
    }

    public function index(){
        $courses = Course::get();
        $teachers = User::where('role_id', 2)->with('course')->get();
        $students = User::where('role_id', 3)->latest()->get();
        $roles = Role::get();
        $activities = Activity::get();
        // dd($teachers);
        // dd(User::where('role_id', 2)->get());
        return view('admin.dashboard', [
            'courses' => $courses,
            'teachers' => $teachers,
            'students' => $students,
            'roles' => $roles,
            'activities' => $activities
        ]);
    }

    public function addTeacher(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => ['required', 'email','unique:users,email'],
            'password' => 'required|confirmed|min:5',
        ]);

        $teacher = Role::where('name', 'Teacher')->first();
        // Add the teacher to the users db
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $teacher->id;
        $user->save();

        return back()->with('msg', 'Teacher Added Successfully');
    }

    public function deleteTeacher(User $user){
        $user->delete();

        return back()->with('msg', 'Teacher deleted');
    }

    public function updateTeacher(Request $request, User $user){
        // dd($user);

        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => ['required', 'email','unique:users,email'],
            'password' => 'confirmed|min:5',
        ]);

        $teacher = Role::where('name', 'Teacher')->first();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $teacher->id;
        $user->update();

        return back()->with('msg', 'Teacher details updated');

    }

    public function addRole(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        return back();
    }

    public function deleteRole(Role $role){
        $role->delete();

        return back();
    }
}
