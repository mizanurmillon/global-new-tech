{{-- Overlay --}}
<div id="leadOverlay" onclick="closeLeadPanel()" style="
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.5);
    z-index:9998;
"></div>

{{-- Lead Detail Panel --}}
<div id="leadPanel" style="
    display:none;
    position:fixed;
    top:52%;
    left:50%;
    transform:translate(-50%, -50%) scale(0.96);
    width:92%;
    max-width:660px;
    max-height:80vh;
    background:#fff;
    z-index:9999;
    box-shadow:0 24px 80px rgba(0,0,0,0.18);
    overflow-y:auto;
    border-radius:16px;
    opacity:0;
    transition:transform 0.25s ease, opacity 0.25s ease;
">
    {{-- Header --}}
    <div style="padding:20px 24px 16px;border-bottom:1px solid #f0f0f0;position:sticky;top:0;background:#fff;z-index:2;border-radius:16px 16px 0 0;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;">
            <p style="margin:0 0 4px;font-size:12px;font-weight:600;color:#888;text-transform:uppercase;letter-spacing:.5px;">Lead Details</p>
            <button onclick="closeLeadPanel()" style="background:none;border:none;font-size:18px;cursor:pointer;color:#999;line-height:1;padding:0;margin-top:-2px;">✕</button>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:4px;">
            <div>
                <h4 id="p-name" style="margin:0;font-weight:700;font-size:20px;color:#111;">—</h4>
                <small id="p-company" style="color:#999;font-size:13px;">—</small>
            </div>
            <span id="p-badge" class="lead-badge">—</span>
        </div>
    </div>

    {{-- Body --}}
    <div style="padding:20px 24px;display:flex;flex-direction:column;gap:20px;">

        {{-- Email & Phone --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Email</p>
                <p id="p-email" style="margin:0;font-size:14px;color:#222;word-break:break-all;">—</p>
            </div>
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Phone</p>
                <p id="p-phone" style="margin:0;font-size:14px;color:#222;">—</p>
            </div>
        </div>

        {{-- Pipeline Progress --}}
        <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <p style="font-size:11px;font-weight:600;color:#888;margin:0;text-transform:uppercase;letter-spacing:.4px;">Pipeline Progress</p>
                <span id="p-score-label" style="font-size:13px;font-weight:700;color:#222;">—</span>
            </div>
            <div style="background:#e9ecef;border-radius:99px;height:10px;overflow:hidden;">
                <div id="p-score-bar" style="height:10px;border-radius:99px;width:0%;transition:width .5s ease;"></div>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:6px;">
                <small style="color:#ccc;font-size:10px;">New</small>
                <small style="color:#ccc;font-size:10px;">Contacted</small>
                <small style="color:#ccc;font-size:10px;">Qualified</small>
                <small style="color:#ccc;font-size:10px;">Proposal</small>
                <small style="color:#ccc;font-size:10px;">Negotiation</small>
                <small style="color:#ccc;font-size:10px;">Closed</small>
            </div>
        </div>

        {{-- Service Interest & Company Size --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Service Interest</p>
                <p id="p-interest" style="margin:0;font-size:14px;color:#222;">—</p>
            </div>
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Company Size</p>
                <p id="p-company-size" style="margin:0;font-size:14px;color:#222;">—</p>
            </div>
        </div>

        {{-- Budget & Urgency --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Budget Range</p>
                <p id="p-budget" style="margin:0;font-size:14px;color:#222;">—</p>
            </div>
            <div>
                <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:.4px;">Urgency</p>
                <p id="p-urgency" style="margin:0;font-size:14px;color:#222;">—</p>
            </div>
        </div>

        {{-- Message --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Message</p>
            <div id="p-message" style="background:#f4f6f9;border-radius:8px;padding:12px 14px;font-size:14px;line-height:1.6;color:#444;min-height:44px;">—</div>
        </div>

        {{-- Status --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Status</p>
            <form id="p-statusForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <select name="status" id="p-status-select" onchange="this.form.submit()" style="width:100%;padding:10px 14px;border:1.5px solid #dee2e6;border-radius:8px;font-size:14px;background:#fff;color:#222;cursor:pointer;appearance:auto;">
                    @foreach(['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'closed_won', 'closed_lost'] as $s)
                        <option value="{{ $s }}">{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                    @endforeach
                </select>
                <p style="margin:6px 0 0;font-size:11px;color:#aaa;">Changing status will automatically update associated tasks in TaskFlow</p>
            </form>
        </div>

        {{-- Assign To --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Assign To</p>
            <form id="p-assignForm" method="POST" action="">
                @csrf
                <div style="display:flex;gap:8px;">
                    <select name="assigned_to" id="p-assign-select" style="flex:1;padding:10px 14px;border:1.5px solid #dee2e6;border-radius:8px;font-size:14px;background:#fff;color:#222;">
                        <option value="">Select assignee</option>
                        @foreach($team_members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" style="padding:10px 18px;background:#111;color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;white-space:nowrap;">
                        Assign
                    </button>
                </div>
            </form>
        </div>

        {{-- Internal Notes --}}
        <div>
            <p style="font-size:11px;font-weight:600;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">Internal Notes</p>
            <form id="p-noteForm" method="POST" action="">
                @csrf
                <textarea
                    id="p-note-input"
                    name="note"
                    rows="4"
                    placeholder="Add internal notes..."
                    style="width:100%;padding:12px 14px;border:1.5px solid #dee2e6;border-radius:8px;font-size:14px;line-height:1.6;resize:vertical;font-family:inherit;color:#333;background:#fff;box-sizing:border-box;outline:none;"
                    onfocus="this.style.borderColor='#111'"
                    onblur="this.style.borderColor='#dee2e6'"
                ></textarea>
                <div style="margin-top:10px;display:flex;align-items:center;gap:12px;">
                    <button type="submit" style="padding:10px 24px;background:#111;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">
                        Save Notes
                    </button>
                    <span id="p-note-success" style="display:none;color:#16a34a;font-size:13px;font-weight:500;">✓ Saved successfully!</span>
                </div>
            </form>
        </div>

    </div>
</div>