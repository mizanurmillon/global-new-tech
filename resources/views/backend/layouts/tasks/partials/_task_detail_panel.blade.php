{{-- Overlay --}}
<div id="taskOverlay" onclick="closeTaskPanel()"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9998;"></div>

{{-- Task Detail Panel --}}
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