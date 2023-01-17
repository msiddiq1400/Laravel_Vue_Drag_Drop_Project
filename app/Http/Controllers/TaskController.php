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

        return Task::orderBy('priority')->select('id','name','priority')->get();
    }
}