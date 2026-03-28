<?php
namespace App\Http\Controllers\Web\Backend\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamMemberRequest;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TeamMember::latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if ($row->image && file_exists(public_path($row->image))) {
                        return '<img src="' . asset($row->image) . '" height="50" width="50">';
                    }
                    return '<span class="text-muted">No Image</span>';
                })
                ->addColumn('action', function (TeamMember $u) {
                    return view('components.action-buttons', [
                        'id'     => $u->id,
                        'edit'   => 'admin.team.edit',
                        'delete' => true,
                    ])->render();
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('backend.layouts.team.index');
    }

    public function create()
    {
        return view('backend.layouts.team.create');
    }

    public function store(TeamMemberRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = uploadFile($request->file('image'), 'uploads/team/members');
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $team)
    {
        return view('backend.layouts.team.create', compact('team'));
    }

    public function update(TeamMemberRequest $request, TeamMember $team)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            deleteFile($team->image);
            $data['image'] = uploadFile($request->file('image'), 'uploads/team/members');
        }

        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function show(TeamMember $team)
    {
        return view('backend.layouts.team.show', compact('team'));
    }

    public function destroy(TeamMember $team)
    {
        deleteFile($team->image);
        $team->delete();

        return response()->json(['status' => 'success']);
    }
}
