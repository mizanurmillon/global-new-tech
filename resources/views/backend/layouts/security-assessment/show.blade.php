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
                    <th>Service Type</th>
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

            </table>

            {{-- Back Button --}}
            <div class="text-end mt-3">
                <a href="{{ route('admin.security-assessment.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>

        </div>
    </div>
@endsection
