<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\Task;
use App\Models\Task\TaskMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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

    public function index(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $tasks = Task::with([
            'task_movement'=>function($q){
                $q->select('id','task_id');
            }
            ])->where('company_id', $company_id)->where('page_id',$request->page_id)->get();
        return response()->json($tasks, 200);
    }
    public function publish($id)
    {
        $company_id = Auth::user()->company_id;
        $tasks = Task::where('company_id', $company_id)->where('id',$id)->update(['is_draft'=>1]);
        return response()->json($tasks, 200);
    }
    public function assignUser(Request $request)
    {
        $data = $request->all();
        $company_id = Auth::user()->company_id;
        $data['company_id'] = $company_id;
        $task_movement = TaskMovement::create($data);
        return response()->json($task_movement, 200);
        return $request->all();

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
                $file->move(public_path() . '/task_files/', $name);
                $attachment[] = $name;
            }
        }
        $data['attachment'] = serialize($attachment);
        $data['company_id'] = Auth::user()->company_id;
        $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d H:i:s');
        $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d H:i:s');
        $task = Task::create($data);
        return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id',$id)->first();
        return $task;
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
