<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskUpdated;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (Auth::user()->is_role == 0) {

            $query = Task::with('project', 'assignedUser')->where('assigned_user_id', $user->id);
        } else {
            $query = Task::with('project', 'assignedUser');
        }

        if ($request->has('assigned_user_id') && $request->assigned_user_id != '') {
            $query->where('assigned_user_id', $request->assigned_user_id);
        }

        $tasks = $query->paginate(10);

        $assigned = User::all(); // Récupérer tous les utilisateurs
        // dd($tasks);
        return view('tasks.index', compact('tasks', 'assigned'));
    }

    public function create()
    {
        $projects = Project::all();
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('tasks.create', compact('projects', 'users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string|in:pending,in_progress,completed',
            'project_id' => 'required|exists:projects,id',
            'assigned_user_id' => 'required|exists:users,id',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $user = Auth::user();
        if ($user->id !== $task->assigned_user_id    && (!$user->is_role == 1 || !$user->is_role == 2)) {
            return redirect()->route('tasks.my_tasks')->with('error', 'Vous n\'êtes pas autorisé à modifier cette tâche.');
        }

        $projects = Project::all();
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $user = Auth::user();
        if ($user->id !== $task->assigned_user_id && !$user->is_role == 1 && !$user->is_role == 2) {
            return redirect()->route('tasks.my_tasks')->with('error', 'Vous n\'êtes pas autorisé à modifier cette tâche.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:pending,in_progress,completed',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'project_id' => 'required|integer|exists:projects,id',
            'assigned_user_id' => 'required|exists:users,id',
        ]);

        $task->update($request->all());

        // Trouver le manager
        $manager = User::where('is_role', 1)->first(); // Assurez-vous que 1 est le rôle de manager

        // Envoyer la notification au manager
        if ($manager) {
            $manager->notify(new TaskUpdated($task));
        }

        if (Auth::user()->is_role == 1 || Auth::user()->is_role == 2) {
            return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès');
        }

        return redirect()->route('tasks.my_tasks')->with('success', 'Tâche mise à jour avec succès');
    }

    public function destroy(Task $task)
    {

        // 'Tâche supprimée avec succès'
        $task->delete();
        if (Auth::user()->is_role == 1 || Auth::user()->is_role == 2) {
            return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès');
        }
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès');
    }

    public function myTasks()
    {
        $user = Auth::user();
        $tasks = Task::with('project', 'assignedUser')->where('assigned_user_id', $user->id)->get();
        return view('tasks.myTasks', compact('tasks'));
    }
    // TaskController.php

    public function showReportForm(Task $task)
    {
        // Vérifie si l'utilisateur est autorisé à voir ce formulaire (par exemple, vérifie les permissions)

        return view('tasks.report', compact('task'));
    }

    public function submitReport(Request $request, Task $task)
    {
        // Validation des données du formulaire de rapport
        $request->validate([
            'report_content' => 'required|string',
        ]);

        // Enregistrement du rapport dans la base de données ou autre traitement
        $task->reports()->create([
            'content' => $request->report_content,
            'user_id' => auth()->id(),
        ]);

        // Envoyer une notification au manager ou autre logique métier

        // Redirection vers une page de confirmation ou une autre vue
        return redirect()->route('tasks.index')->with('success', 'Rapport soumis avec succès.');
    }
}
