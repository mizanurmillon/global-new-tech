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
  {{-- Search & Filters --}}
<form method="GET" action="{{ route('admin.leads.index') }}" class="mb-4">
    <div class="row g-2 align-items-center">
        <div class="col-md-5">
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
        <div class="col-md-3">
            <select name="status" class="form-select form-select-sm">
                <option value="">All Status</option>
                @foreach(['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'closed_won', 'closed_lost'] as $s)
                    <option value="{{ $s }}" @selected(request('status') == $s)>
                        {{ ucfirst(str_replace('_', ' ', $s)) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="assigned_to" class="form-select form-select-sm">
                <option value="">All Assignees</option>
                @foreach($assignees as $assignee)
                    <option value="{{ $assignee->id }}" @selected(request('assigned_to') == $assignee->id)>
                        {{ $assignee->name }}
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

    {{-- Lead Cards --}}
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
    <div>
        {{ $leads->withQueryString()->links() }}
    </div>
</div>
    @endif

</div>

{{-- Partials --}}
@include('backend.layouts.leads.partials._lead_detail_panel')

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

@include('backend.layouts.leads.partials._lead_scripts')

@endsection
