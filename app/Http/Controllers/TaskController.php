<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;


class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('tasks.index')->with('tasks', $tasks);
    }
    public function update($id){

    }
    public function store(Request $request){
        $task = new Task();
        $task->name = $request->name;
        $task->created_at = $request->created_at;
        $task->save();
        return redirect()->route('dashboard');
    }
    public function destroy($id){
        try{
            $task = Task::findOrFail($id);
            $task->delete();
            return redirect()->route('dashboard');
        }catch(\Exception $e){
            return redirect()->route('dashboard');
        }
    }
    public function create(){
        return view('tasks.create');
    }
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
