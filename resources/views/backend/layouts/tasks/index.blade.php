@extends('backend.layouts.app')
@section('title', 'Task Management')

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <div class="d-flex align-items-center justify-content-between mb-2">
        <div>
            <h4 class="fw-bold mb-1">Task Management</h4>
            <p class="text-muted small mb-0">Track and manage your team's tasks and activities</p>
        </div>
        <button onclick="openCreateModal()" class="btn btn-primary btn-sm px-3">
            + Add Task
        </button>
    </div>

    {{-- Search & Filters --}}
    <form method="GET" action="{{ route('admin.tasks.index') }}" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search"
                        class="form-control border-start-0 ps-0"
                        placeholder="Search tasks..."
                        value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    @foreach(['pending','in_progress','review','done'] as $s)
                        <option value="{{ $s }}" @selected(request('status') == $s)>
                            {{ ucfirst(str_replace('_', ' ', $s)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="priority" class="form-select form-select-sm">
                    <option value="">All Priority</option>
                    <option value="low"    @selected(request('priority') == 'low')>Low</option>
                    <option value="medium" @selected(request('priority') == 'medium')>Medium</option>
                    <option value="high"   @selected(request('priority') == 'high')>High</option>
                    <option value="urgent" @selected(request('priority') == 'urgent')>Urgent</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="assigned_to" class="form-select form-select-sm">
                    <option value="">All Assignees</option>
                    @foreach($team_members as $member)
                        <option value="{{ $member->id }}" @selected(request('assigned_to') == $member->id)>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-sm btn-outline-secondary w-100">Filter</button>
            </div>
        </div>
    </form>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Tasks</p>
                        <h3 class="fw-bold mb-0">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="text-primary fs-4"><i class="bi bi-list-task"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Completed</p>
                        <h3 class="fw-bold mb-0">{{ $stats['completed'] }}</h3>
                    </div>
                    <div class="text-success fs-4"><i class="bi bi-check-circle"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Overdue</p>
                        <h3 class="fw-bold mb-0">{{ $stats['overdue'] }}</h3>
                    </div>
                    <div class="text-danger fs-4"><i class="bi bi-exclamation-circle"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Due Today</p>
                        <h3 class="fw-bold mb-0">{{ $stats['due_today'] }}</h3>
                    </div>
                    <div class="text-warning fs-4"><i class="bi bi-clock"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Task Cards --}}
    @if($tasks->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            No tasks found.
        </div>
    @else
        <div class="row g-3">
            @foreach($tasks as $task)
            <div class="col-md-4">
                <div class="card border shadow-sm h-100 task-card" style="cursor:pointer;border-radius:12px;"
                     data-id="{{ $task->id }}"
                     data-title="{{ $task->title }}"
                     data-type="{{ ucfirst(str_replace('_',' ',$task->task_type ?? 'general')) }}"
                     data-description="{{ $task->description ?? '' }}"
                     data-priority="{{ $task->priority }}"
                     data-priority-label="{{ ucfirst($task->priority) }}"
                     data-status="{{ $task->status }}"
                     data-status-label="{{ ucfirst(str_replace('_',' ',$task->status)) }}"
                     data-due="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M j, Y') : '—' }}"
                     data-assigned="{{ $task->assignedTo->name ?? '—' }}"
                     data-assigned-id="{{ $task->assigned_to ?? '' }}"
                     data-skills="{{ is_array($task->skills) ? implode(', ', $task->skills) : ($task->skills ?? '') }}"
                     data-note="{{ $task->note ?? '' }}"
                     data-created="{{ $task->created_at->format('M j, Y') }}"
                     data-note-url="{{ route('admin.tasks.note', $task->id) }}"
                     data-assign-url="{{ route('admin.tasks.assign', $task->id) }}">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-semibold mb-0" style="font-size:14px;max-width:200px;line-height:1.4;">
                                {{ $task->title }}
                            </h6>
                            <span class="task-badge badge-{{ $task->status }}">
                                {{ ucfirst(str_replace('_',' ',$task->status)) }}
                            </span>
                        </div>

                        @if($task->description)
                            <p class="text-muted small mb-2" style="line-height:1.5;">
                                {{ Str::limit($task->description, 80) }}
                            </p>
                        @endif

                        <div class="mb-1">
                            <div class="progress" style="height:4px;border-radius:2px;">
                                <div class="progress-bar
                                    {{ $task->priority == 'urgent' ? 'bg-danger' : ($task->priority == 'high' ? 'bg-warning' : ($task->priority == 'medium' ? 'bg-info' : 'bg-success')) }}"
                                    style="width:{{ $task->priority == 'urgent' ? 100 : ($task->priority == 'high' ? 75 : ($task->priority == 'medium' ? 50 : 25)) }}%">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <small class="text-muted">{{ ucfirst($task->priority) }} Priority</small>
                        </div>

                        <ul class="list-unstyled mb-2 small text-muted">
                            @if($task->assignedTo)
                            <li class="d-flex align-items-center gap-1 mb-1">
                                <i class="bi bi-person" style="font-size:12px"></i>
                                <span>{{ $task->assignedTo->name }}</span>
                            </li>
                            @endif
                            @if($task->due_date)
                            <li class="d-flex align-items-center gap-1">
                                <i class="bi bi-calendar3" style="font-size:12px"></i>
                                <span>Due {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}</span>
                            </li>
                            @endif
                        </ul>

                        <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                            <small class="text-muted">Created {{ $task->created_at->format('M j, Y') }}</small>
                            <span style="font-size:11px;color:#888;">{{ ucfirst(str_replace('_',' ',$task->task_type ?? 'general')) }}</span>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
    <small class="text-muted">
        Showing {{ $tasks->firstItem() }}–{{ $tasks->lastItem() }} of {{ $tasks->total() }} tasks
    </small>
    <div>
        {{ $tasks->withQueryString()->links() }}
    </div>
</div>
    @endif

</div>

{{-- Partials --}}
@include('backend.layouts.tasks.partials._task_detail_panel')
@include('backend.layouts.tasks.partials._task_create_panel')

<style>
.task-card {
    transition: box-shadow 0.2s, transform 0.2s;
    border-radius: 12px !important;
}
.task-card:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,0.10) !important;
    transform: translateY(-2px);
}
.task-badge {
    font-size: 10px; font-weight: 600;
    padding: 3px 10px; border-radius: 20px;
    white-space: nowrap; letter-spacing: 0.3px;
}
.badge-pending      { background:#E8F4FD; color:#1565C0; }
.badge-in_progress  { background:#FFF8E1; color:#F57F17; }
.badge-review       { background:#F3E5F5; color:#6A1B9A; }
.badge-done         { background:#E0F2F1; color:#004D40; }

#taskPanel::-webkit-scrollbar,
#createPanel::-webkit-scrollbar { width: 5px; }
#taskPanel::-webkit-scrollbar-track,
#createPanel::-webkit-scrollbar-track { background: transparent; }
#taskPanel::-webkit-scrollbar-thumb,
#createPanel::-webkit-scrollbar-thumb { background: #ddd; border-radius: 99px; }
</style>

@include('backend.layouts.tasks.partials._task_scripts')

@endsection