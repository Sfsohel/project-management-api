<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        $comments = Comment::with([
            'user'=>function($q){
                $q->select('id','f_name','l_name');
            }
        ])->where('task_id',$request->task_id)->get();
        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $data = $request->all();
        if ($request->hasfile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $name = time().$file->getClientOriginalName();
                $file->move(public_path() . '/comment_files/', $name);
                $attachment[] = $name;
            }
        }
        $data['attachment'] = serialize($attachment);
        $company_id = Auth::user()->company_id;
        $data['company_id'] = $company_id;
        $comment = Comment::create($data);
        return response()->json($comment, 200);
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
        $data = $request->all();
        $comment = Comment::where('id', $id)->update($data);
        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->delete();
        return response()->json($comment, 200);
    }
}
