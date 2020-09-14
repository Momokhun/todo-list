<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    public function index() {
        $tasks = Task::latest()->get();
        return view('tasks.index', ['tasks'=> $tasks]);
    }



    public function store(Request $request) {
        $task = new Task;
        $task->name = $request->task_name;
        $task->save();

        $validator = Validator::make($request->all(), [
            'task_name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')->withInput()->withErrors($validator);
        }

       
        return redirect('/');
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect('/');
    }
}
