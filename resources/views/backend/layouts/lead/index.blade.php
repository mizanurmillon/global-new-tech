@extends('backend.layouts.app')
@section('title', 'Lead Management')

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <div class="d-flex align-items-center justify-content-between mb-2">
        <div>
            <h4 class="fw-bold mb-1">Lead Management</h4>
            <p class="text-muted small mb-0">Track and manage customer inquiries and opportunities</p>
        </div>
    </div>

    {{-- Search & Filters --}}
    <form method="GET" action="{{ route('admin.leads.index') }}" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search"
                        class="form-control border-start-0 ps-0"
                        placeholder="Search leads..."
                        value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    @foreach(['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'closed_won', 'closed_lost'] as $s)
                        <option value="{{ $s }}" @selected(request('status') == $s)>
                            {{ ucfirst(str_replace('_', ' ', $s)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="assigned_to" class="form-select form-select-sm">
                    <option value="">All Assignees</option>
                    @foreach($assignees as $assignee)
                        <option value="{{ $assignee->id }}" @selected(request('assigned_to') == $assignee->id)>
                            {{ $assignee->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="urgency" class="form-select form-select-sm">
                    <option value="">All Urgency</option>
                    <option value="low" @selected(request('urgency') == 'low')>Low</option>
                    <option value="medium" @selected(request('urgency') == 'medium')>Medium</option>
                    <option value="high" @selected(request('urgency') == 'high')>High</option>
                </select>
            </div>
        </div>
    </form>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Leads</p>
                        <h3 class="fw-bold mb-0">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="text-primary fs-4"><i class="bi bi-graph-up-arrow"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">New Leads</p>
                        <h3 class="fw-bold mb-0">{{ $stats['new'] }}</h3>
                    </div>
                    <div class="text-warning fs-4"><i class="bi bi-exclamation-circle"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">In Progress</p>
                        <h3 class="fw-bold mb-0">{{ $stats['in_progress'] }}</h3>
                    </div>
                    <div class="text-danger fs-4"><i class="bi bi-clock"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Closed Won</p>
                        <h3 class="fw-bold mb-0">{{ $stats['closed_won'] }}</h3>
                    </div>
                    <div class="text-success fs-4"><i class="bi bi-currency-dollar"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lead Cards Grid --}}
    @if($leads->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            No leads found.
        </div>
    @else
        <div class="row g-3">
            @foreach($leads as $lead)
            <div class="col-md-4">
                <div class="card border shadow-sm h-100 lead-card"
                     style="cursor:pointer;border-radius:12px;"
                     data-id="{{ $lead->id }}"
                     data-name="{{ $lead->full_name ?? $lead->title ?? 'Untitled Lead' }}"
                     data-company="{{ $lead->company_name ?? '—' }}"
                     data-email="{{ $lead->email ?? '—' }}"
                     data-phone="{{ $lead->phone_number ?? '—' }}"
                     data-status="{{ $lead->status }}"
                     data-status-label="{{ ucfirst(str_replace('_', ' ', $lead->status)) }}"
                     data-score="{{ $lead->score ?? 0 }}"
                     data-message="{{ $lead->message ?? '' }}"
                     data-note="{{ $lead->note ?? '' }}"
                     data-interest="{{ $lead->security_interest ?? '—' }}"
                     data-budget="{{ $lead->budget_range ?? '—' }}"
                     data-urgency="{{ $lead->timeline ?? '—' }}"
                     data-company-size="{{ $lead->company_size ?? '—' }}"
                     data-assigned="{{ $lead->assignedTo->name ?? '—' }}"
                     data-assigned-id="{{ $lead->assigned_to ?? '' }}"
                     data-created="{{ $lead->created_at->format('M j, Y') }}"
                     data-assign-url="{{ route('admin.leads.assign', $lead->id) }}"
                     data-note-url="{{ route('admin.leads.note', $lead->id) }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="fw-semibold mb-0 lead-title">
                                    {{ $lead->full_name ?? $lead->title ?? 'Untitled Lead' }}
                                </h6>
                                @if($lead->company_name)
                                    <small class="text-muted">{{ $lead->company_name }}</small>
                                @endif
                            </div>
                            <x-lead-status-badge :status="$lead->status" />
                        </div>

                        @if($lead->message)
                            <p class="text-muted small mb-2 lead-desc">
                                {{ Str::limit($lead->message, 80) }}
                            </p>
                        @endif

                        <div class="mb-1">
                            <div class="progress" style="height: 4px; border-radius: 2px;">
                                <div class="progress-bar {{ ($lead->score ?? 0) >= 80 ? 'bg-success' : (($lead->score ?? 0) >= 50 ? 'bg-warning' : 'bg-danger') }}"
                                     style="width: {{ $lead->score ?? 0 }}%"></div>
                            </div>
                        </div>
                        <div class="text-end mb-2">
                            <small class="text-muted">{{ $lead->score ?? 0 }}</small>
                        </div>

                        <ul class="list-unstyled mb-2 small text-muted">
                            @if($lead->email)
                            <li class="d-flex align-items-center gap-1 mb-1">
                                <i class="bi bi-envelope" style="font-size:12px"></i>
                                <span>{{ $lead->email }}</span>
                            </li>
                            @endif
                            @if($lead->phone_number)
                            <li class="d-flex align-items-center gap-1 mb-1">
                                <i class="bi bi-telephone" style="font-size:12px"></i>
                                <span>{{ $lead->phone_number }}</span>
                            </li>
                            @endif
                        </ul>

                        <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                            <small class="text-muted">Created {{ $lead->created_at->format('M j, Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Showing {{ $leads->firstItem() }}–{{ $leads->lastItem() }} of {{ $leads->total() }} leads
            </small>
            {{ $leads->withQueryString()->links() }}
        </div>
    @endif

</div>


{{-- ==================== OVERLAY ==================== --}}
<div id="leadOverlay" onclick="closeLeadPanel()" style="
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.5);
    z-index:9998;
"></div>

{{-- ==================== CENTER MODAL PANEL ==================== --}}
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

    {{-- Modal Header --}}
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

    {{-- Modal Body --}}
    <div style="padding:20px 24px;display:flex;flex-direction:column;gap:20px;">

        {{-- Email & Phone Row --}}
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

        {{-- Lead Score --}}

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

        {{-- Status Dropdown --}}
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


<style>
.lead-card {
    transition: box-shadow 0.2s, transform 0.2s;
    border-radius: 12px !important;
}
.lead-card:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,0.10) !important;
    transform: translateY(-2px);
}
.lead-title { font-size: 14px; line-height: 1.4; max-width: 200px; }
.lead-desc  { line-height: 1.5; }
.lead-badge {
    font-size: 11px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 20px;
    white-space: nowrap;
    letter-spacing: 0.3px;
}
.badge-new         { background:#E8F4FD; color:#1565C0; }
.badge-contacted   { background:#E8F5E9; color:#2E7D32; }
.badge-qualified   { background:#FFF8E1; color:#F57F17; }
.badge-proposal    { background:#F3E5F5; color:#6A1B9A; }
.badge-negotiation { background:#FBE9E7; color:#BF360C; }
.badge-closed-won  { background:#E0F2F1; color:#004D40; }
.badge-closed-lost { background:#FFEBEE; color:#B71C1C; }

#leadPanel::-webkit-scrollbar { width: 5px; }
#leadPanel::-webkit-scrollbar-track { background: transparent; }
#leadPanel::-webkit-scrollbar-thumb { background: #ddd; border-radius: 99px; }
</style>


<script>
function openLeadPanel(d) {
    // Header
    document.getElementById('p-name').textContent    = d.name;
    document.getElementById('p-company').textContent = d.company;

    // Badge
    const badge       = document.getElementById('p-badge');
    badge.textContent = d.statusLabel;
    badge.className   = 'lead-badge badge-' + d.status.replace(/_/g, '-');

    // Contact
    document.getElementById('p-email').textContent        = d.email;
    document.getElementById('p-phone').textContent        = d.phone;

    // Details
    document.getElementById('p-interest').textContent     = d.interest;
    document.getElementById('p-company-size').textContent = d.companySize;
    document.getElementById('p-budget').textContent       = d.budget;
    document.getElementById('p-urgency').textContent      = d.urgency;

    // Status based pipeline progress
    const statusProgress = {
        'new':         { percent: 10,  color: '#3b82f6' },
        'contacted':   { percent: 25,  color: '#8b5cf6' },
        'qualified':   { percent: 45,  color: '#f59e0b' },
        'proposal':    { percent: 60,  color: '#f97316' },
        'negotiation': { percent: 80,  color: '#ef4444' },
        'closed_won':  { percent: 100, color: '#16a34a' },
        'closed_lost': { percent: 100, color: '#6b7280' },
    };

    const progress = statusProgress[d.status] || { percent: 0, color: '#ccc' };
    document.getElementById('p-score-label').textContent = d.statusLabel;
    const bar = document.getElementById('p-score-bar');
    bar.style.width      = progress.percent + '%';
    bar.style.background = progress.color;

    // Message
    document.getElementById('p-message').textContent = d.message || 'No message provided.';

    // Note
    document.getElementById('p-note-input').value = d.note || '';
    document.getElementById('p-note-success').style.display = 'none';

    // Status form
    document.getElementById('p-statusForm').action = '/admin/leads/' + d.id + '/status';
    const statusSel = document.getElementById('p-status-select');
    for (let opt of statusSel.options) {
        opt.selected = (opt.value === d.status);
    }

    // Assign form
    document.getElementById('p-assignForm').action = d.assignUrl;
    const sel = document.getElementById('p-assign-select');
    for (let opt of sel.options) {
        opt.selected = (opt.value === d.assignedId);
    }

    // Note form
    document.getElementById('p-noteForm').action = d.noteUrl;



    // Show panel
    document.getElementById('leadOverlay').style.display = 'block';
    const panel = document.getElementById('leadPanel');
    panel.style.display = 'block';
    setTimeout(() => {
        panel.style.opacity = '1';
        panel.style.transform = 'translate(-50%, -50%) scale(1)';
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeLeadPanel() {
    const panel = document.getElementById('leadPanel');
    panel.style.opacity = '0';
    panel.style.transform = 'translate(-50%, -50%) scale(0.96)';
    setTimeout(() => {
        panel.style.display = 'none';
        document.getElementById('leadOverlay').style.display = 'none';
        document.body.style.overflow = '';
    }, 250);
}

document.addEventListener('DOMContentLoaded', function () {

    // Card click
    document.querySelectorAll('.lead-card').forEach(function (card) {
        card.addEventListener('click', function () {
            openLeadPanel(card.dataset);
        });
    });

    // Note AJAX save
    document.getElementById('p-noteForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const form    = this;
        const success = document.getElementById('p-note-success');

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
        .catch(() => {
            alert('Failed to save note. Please try again.');
        });
    });

    // ESC to close
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLeadPanel();
    });

});
</script>

@endsection
