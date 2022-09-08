<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['create', 'edit']]);
    }

    public function index()
    {
        $company_id = Auth::user()->company_id;
        $projects = Project::with([
            'user' => function($q){
                $q->with(['skill']);
            }
            ])->where('company_id', $company_id)->get();
        $users = User::where('company_id', $company_id)->get();
        return response()->json(["projects"=>$projects,'users'=>$users], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with([
            'user' => function($q){
                $q->with(['skill']);
            }
            ])->where('id', $id)->first();
        return $project;
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
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $project = Project::where('id',$id)->first();
        $users = [];
        foreach ($request->users as $key => $user) {
            array_push($users,$user['id']);
        }
        $project->user()->sync($users);
        return $project;
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
