<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskController;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->is_role == 2) {
                $this->adminDashboard();
            } elseif (Auth::user()->is_role == 1) {
                $this->managerDashboard();
            } elseif (Auth::user()->is_role == 0) {
                $this->userDashboard();
            }
        }
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function managerDashboard()
    {
        return view('manager.dashboard');
    }

    public function userDashboard()


    {
        $user = auth()->user();

        $tasksPending = $user->tasks()->where('status', 'pending')->count();
        $tasksInProgress = $user->tasks()->where('status', 'in_progress')->count();
        $tasksCompleted = $user->tasks()->where('status', 'completed')->count();
        $tasksAlert = $user->tasks()->where('end_date', '<=', now()->addDays(3))->where('status', '!=', 'completed')->get();

        return view('user.dashboard', compact('tasksPending', 'tasksInProgress', 'tasksCompleted', 'tasksAlert'));
    }
}
