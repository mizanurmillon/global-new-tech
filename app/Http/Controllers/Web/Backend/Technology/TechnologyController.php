<?php
namespace App\Http\Controllers\Web\Backend\Technology;

use App\Http\Controllers\Controller;
use App\Http\Requests\Technology\TechnologyRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TechnologyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Technology::latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('icon', function ($row) {
                    if ($row->icon && file_exists(public_path($row->icon))) {
                        return '<img src="' . asset($row->icon) . '" height="50" width="50" style="border-radius:50%">';
                    }
                    return '<span class="text-muted">No Icon</span>';
                })

                ->addColumn('is_active', function ($row) {
                    $next    = $row->is_active ? 0 : 1;
                    $checked = $row->is_active ? 'checked' : '';
                    return '
                        <a href="#" class="change_status"
                            data-id="' . $row->id . '"
                            data-enabled="' . $next . '"
                            data-title="Do you want to ' . ($next ? 'Enable' : 'Disable') . ' this Technology?"
                            data-description="' . ($next ? 'This content will be visible.' : 'This content will be hidden.') . '"
                            data-bs-toggle="modal"
                            data-bs-target="#statusModal">
                            <label class="switch">
                                <input type="checkbox" ' . $checked . '>
                                <span class="slider round"></span>
                            </label>
                        </a>';
                })

                ->addColumn('action', function (Technology $technology) {
                    return view('components.action-buttons', [
                        'id'     => $technology->id,
                        'edit'   => 'admin.technologies.edit',
                        'delete' => true,
                    ])->render();
                })

                ->rawColumns(['icon', 'is_active', 'action'])
                ->make(true);
        }

        return view('backend.layouts.technology.index');
    }

    public function create()
    {
        return view('backend.layouts.technology.create');
    }

    public function store(TechnologyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = uploadFile($request->file('icon'), 'uploads/technologies');
        }

        Technology::create($data);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology created successfully.');
    }

    public function edit(Technology $technology)
    {
        return view('backend.layouts.technology.create', compact('technology'));
    }

    public function update(TechnologyRequest $request, Technology $technology)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            deleteFile($technology->icon);
            $data['icon'] = uploadFile($request->file('icon'), 'uploads/technologies');
        }

        $technology->update($data);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology updated successfully.');
    }

    public function status(Technology $technology)
    {
        $technology->is_active = ! $technology->is_active;
        $technology->save();

        return response()->json([
            'success' => true,
            'message' => $technology->is_active ? 'Activated successfully' : 'Deactivated successfully',
        ]);
    }

    public function destroy(Technology $technology)
    {
        deleteFile($technology->icon);
        $technology->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
