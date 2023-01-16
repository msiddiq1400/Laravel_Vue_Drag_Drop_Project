<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTasks()
    {
        $tasks = Task::orderBy('order')->select('id','title','order','status')->get();
        $tasksCompleted = $tasks->filter(function ($task, $key) {
            return $task->status;
        })->values();
        $tasksNotCompleted = $tasks->filter(function ($task, $key) {
            return  ! $task->status;
        })->values();
        return view('demos.alltasks',compact('tasksCompleted','tasksNotCompleted'));
    }

    public function updateTasksStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|boolean',
        ]);
        $task = Task::find($id);
        $task->status = $request->status;
        $task->save();
        return response('Updated Successfully.', 200);
    }

    public function updateTasksOrder(Request $request)
    {
        $this->validate($request, [
            'tasks.*.order' => 'required|numeric',
        ]);
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $id = $task->id;
            foreach ($request->tasks as $tasksNew) {
                if ($tasksNew['id'] == $id) {
                    $task->update(['order' => $tasksNew['order']]);
                }
            }
        }
        return response('Updated Successfully.', 200);
    }
}