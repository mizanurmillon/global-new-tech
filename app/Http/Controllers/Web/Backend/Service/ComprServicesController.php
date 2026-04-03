<?php

namespace App\Http\Controllers\Web\Backend\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ComprServicesRequest;
use App\Models\ComprService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ComprServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ComprService::latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('icon', function ($row) {
                    if ($row->icon && file_exists(public_path($row->icon))) {
                        return '<img src="' . asset($row->icon) . '" style="border-radius:10%; object-fit:cover; background-color: #000000;" alt="Icon">';
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
                            data-title="Do you want to ' . ($next ? 'Enable' : 'Disable') . ' this Comprehensive Service?"
                            data-description="' . ($next ? 'This content will be visible.' : 'This content will be hidden.') . '"
                            data-bs-toggle="modal"
                            data-bs-target="#statusModal">
                            <label class="switch">
                                <input type="checkbox" ' . $checked . '>
                                <span class="slider round"></span>
                            </label>
                        </a>';
                })

                ->addColumn('action', function (ComprService $compr_service) {
                    return view('components.action-buttons', [
                        'id'     => $compr_service->id,
                        'show'   => 'admin.compr-services.show',
                        'edit'   => 'admin.compr-services.edit',
                        'delete' => true,
                    ])->render();
                })

                ->rawColumns(['icon', 'is_active', 'action'])
                ->make(true);
        }

        return view('backend.layouts.compr-service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.compr-service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComprServicesRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = uploadFile($request->file('icon'), 'uploads/compr-services');
        }

        ComprService::create($data);

        return redirect()->route('admin.compr-services.index')->with('success', 'Comprehensive Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComprService $compr_service)
    {
        return view('backend.layouts.compr-service.show', compact('compr_service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComprService $compr_service)
    {
        return view('backend.layouts.compr-service.create', compact('compr_service'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(ComprServicesRequest $request, ComprService $compr_service)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            deleteFile($compr_service->icon);
            $data['icon'] = uploadFile($request->file('icon'), 'uploads/compr-services');
        }

        $compr_service->update($data);

        return redirect()->route('admin.compr-services.index')->with('success', 'Comprehensive Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComprService $compr_service)
    {
        deleteFile($compr_service->icon);

        $compr_service->delete();

        return redirect()->route('admin.compr-services.index')->with('success', 'Comprehensive Service deleted successfully.');
    }

    public function status(ComprService $compr_service)
    {
        $compr_service->is_active = ! $compr_service->is_active;
        $compr_service->save();

        return response()->json([
            'success' => true,
            'message' => $compr_service->is_active ? 'Activated successfully' : 'Deactivated successfully',
        ]);
    }
}
