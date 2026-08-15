<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentControlle extends Controller
{
    public function index(){
        return view('dashboard.student.student');
    }
}
