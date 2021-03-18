<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\TeacherRepository;

class TeacherController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository){
        $this->middleware('auth');
        $this->teacherRepository = $teacherRepository;
    }

    public function index(){
        return view('teacher.dashboard');
    }
}
