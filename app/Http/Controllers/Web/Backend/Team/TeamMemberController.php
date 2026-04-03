<?php
namespace App\Http\Controllers\Web\Backend\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamMemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query()->team()->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar_path', function ($row) {
                    if ($row->avatar_path && file_exists(public_path($row->avatar_path))) {
                        return '<img src="' . asset($row->avatar_path) . '" height="50" width="50">';
                    }
                    return '<span class="text-muted">No Image</span>';
                })
                ->addColumn('is_active', function ($row) {
                    $next    = $row->is_active ? 0 : 1;
                    $checked = $row->is_active ? 'checked' : '';
                    return '
                    <a href="#" class="change_status"
                        data-id="' . $row->id . '"
                        data-enabled="' . $next . '"
                        data-title="Do you want to ' . ($next ? 'Enable' : 'Disable') . ' this Member?"
                        data-description="' . ($next ? 'This member will be visible.' : 'This member will be hidden.') . '"
                        data-bs-toggle="modal"
                        data-bs-target="#statusModal">
                        <label class="switch">
                            <input type="checkbox" ' . $checked . '>
                            <span class="slider round"></span>
                        </label>
                    </a>';
                })
                ->addColumn('action', function (User $u) {
                    return view('components.action-buttons', [
                        'id'     => $u->id,
                        'edit'   => 'admin.team.edit',
                        'delete' => true,
                    ])->render();
                })
                ->rawColumns(['avatar_path', 'is_active', 'action'])
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
        if ($request->hasFile('avatar_path')) {
            $data['avatar_path'] = uploadFile($request->file('avatar_path'), 'uploads/team/members');
        }
        $data['role'] = 'team';

        User::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member created successfully.');
    }

    public function edit(User $team)
    {

        return view('backend.layouts.team.create', compact('team'));
    }

    public function update(TeamMemberRequest $request, User $team)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        if ($request->hasFile('avatar_path')) {
            deleteFile($team->avatar_path);
            $data['avatar_path'] = uploadFile($request->file('avatar_path'), 'uploads/team/members');
        }

        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function show(User $team)
    {
        return view('backend.layouts.team.show', compact('team'));
    }

    public function status(User $team)
    {
        $team->is_active = ! $team->is_active;
        $team->save();

        return response()->json([
            'success' => true,
            'message' => $team->is_active ? 'Activated successfully' : 'Deactivated successfully',
        ]);
    }

    public function destroy(User $team)
    {
        deleteFile($team->avatar_path);
        $team->delete();

        return response()->json(['status' => 'success']);
    }
}
