<?php
namespace App\Http\Controllers\Web\Backend\Lead;

use App\Http\Controllers\Controller;
use App\Models\SecurityAssessment;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = SecurityAssessment::query()->with(['assignedTo', 'assignedBy']);

        if (auth()->user()->role !== 'admin') {
            $query->where('assigned_to', auth()->id());
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('company_name', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $stats = [
            'total'       => (clone $query)->count(),
            'new'         => (clone $query)->where('status', 'new')->count(),
            'in_progress' => (clone $query)->whereNotIn('status', ['new', 'closed_won'])->count(),
            'closed_won'  => (clone $query)->where('status', 'closed_won')->count(),
        ];

        $leads = $query->latest()->paginate(9);

        $assignees    = User::select('id', 'name')->get();
        $team_members = User::where('role', 'team')->get();

        return view('backend.layouts.leads.index', compact('leads', 'stats', 'assignees', 'team_members'));
    }

    public function assign(Request $request, SecurityAssessment $lead)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        if (auth()->user()->role != 'admin') {
            return back()->with('error', 'you can not assign this lead');
        }

        $lead->update([
            'assigned_to' => $request->assigned_to,
            'status'      => 'assigned',
        ]);

        return redirect()->back()->with('success', 'Lead assigned successfully.');
    }
    // LeadController.php
    public function updateStatus(Request $request, SecurityAssessment $lead)
    {
        $isAdmin    = auth()->user()->role === 'admin';
        $isAssigned = auth()->user()->id === $lead->assigned_to;

        if (! $isAdmin && ! $isAssigned) {
            return back()->with('error', 'You cannot change the status of this lead.');
        }

        if ($lead->status === 'rejected' && ! $isAdmin) {
            return back()->with('error', 'This lead is rejected. Please contact admin to reassign.');
        }

        $statusOrder = [
            'new'         => 1,
            'assigned'    => 2,
            'accepted'    => 3,
            'rejected'    => 3,
            'contacted'   => 4,
            'qualified'   => 5,
            'proposal'    => 6,
            'negotiation' => 7,
            'closed_won'  => 8,
            'closed_lost' => 8,
        ];

        $currentRank = $statusOrder[$lead->status] ?? 0;
        $newRank     = $statusOrder[$request->status] ?? 0;

        if ($newRank < $currentRank) {
            return back()->with('error', 'You cannot move the status backwards.');
        }

        if ($request->status === 'rejected') {
            $lead->update(['status' => 'rejected', 'assigned_to' => null]);
            return back()->with('success', 'Lead rejected successfully.');
        }

        $lead->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully.');
    }

    public function accept(Request $request, SecurityAssessment $lead)
    {
        if (auth()->user()->id !== $lead->assigned_to) {
            return back()->with('error', 'You cannot accept this lead.');
        }

        $lead->update(['status' => 'accepted']);

        return back()->with('success', 'Lead accepted successfully.');
    }

    public function reject(Request $request, SecurityAssessment $lead)
    {
        if (auth()->user()->id !== $lead->assigned_to) {
            return back()->with('error', 'You cannot reject this lead.');
        }

        $lead->update(['status' => 'rejected']);

        return back()->with('success', 'Lead rejected successfully.');
    }
    public function saveNote(Request $request, SecurityAssessment $lead)
    {

        $lead->update(['note' => $request->note]);
        return response()->json(['success' => true]);
    }
}
