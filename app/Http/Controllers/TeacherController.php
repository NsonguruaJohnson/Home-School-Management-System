<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Activity;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Http\Repositories\TeacherRepository;

class TeacherController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository){
        $this->middleware('auth');
        $this->teacherRepository = $teacherRepository;
    }

    public function index(){
        $courses = Course::get();
        $students = User::where('role_id', 3)->latest()->get();
        $activities = Activity::get();
        return view('teacher.dashboard', [
            'courses' => $courses,
            'students' => $students,
            'activities' => $activities
        ]);
    }

    public function show(){
        $students = User::where('role_id', 3)->latest()->get(); #add where the student registers for the course the teacher is handling
        $activities = Activity::get();
        // $activities = Activity::where('user_id', auth()->user);

        return view('teacher.mystudents', [
            'students' => $students,
            'activities' => $activities
        ]);
    }

    public function addCourse(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        // Add the course to the course db
        auth()->user()->course()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->with('msg', 'Course Added Successfully');

    }

    public function updateCourse(Request $request, Course $course){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        // Update course in course db
        auth()->user()->course()->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->with('msg', 'Course Updated');
    }

    public function deleteCourse(Course $course){
        $course->delete();

        return back()->with('msg', 'Course deleted');
    }

    public function addActivity(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        // Add activity to activity db through a course
        auth()->user()->course()->activity()->create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return back();
    }

    public function deleteActivity(Activity $activity){
        $activity->delete();

        return back();
    }
}
