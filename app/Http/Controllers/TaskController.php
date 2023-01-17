<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTasks()
    {
        return Task::orderBy('priority')->select('id','name','priority')->get();
    }

    public function updateTasksOrder(Request $request)
    {
        $data = $request->all();

        //get both tasks with priority
        $task1 = Task::where('priority', $data['newIndex'])->first();
        $task2 = Task::where('priority', $data['prevIndex'])->first();


        //swap the priorities
        $temp = $task1->priority;

        $task1->priority = $task2->priority;
        $task1->save();

        $task2->priority = $temp;
        $task2->save();

        //return all the updated tasks
        return Task::orderBy('priority')->select('id','name','priority')->get();
    }

    public function updateName(Request $request) {
        $data = $request->all();

        //update task
        $task = Task::find($data['id']);
        $task->name = $data['name'];
        $task->save();

        //return all the updated tasks
        return Task::orderBy('priority')->select('id','name','priority')->get();
    }

    public function deleteTask(Request $request) {
        $data = $request->all();

        //update task
        Task::find($data['id'])->delete();

        //return all the updated tasks
        return Task::orderBy('priority')->select('id','name','priority')->get();
    }
}