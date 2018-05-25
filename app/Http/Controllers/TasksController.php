<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; 

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function show($id)
    {
        $task = Task::find($id);
       // var_dump($task);
        return view('tasks.show', [
            'task' => $task,
        ]);
        
    }
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:10',
        ]);

        $task = new Task;
        $task->title = $request->status; 
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }
    public function update(Request $request, $id)
    {
        'status' => 'required|max:10',   // 追加
        'content' => 'required|max:10',

        $task = Task::find($id);
        $task-status = $request->status; 
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }
     public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/');
    }




}