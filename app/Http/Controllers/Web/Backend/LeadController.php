<?php
namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\SecurityAssessment;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = SecurityAssessment::query()->with(['assignedTo', 'assignedBy']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('company_name', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Assignee filter
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $leads = $query->latest()->paginate(9);

        // Stats
        $stats = [
            'total'       => SecurityAssessment::count(),
            'new'         => SecurityAssessment::where('status', 'pending')->count(),
            'in_progress' => SecurityAssessment::whereIn('status', ['contacted', 'qualified', 'in_progress', 'proposal', 'negotiation'])->count(),
            'closed_won'  => SecurityAssessment::where('status', 'closed_won')->count(),
        ];

        $assignees = User::select('id', 'name')->get();

        $team_members = User::where('role', 'team')->get();

        return view('backend.layouts.lead.index', compact('leads', 'stats', 'assignees', 'team_members'));
    }

    public function assign(Request $request, SecurityAssessment $lead)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $lead->update([
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->back()->with('success', 'Lead assigned successfully.');
    }
    // LeadController.php
    public function updateStatus(Request $request, SecurityAssessment $lead)
    {
        $lead->update(['status' => $request->status]);
        return back();
    }

    public function saveNote(Request $request, SecurityAssessment $lead)
    {
        $lead->update(['note' => $request->note]);
        return response()->json(['success' => true]);
    }
}
