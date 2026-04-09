{{-- Overlay --}}
<div id="createOverlay" onclick="closeCreateModal()"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9998;"></div>

{{-- Create Task Panel --}}
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