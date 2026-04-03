<?php
namespace App\Http\Controllers\Web\Backend\Service;

use App\Http\Controllers\Controller;
use App\Models\CoreService;
use App\Models\SubService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubService::with('coreService')->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('sub_service_icon', function ($row) {
                    if ($row->sub_service_icon && file_exists(public_path($row->sub_service_icon))) {
                        return '<img src="' . asset($row->sub_service_icon) . '" height="50" width="50" style="object-fit:cover;border-radius:4px">';
                    }
                    return '<span class="text-muted">No Icon</span>';
                })
                ->addColumn('core_service', function ($row) {
                    return $row->coreService?->service_title ?? '<span class="text-muted">N/A</span>';
                })
                ->addColumn('action', function (SubService $sub) {
                    return view('components.action-buttons', [
                        'id'     => $sub->id,
                        'show'   => 'admin.sub-services.show',
                        'edit'   => 'admin.sub-services.edit',
                        'delete' => true,
                    ])->render();
                })
                ->rawColumns(['sub_service_icon', 'core_service', 'action'])
                ->make(true);
        }

        return view('backend.layouts.sub-service.index');
    }

    public function create()
    {
        $coreServices = CoreService::active()->pluck('service_title', 'id');
        return view('backend.layouts.sub-service.create', compact('coreServices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'core_service_id'         => 'required|exists:core_services,id',
            'sub_service_title'       => 'required|string|max:255',
            'sub_service_sub_title'   => 'nullable|string|max:255',
            'sub_service_description' => 'nullable|string',
            'sub_service_icon'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'sub_service_icon']);

        if ($request->hasFile('sub_service_icon')) {
            $data['sub_service_icon'] = uploadFile($request->file('sub_service_icon'), 'uploads/sub-services/icons');
        }

        SubService::create($data);

        return redirect()->route('admin.sub-services.index')->with('success', 'Sub Service created successfully.');
    }

    public function edit(SubService $subService)
    {
        $coreServices = CoreService::active()->pluck('service_title', 'id');
        return view('backend.layouts.sub-service.create', compact('subService', 'coreServices'));
    }

    public function update(Request $request, SubService $subService)
    {
        $request->validate([
            'core_service_id'         => 'required|exists:core_services,id',
            'sub_service_title'       => 'required|string|max:255',
            'sub_service_sub_title'   => 'nullable|string|max:255',
            'sub_service_description' => 'nullable|string',
            'sub_service_icon'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'sub_service_icon']);

        if ($request->hasFile('sub_service_icon')) {
            deleteFile($subService->sub_service_icon);
            $data['sub_service_icon'] = uploadFile($request->file('sub_service_icon'), 'uploads/sub-services/icons');
        }

        $subService->update($data);

        return redirect()->route('admin.sub-services.index')->with('success', 'Sub Service updated successfully.');
    }

    public function show(SubService $subService)
    {
        $subService->load('coreService');
        return view('backend.layouts.sub-service.show', compact('subService'));
    }

    public function destroy(SubService $subService)
    {
        deleteFile($subService->sub_service_icon);
        $subService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
