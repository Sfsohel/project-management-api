<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->company_id;
        $departments = Department::where('company_id', $company_id)->select('id','name')->get();
        $designations = Designation::where('company_id', $company_id)->select('id', 'name')->get();
        $skills = Skill::where('company_id', $company_id)->select('id', 'name')->get();
        $users = User::with([
                'company'=>function($q){
                    $q->select('id','name');
                },
                'department' => function ($q) {
                    $q->select('id', 'name');
                }, 
                'designation' => function ($q) {
                    $q->select('id', 'name');
                }
            ])->get();
        return response()->json(["departments"=>$departments, "designations" =>$designations, "skills" => $skills,'resources'=>$users], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['skills']);
        $data['company_id'] = Auth::user()->company_id;
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
