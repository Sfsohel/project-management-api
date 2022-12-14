<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
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
        $projects = Project::where('company_id', $company_id)->get();
        return response()->json($projects, 200);
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
        $attachment = [];
        if ($request->hasfile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $name = time().$file->getClientOriginalName();
                $file->move(public_path() . '/project_files/', $name);
                $attachment[] = $name;
            }
        }
        $data['attachment'] = serialize($attachment);
        $data['company_id'] = Auth::user()->company_id;
        $project = Project::create($data);
        return $project;
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
