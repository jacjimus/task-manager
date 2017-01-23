<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
         $employees =   DB::table('users')->paginate(15);
        
        return view('grids.employees', compact('employees' , 'roles'));
    }
    
    public function data($id = null)
    {
     if ($id == null) {
            return User::orderBy('id', 'asc')->with('department' , 'role')->get();
        } else {
            return $this->show($id);
        }
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $employee = new User;

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        $employee->role_id = $request->input('role_id');
        $employee->dept = $request->input('dept');
        $employee->password = Hash::make(str_random(8));
        $employee->save();
        $request->session()->flash('alert-success', 'User was successful added!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $employee = User::find($id);

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        $employee->role_id = $request->input('role_id');
        $employee->dept = $request->input('dept');
        $employee->save();
        $request->session()->flash('alert-success', 'User was successful updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request , $id) {
        $employee = User::find($id);

        $employee->delete();

        $request->session()->flash('alert-success', 'User was successful removed!');
    
    }
} 

