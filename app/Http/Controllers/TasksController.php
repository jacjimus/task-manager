<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
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

        return 'Employee record successfully created with id ' . $employee->id;
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

        return "Sucess updating user #" . $employee->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $employee = User::find($request->input('id'));

        $employee->delete();

        return "Employee record successfully deleted #" . $request->input('id');
    }
} 

