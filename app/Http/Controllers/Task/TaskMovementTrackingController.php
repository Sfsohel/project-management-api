<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\TaskMovementTracking;
use Illuminate\Http\Request;

class TaskMovementTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data =  $request->all();
        $trackings= TaskMovementTracking::where('user_id',$data['user_id'])->where('task_id',$data['task_id'])->where('task_movement_id',$data['task_movement_id'])->get();
        return response()->json($trackings, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function startTime(Request $request)
    {
        // return "good";
        $data = $request->all();
        $create = TaskMovementTracking::create($data);
        return $create;
    }
    public function endTime(Request $request)
    {
        // return "good";
        $data = $request->all();
        $create = TaskMovementTracking::where('id',$data['id'])->update(["end_time"=>$data['end_time']]);
        return "updated";
    }
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
