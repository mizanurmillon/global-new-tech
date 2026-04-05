@extends('backend.layouts.app')

@section('title', 'Security Assessment Details')

@section('content')
<div class="content-wrapper">
    <x-breadcrumbs title="Security Assessment Details" />

    <div class="card p-4">
        {{-- Details Table --}}
        <table class="table table-bordered">

            <tr>
                <th width="200">User Name</th>
                <td>{{ $security_assessment->full_name }}</td>
            </tr>

            <tr>
                <th>Business Email</th>
                <td>{{ $security_assessment->email ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Company Name</th>
                <td>{{ $security_assessment->company_name ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Phone Number</th>
                <td>{{ $security_assessment->phone_number ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Service Interest</th>
                <td>{{ $security_assessment->security_interest ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Company Size</th>
                <td>{{ $security_assessment->company_size ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Timeline</th>
                <td>{{ $security_assessment->timeline ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Budget Range</th>
                <td>{{ $security_assessment->budget_range ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if ($security_assessment->status == 'pending')
                    <span class="badge bg-warning">Pending</span>
                    @elseif ($security_assessment->status == 'assigned')
                    <span class="badge bg-info">Assigned</span>
                    @elseif ($security_assessment->status == 'accepted')
                    <span class="badge bg-success">Accepted</span>
                    @elseif ($security_assessment->status == 'in_progress')
                    <span class="badge bg-primary">In Progress</span>
                    @elseif ($security_assessment->status == 'completed')
                    <span class="badge bg-success">Completed</span>
                    @elseif ($security_assessment->status == 'rejected')
                    <span class="badge bg-danger">Rejected</span>
                    @elseif($security_assessment->status == 'cancelled')
                    <span class="badge bg-secondary">Cancelled</span>
                    @else
                    <span class="badge bg-secondary">Unknown</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Message</th>
                <td>
                    {!! $security_assessment->message ?? '<span class="text-muted">No message</span>' !!}
                </td>
            </tr>

        </table>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-header">Assigned To</div>
                    <div class="card-body">
                        <h5 class="card-title">Select Team Member:</h5>
                        <form action="{{ route('admin.security-assessment.assigned-to',$security_assessment->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <select name="assigned_to" class="form-select">
                                    <option value="">-- Select Team Member --</option>
                                    @foreach ($team_members as $member)
                                    <option value="{{ $member->id }}" @if($member->id == $security_assessment->assigned_to) selected @endif>{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm w-100">Assign</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Back Button --}}
        <div class="text-end mt-3">
            <a href="{{ route('admin.security-assessment.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </div>
</div>
@endsection
