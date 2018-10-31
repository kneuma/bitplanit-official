<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Task;
use App\User;
use Auth;
use DB;

class TaskController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return response(Task::latest()->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required',
            'finished' => 'required|boolean'
        ]);

        $data['user_id'] = Auth::user()->id();
        dd($data);
        $task = Task::create($data);

        return response($task, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response($task, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'text' => 'required',
            'finished' => 'required|boolean',
        ]);

        $task->update($data);

        return response($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response('Deleted Succesfully', 200);
    }
}
