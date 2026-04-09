<?php
namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query()
            ->where(function ($q) {
                $q->where('user_id', auth()->id())
                    ->orWhere('assigned_to', auth()->id());
            })
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->priority, fn($q) => $q->where('priority', $request->priority))
            ->when($request->assigned_to, fn($q) => $q->where('assigned_to', $request->assigned_to));

        $stats = [
            'total'     => (clone $query)->count(),
            'completed' => (clone $query)->where('status', 'done')->count(),
            'overdue'   => (clone $query)->where('due_date', '<', today())->where('status', '!=', 'done')->count(),
            'due_today' => (clone $query)->whereDate('due_date', today())->count(),
        ];

        $tasks = $query->latest()->paginate(9);

        $team_members = User::where('role', 'team')->get();

        return view('backend.layouts.tasks.index', compact('tasks', 'stats', 'team_members'));
    }
    // TaskController.php
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'description' => $request->description,
            'task_type'   => $request->task_type ?? 'general',
            'priority'    => $request->priority ?? 'medium',
            'due_date'    => $request->due_date,
            'assigned_to' => $request->assigned_to,
            'skills'      => $request->skills ? json_decode($request->skills) : null,
            'note'        => $request->note,
            'status'      => 'pending',
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully!');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $task->update(['status' => $request->status]);
        return back();
    }

    public function assign(Request $request, Task $task)
    {
        $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if (auth()->user()->role != 'admin' && $task->user_id != auth()->id()) {
            return back()->with('error', 'you can not assign this task');
        }

        $task->update([
            'assigned_to' => $request->assigned_to ?: null,
        ]);

        return back()->with('success', 'Task assigned successfully.');
    }

}
