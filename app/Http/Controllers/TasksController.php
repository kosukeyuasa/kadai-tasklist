<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; 

use App\Http\Requests;

use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    public function index()
    {
         $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return view('welcome');
}
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
            'status' => 'required|max:10',   
            'content' => 'required|max:191',
        ]);

        $task = new Task;
        $task->user_id = \Auth::user()->id;
        $task->status = $request->status; 
        $task->content = $request->content;
        $task->save();
        $request->user()->tasks()->create([
            'content' => $request->content,
        ]);


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
    {    $this->validate($request, [
        'status' => 'required|max:10',   
        'content' => 'required|max:191',]);

        $task = Task::find($id);
        $task->status = $request->status; 
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }
     public function destroy($id)
    {
        $task = Task::find($id);
        if (\Auth::user()->id === $task->user_id) {
        $task->delete();
}
        return redirect()->back();
    }




}