<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
class RolesController extends Controller
{
    public function data($id = null)
    {
     return Roles::orderBy('name', 'asc')->get();
        
    }
}
