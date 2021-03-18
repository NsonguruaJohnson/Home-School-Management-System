<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\StudentRepository;

class StudentController extends Controller
{
    // protected $studentRepository;

    public function __construct(StudentRepository $studentRepository){
        $this->middleware('auth');
        $this->studentRepository = $studentRepository;
    }

    public function index(){
        return view('student.dashboard');
    }
}
