<?php

namespace App\Http\Controllers;


use App\Models\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    // method to save timers
    public function store(Request $request)
    {
        $request->validate([
            'WorkTime' => 'required|integer',
            'BreakTime' => 'required|integer',
        ]);

        // Saves the timer in the database for the currently logged in user
        Timer::create([
            'user_id' => Auth::id(),
            'WorkTime' => $request->WorkTime,
            'BreakTime' => $request->BreakTime,
            'remaining_work_time' => $request->WorkTime,
            'remaining_break_time' => $request->BreakTime,
        ]);

        return response()->json(['message' => 'Timers saved successfully']);
    }


    // Method to get the latest timers

    public function getLatestTimers()
    {
        $timer = Timer::where('user_id', auth()->id())->latest()->first(); // Downloads the latest timer for the currently logged in user

        if ($timer) {
            return response()->json([
                'WorkTime' => $timer->WorkTime,
                'BreakTime' => $timer->BreakTime,
            ]);
        }

        return response()->json(['WorkTime' => null, 'BreakTime' => null]);
    }
}
