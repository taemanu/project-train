<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $emp = User::all();
        $roles = Roles::all();
        $count = array();

        $count = [
            $count1 = User::where('roles_id', 2)->where('status', 1)->count(),
            $count2 = User::where('roles_id', 3)->where('status', 1)->count(),
            $count3 = User::where('roles_id', 4)->where('status', 1)->count(),
        ];

        // dd($count);

        return view('admin.employee', compact('emp', 'roles', 'count'));
    }

    public function update_employee(Request $request, $id)
    {
        User::find($id)->update([
            'status' => $request->Status,
            'roles_id' => $request->Roles,
        ]);

        // dd($request->Roles, $request->Status);

        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }

}
