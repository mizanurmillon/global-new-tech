<?php

namespace App\Http\Controllers\Web\backend\SecurityAssessment;

use App\Http\Controllers\Controller;
use App\Models\SecurityAssessment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SecurityAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SecurityAssessment::latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if($row->status == 'pending') {
                        return '<span class="badge bg-warning">Pending</span>';
                    } elseif ($row->status == 'assigned') {
                        return '<span class="badge bg-info">Assigned</span>';
                    } elseif ($row->status == 'accepted') {
                        return '<span class="badge bg-secondary">Accepted</span>';
                    }elseif ($row->status == 'in_progress') {
                        return '<span class="badge bg-primary">In Progress</span>';
                    }elseif ($row->status == 'completed') {
                        return '<span class="badge bg-success">Completed</span>';
                    }elseif ($row->status == 'rejected') {
                        return '<span class="badge bg-danger">Rejected</span>';
                    }elseif ($row->status == 'cancelled') {
                        return '<span class="badge bg-danger">Cancelled</span>';
                    }
                    return '<span class="badge bg-secondary">Unknown</span>';
                })

                ->addColumn('action', function (SecurityAssessment $security_assessment) {
                    return view('components.action-buttons', [
                        'id'     => $security_assessment->id,
                        'show'   => 'admin.security-assessment.show',
                        'delete' => true,
                    ])->render();
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.security-assessment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SecurityAssessment $security_assessment)
    {
        return view('backend.layouts.security-assessment.show', compact('security_assessment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SecurityAssessment $security_assessment)
    {
        $security_assessment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
