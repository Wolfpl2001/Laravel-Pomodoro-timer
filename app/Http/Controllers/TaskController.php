<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;


class TaskController extends Controller
{

    // Method to get all tasks
    public function index(){
        $auth_user_id = auth()->id();
        $tasks = Task::all()->where('user_id', $auth_user_id);
        return view('tasks.index')->with('tasks', $tasks);
    }
    public function update($id){

    }

    // Method to store a new task
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'created_at' => 'required|date'

        ]);
        $task = new Task();
        $task->name = $request->name;
        $task->status = 0;
        $task->user_id = auth()->id();
        $task->created_at = $request->created_at;
        $task->save();
        return redirect()->route('dashboard');
    }
    // Method to delete a task
    public function destroy($id){
        try{
            $task = Task::findOrFail($id);
            $task->delete();
            return redirect()->route('dashboard');
        }catch(\Exception $e){
            return redirect()->route('dashboard');
        }
    }
    // Method to create a new task
    public function create(){
        return view('tasks.create');
    }
    // Method to save the status of the checkbox
    public function saveCheckbox(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->status = $request->status;
            $task->save();
    
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
            }
            

    }
    
}
