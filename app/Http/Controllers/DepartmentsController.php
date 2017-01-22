<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
class DepartmentsController extends Controller
{
    public function data($id = null)
    {
     return Departments::orderBy('name', 'asc')->get();
        
    }
}
