<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Module;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
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
        $projects = Project::where('company_id', $company_id)->select('id','name')->get();
        $modules = Module::with(['project'=>function($q){
            $q->select('id','name');
        }])->where('company_id', $company_id)->get();
        return response()->json(["projects"=>$projects,'modules'=>$modules] , 200);
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
        $company_id = Auth::user()->company_id;
        $data['company_id'] = $company_id;
        $module = Module::create($data);
        return response()->json($module, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company_id = Auth::user()->company_id;
        $modules = Module::where('company_id', $company_id)->where('project_id',$id)->get();
        return response()->json($modules, 200);
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
        $module = Module::where('id', $id)->update($data);
        return response()->json($module, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Module::where('id', $id)->delete();
        return response()->json($module, 200);
    }
}
