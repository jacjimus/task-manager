<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
         $employees =   DB::table('users')->paginate(15);
        return view('grids.employees', ['employees' => $employees]);
    }
    
    public function create()
    {
        $departments = \App\Departments::orderBy('name', 'asc')->get();

        
        return view('forms.employee', compact('employees', 'departments'));
    }
    
    public function delete(Request $request, $encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        if (User::destroy($id)) {
            $request->session()->flash('employee', Utility::renderSuccess("Employee deleted successfully"));
        } else {
            $request->session()->flash('employee', Utility::renderError("Employee not deleted"));
        }
        return redirect('/employees');
    }
}
