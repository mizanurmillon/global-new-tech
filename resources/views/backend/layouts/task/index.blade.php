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

                        {{-- Priority bar --}}
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
            {{ $tasks->withQueryString()->links() }}
        </div>
    @endif

</div>


{{-- ==================== OVERLAY ==================== --}}
<div id="taskOverlay" onclick="closeTaskPanel()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9998;"></div>


{{-- ==================== TASK DETAIL PANEL ==================== --}}
<div id="taskPanel" style="
    display:none;
    position:fixed;
    top:52%;left:50%;
    transform:translate(-50%,-50%) scale(0.96);
    width:92%;max-width:660px;max-height:80vh;
    background:#fff;z-index:9999;
    box-shadow:0 24px 80px rgba(0,0,0,0.18);
    overflow-y:auto;border-radius:16px;
    opacity:0;transition:transform 0.25s ease,opacity 0.25s ease;
">
    {{-- Header --}}
    <div style="padding:20px 24px 16px;border-bottom:1px solid #f0f0f0;position:sticky;top:0;background:#fff;z-index:2;border-radius:16px 16px 0 0;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;">
            <p style="margin:0 0 4px;font-size:12px;font-weight:600;color:#888;text-transform:uppercase;letter-spacing:.5px;">Task Details</p>
            <button onclick="closeTaskPanel()" style="background:none;border:none;font-size:18px;cursor:pointer;color:#999;line-height:1;padding:0;">✕</button>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:4px;">
            <div>
                <h4 id="tp-title" style="margin:0;font-weight:700;font-size:18px;color:#111;">—</h4>
                <small id="tp-type" style="color:#999;font-size:13px;">—</small>
            </div>
            <span id="tp-badge" class="task-badge">—</span>
        </div>
    </div>

    {{-- Body --}}
    <div style="padding:20px 24px;display:flex;flex-direction:column;gap:20px;">

        {{-- Priority & Due --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Priority</p>
                <p id="tp-priority" style="margin:0;font-size:14px;color:#222;font-weight:500;">—</p>
            </div>
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Due Date</p>
                <p id="tp-due" style="margin:0;font-size:14px;color:#222;">—</p>
            </div>
        </div>

        {{-- Assigned & Created --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Assigned To</p>
                <p id="tp-assigned" style="margin:0;font-size:14px;color:#222;font-weight:500;">—</p>
            </div>
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Created</p>
                <p id="tp-created" style="margin:0;font-size:14px;color:#222;">—</p>
            </div>
        </div>

        {{-- Pipeline Progress --}}
        <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <p style="font-size:11px;font-weight:600;color:#888;margin:0;text-transform:uppercase;letter-spacing:.4px;">Pipeline Progress</p>
                <span id="tp-status-label" style="font-size:13px;font-weight:700;color:#222;">—</span>
            </div>
            <div style="background:#e9ecef;border-radius:99px;height:10px;overflow:hidden;">
                <div id="tp-progress-bar" style="height:10px;border-radius:99px;width:0%;transition:width .5s ease;"></div>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:6px;">
                <small style="color:#ccc;font-size:10px;">Pending</small>
                <small style="color:#ccc;font-size:10px;">In Progress</small>
                <small style="color:#ccc;font-size:10px;">Review</small>
                <small style="color:#ccc;font-size:10px;">Done</small>
            </div>
        </div>

        {{-- Skills --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Required Skills / Tags</p>
            <div id="tp-skills" style="display:flex;flex-wrap:wrap;gap:6px;min-height:10px;"></div>
        </div>

        {{-- Description --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Description</p>
            <div id="tp-description" style="background:#f4f6f9;border-radius:8px;padding:12px 14px;font-size:14px;line-height:1.6;color:#444;min-height:44px;">—</div>
        </div>

        {{-- Status Update --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Update Status</p>
            <form id="tp-statusForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" style="width:100%;padding:10px 14px;border:1.5px solid #dee2e6;border-radius:8px;font-size:14px;background:#fff;color:#222;cursor:pointer;">
                    @foreach(['pending','in_progress','review','done'] as $s)
                        <option value="{{ $s }}">{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Assign To --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Assign To</p>
            <form id="tp-assignForm" method="POST" action="">
                @csrf
                <div style="display:flex;gap:8px;">
                    <select name="assigned_to" id="tp-assign-select" style="flex:1;padding:10px 14px;border:1.5px solid #dee2e6;border-radius:8px;font-size:14px;background:#fff;color:#222;">
                        <option value="">Select assignee</option>
                        @foreach($team_members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" style="padding:10px 18px;background:#111;color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;">
                        Assign
                    </button>
                </div>
            </form>
        </div>

        {{-- Internal Notes --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Internal Notes</p>
            <form id="tp-noteForm" method="POST" action="">
                @csrf
                <textarea id="tp-note-input" name="note" rows="3"
                    placeholder="Add internal notes..."
                    style="width:100%;padding:12px 14px;border:1.5px solid #dee2e6;border-radius:8px;font-size:14px;line-height:1.6;resize:vertical;font-family:inherit;color:#333;background:#fff;box-sizing:border-box;outline:none;"
                    onfocus="this.style.borderColor='#111'"
                    onblur="this.style.borderColor='#dee2e6'"></textarea>
                <div style="margin-top:8px;display:flex;align-items:center;gap:12px;">
                    <button type="submit" style="padding:9px 22px;background:#111;color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;">
                        Save Notes
                    </button>
                    <span id="tp-note-success" style="display:none;color:#16a34a;font-size:13px;font-weight:500;">✓ Saved!</span>
                </div>
            </form>
        </div>

    
    </div>
</div>


{{-- ==================== CREATE TASK MODAL ==================== --}}
<div id="createOverlay" onclick="closeCreateModal()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9998;"></div>

<div id="createPanel" style="
    display:none;
    position:fixed;
    top:52%;left:50%;
    transform:translate(-50%,-50%) scale(0.96);
    width:92%;max-width:620px;max-height:80vh;
    background:#fff;z-index:9999;
    box-shadow:0 24px 80px rgba(0,0,0,0.18);
    overflow-y:auto;border-radius:16px;
    opacity:0;transition:transform 0.25s ease,opacity 0.25s ease;
">
    {{-- Header --}}
    <div style="background:#f0f2f5;border-radius:16px 16px 0 0;padding:18px 24px;border-bottom:1px solid #e2e5ea;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:2;">
        <div style="display:flex;align-items:center;gap:10px;">
            <span style="font-size:18px;">🧳</span>
            <h5 style="margin:0;font-weight:700;font-size:15px;color:#111;">Create New Task</h5>
        </div>
        <button onclick="closeCreateModal()" style="background:none;border:none;font-size:18px;cursor:pointer;color:#999;line-height:1;padding:0;">✕</button>
    </div>

    {{-- Form --}}
    <div style="padding:24px;display:flex;flex-direction:column;gap:18px;">
        <form method="POST" action="{{ route('admin.tasks.store') }}" id="createTaskForm">
            @csrf

            {{-- Task Title --}}
            <div>
                <label style="font-size:13px;font-weight:600;color:#222;display:block;margin-bottom:8px;">
                    Task Title <span style="color:#ef4444;">*</span>
                </label>
                <input type="text" name="title" placeholder="Enter task title" required
                    style="width:100%;padding:10px 14px;border:1.5px solid #e2e5ea;border-radius:8px;font-size:14px;color:#222;background:#fff;box-sizing:border-box;outline:none;"
                    onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e2e5ea'">
            </div>

            {{-- Task Type --}}
            <div>
                <label style="font-size:13px;font-weight:600;color:#222;display:block;margin-bottom:8px;">Task Type</label>
                <select name="task_type"
                    style="width:100%;padding:10px 14px;border:1.5px solid #e2e5ea;border-radius:8px;font-size:14px;color:#222;background:#fff;box-sizing:border-box;outline:none;cursor:pointer;"
                    onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e2e5ea'">
                    <option value="general">General Task</option>
                    <option value="follow_up">Follow Up</option>
                    <option value="meeting">Meeting</option>
                    <option value="call">Call</option>
                    <option value="review">Review</option>
                    <option value="development">Development</option>
                </select>
            </div>

            {{-- Description --}}
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                    <label style="font-size:13px;font-weight:600;color:#222;">Description</label>
                    <span style="font-size:12px;color:#6b7280;">✦ AI Improve</span>
                </div>
                <textarea name="description" rows="4" placeholder="Describe the task in detail..."
                    style="width:100%;padding:10px 14px;border:1.5px solid #e2e5ea;border-radius:8px;font-size:14px;color:#222;background:#fff;box-sizing:border-box;resize:vertical;font-family:inherit;outline:none;"
                    onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e2e5ea'"></textarea>
            </div>

            {{-- Priority & Due Date --}}
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                    <label style="font-size:13px;font-weight:600;color:#222;">Priority & Due Date</label>
                    <span style="font-size:12px;color:#6b7280;">✦ AI Suggest</span>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                    <select name="priority"
                        style="padding:10px 14px;border:1.5px solid #e2e5ea;border-radius:8px;font-size:14px;color:#222;background:#fff;outline:none;cursor:pointer;"
                        onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e2e5ea'">
                        <option value="low">Low Priority</option>
                        <option value="medium" selected>Medium Priority</option>
                        <option value="high">High Priority</option>
                        <option value="urgent">Urgent</option>
                    </select>
                    <input type="date" name="due_date"
                        style="padding:10px 14px;border:1.5px solid #e2e5ea;border-radius:8px;font-size:14px;color:#222;background:#fff;outline:none;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e2e5ea'">
                </div>
            </div>

            {{-- Assign To --}}
            <div>
                <label style="font-size:13px;font-weight:600;color:#222;display:block;margin-bottom:8px;">Assign To</label>
                <select name="assigned_to"
                    style="width:100%;padding:10px 14px;border:1.5px solid #e2e5ea;border-radius:8px;font-size:14px;color:#222;background:#fff;outline:none;cursor:pointer;"
                    onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e2e5ea'">
                    <option value="">Auto-assign with AI</option>
                    @foreach($team_members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Required Skills / Tags --}}
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                    <label style="font-size:13px;font-weight:600;color:#222;">Required Skills / Tags</label>
                    <span style="font-size:12px;color:#6b7280;">✦ AI Suggest</span>
                </div>
                <div id="createTagsContainer" style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:8px;min-height:4px;"></div>
                <input type="hidden" name="skills" id="createSkillsHidden">
                <div style="display:flex;gap:8px;">
                    <input type="text" id="createSkillInput" placeholder="Add a required skill or tag"
                        style="flex:1;padding:10px 14px;border:1.5px solid #e2e5ea;border-radius:8px;font-size:14px;color:#222;background:#fff;outline:none;"
                        onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e2e5ea'">
                    <button type="button" onclick="addCreateSkill()"
                        style="padding:10px 16px;background:#111;color:#fff;border:none;border-radius:8px;font-size:18px;cursor:pointer;line-height:1;">+</button>
                </div>
                <small style="color:#aaa;font-size:11px;margin-top:4px;display:block;">Add skills to help AI auto-assign tasks to team members</small>
            </div>

            {{-- Internal Notes --}}
            <div>
                <label style="font-size:13px;font-weight:600;color:#222;display:block;margin-bottom:8px;">Internal Notes</label>
                <textarea name="note" rows="3" placeholder="Add internal notes (optional)..."
                    style="width:100%;padding:10px 14px;border:1.5px solid #e2e5ea;border-radius:8px;font-size:14px;color:#222;background:#fff;box-sizing:border-box;resize:vertical;font-family:inherit;outline:none;"
                    onfocus="this.style.borderColor='#111'" onblur="this.style.borderColor='#e2e5ea'"></textarea>
            </div>

            {{-- Buttons --}}
            <div style="display:flex;gap:10px;padding-top:4px;">
                <button type="submit"
                    style="flex:1;padding:11px;background:#111;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">
                    Create Task
                </button>
                <button type="button" onclick="closeCreateModal()"
                    style="flex:1;padding:11px;background:#fff;border:1.5px solid #e2e5ea;color:#444;border-radius:8px;font-size:14px;font-weight:500;cursor:pointer;">
                    Cancel
                </button>
            </div>

        </form>
    </div>
</div>


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


<script>
// ===== CREATE MODAL =====
let createSkills = [];

function openCreateModal() {
    document.getElementById('createOverlay').style.display = 'block';
    const panel = document.getElementById('createPanel');
    panel.style.display = 'block';
    setTimeout(() => {
        panel.style.opacity = '1';
        panel.style.transform = 'translate(-50%,-50%) scale(1)';
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeCreateModal() {
    const panel = document.getElementById('createPanel');
    panel.style.opacity = '0';
    panel.style.transform = 'translate(-50%,-50%) scale(0.96)';
    setTimeout(() => {
        panel.style.display = 'none';
        document.getElementById('createOverlay').style.display = 'none';
        document.body.style.overflow = '';
    }, 250);
}

function addCreateSkill() {
    const input = document.getElementById('createSkillInput');
    const val   = input.value.trim();
    if (!val || createSkills.includes(val)) { input.value = ''; return; }
    createSkills.push(val);
    input.value = '';
    renderCreateTags();
}

function removeCreateSkill(skill) {
    createSkills = createSkills.filter(s => s !== skill);
    renderCreateTags();
}

function renderCreateTags() {
    const container = document.getElementById('createTagsContainer');
    container.innerHTML = '';
    createSkills.forEach(skill => {
        const tag = document.createElement('span');
        tag.style.cssText = 'display:inline-flex;align-items:center;gap:5px;padding:4px 10px;background:#f0f2f5;border-radius:20px;font-size:12px;font-weight:500;color:#333;';
        tag.innerHTML = `${skill} <span onclick="removeCreateSkill('${skill}')" style="cursor:pointer;color:#999;font-size:14px;line-height:1;">&times;</span>`;
        container.appendChild(tag);
    });
    document.getElementById('createSkillsHidden').value = JSON.stringify(createSkills);
}


// ===== TASK DETAIL PANEL =====
function openTaskPanel(d) {
    document.getElementById('tp-title').textContent    = d.title;
    document.getElementById('tp-type').textContent     = d.type;
    document.getElementById('tp-priority').textContent = d.priorityLabel;
    document.getElementById('tp-due').textContent      = d.due;
    document.getElementById('tp-assigned').textContent = d.assigned;
    document.getElementById('tp-created').textContent  = d.created;

    // Badge
    const badge       = document.getElementById('tp-badge');
    badge.textContent = d.statusLabel;
    badge.className   = 'task-badge badge-' + d.status;

    // Progress
    const statusProgress = {
        'pending':     { percent: 15,  color: '#3b82f6' },
        'in_progress': { percent: 50,  color: '#f59e0b' },
        'review':      { percent: 75,  color: '#8b5cf6' },
        'done':        { percent: 100, color: '#16a34a' },
    };
    const progress = statusProgress[d.status] || { percent: 0, color: '#ccc' };
    document.getElementById('tp-status-label').textContent = d.statusLabel;
    const bar = document.getElementById('tp-progress-bar');
    bar.style.width      = progress.percent + '%';
    bar.style.background = progress.color;

    // Skills
    const skillsContainer = document.getElementById('tp-skills');
    skillsContainer.innerHTML = '';
    if (d.skills && d.skills.trim()) {
        d.skills.split(',').forEach(skill => {
            skill = skill.trim();
            if (!skill) return;
            const tag = document.createElement('span');
            tag.style.cssText = 'display:inline-flex;align-items:center;padding:3px 10px;background:#f0f2f5;border-radius:20px;font-size:12px;font-weight:500;color:#444;';
            tag.textContent = skill;
            skillsContainer.appendChild(tag);
        });
    } else {
        skillsContainer.innerHTML = '<span style="color:#ccc;font-size:13px;">No skills added</span>';
    }

    // Description
    document.getElementById('tp-description').textContent = d.description || 'No description provided.';

    // Note
    document.getElementById('tp-note-input').value = d.note || '';
    document.getElementById('tp-note-success').style.display = 'none';

    // Status form
    document.getElementById('tp-statusForm').action = '/admin/tasks/' + d.id + '/status';
    const statusSel = document.getElementById('tp-statusForm').querySelector('select');
    for (let opt of statusSel.options) {
        opt.selected = (opt.value === d.status);
    }

    // Assign form
    document.getElementById('tp-assignForm').action = d.assignUrl;
    const sel = document.getElementById('tp-assign-select');
    for (let opt of sel.options) {
        opt.selected = (opt.value === d.assignedId);
    }

    // Note form
    document.getElementById('tp-noteForm').action = d.noteUrl;

    // Show
    document.getElementById('taskOverlay').style.display = 'block';
    const panel = document.getElementById('taskPanel');
    panel.style.display = 'block';
    setTimeout(() => {
        panel.style.opacity = '1';
        panel.style.transform = 'translate(-50%,-50%) scale(1)';
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeTaskPanel() {
    const panel = document.getElementById('taskPanel');
    panel.style.opacity = '0';
    panel.style.transform = 'translate(-50%,-50%) scale(0.96)';
    setTimeout(() => {
        panel.style.display = 'none';
        document.getElementById('taskOverlay').style.display = 'none';
        document.body.style.overflow = '';
    }, 250);
}


// ===== INIT =====
document.addEventListener('DOMContentLoaded', function () {

    // Task card click → detail panel
    document.querySelectorAll('.task-card').forEach(function (card) {
        card.addEventListener('click', function () {
            openTaskPanel(card.dataset);
        });
    });

    // Enter key for skill input
    document.getElementById('createSkillInput').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') { e.preventDefault(); addCreateSkill(); }
    });

    // Note AJAX save
    document.getElementById('tp-noteForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const form    = this;
        const success = document.getElementById('tp-note-success');
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: new FormData(form)
        })
        .then(res => res.json())
        .then(() => {
            success.style.display = 'inline';
            setTimeout(() => { success.style.display = 'none'; }, 3000);
        })
        .catch(() => alert('Failed to save note.'));
    });

    // ESC to close
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeTaskPanel();
            closeCreateModal();
        }
    });

});
</script>

@endsection