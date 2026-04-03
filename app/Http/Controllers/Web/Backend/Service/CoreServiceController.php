<?php
namespace App\Http\Controllers\Web\Backend\Service;

use App\Http\Controllers\Controller;
use App\Models\CoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CoreServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CoreService::latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('hero_image', function ($row) {
                    if ($row->hero_image && file_exists(public_path($row->hero_image))) {
                        return '<img src="' . asset($row->hero_image) . '" height="50" width="80" style="object-fit:cover;border-radius:4px">';
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
                            data-title="Do you want to ' . ($next ? 'Enable' : 'Disable') . ' this Service?"
                            data-description="' . ($next ? 'This content will be visible.' : 'This content will be hidden.') . '"
                            data-bs-toggle="modal"
                            data-bs-target="#statusModal">
                            <label class="switch">
                                <input type="checkbox" ' . $checked . '>
                                <span class="slider round"></span>
                            </label>
                        </a>';
                })
                ->addColumn('action', function (CoreService $service) {
                    return view('components.action-buttons', [
                        'id'     => $service->id,
                        'show'   => 'admin.services.show',
                        'edit'   => 'admin.services.edit',
                        // 'delete' => true,
                    ])->render();
                })
                ->rawColumns(['hero_image', 'is_active', 'action'])
                ->make(true);
        }

        return view('backend.layouts.service.index');
    }

    public function create()
    {
        return view('backend.layouts.service.create');
    }

    public function store(Request $request)
    {
        $totalCoutn = CoreService::count();
        if ($totalCoutn >= 5) {
            return redirect()->route('admin.services.index')->with('error', 'You can only create up to 5 services.');
        }

        $request->validate([
            'hero_title'                           => 'nullable|string|max:255',
            'hero_description'                     => 'nullable|string|max:255',
            'hero_image'                           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'main_section_title'                   => 'nullable|string|max:255',
            'main_section_subtitle'                => 'nullable|string|max:255',
            'service_title'                        => 'required|string|max:255',
            'service_subtitle'                     => 'nullable|string|max:255',
            'service_description'                  => 'nullable|string',
            'service_icon'                         => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:20480',
            'work_section_title'                   => 'nullable|string|max:255',
            'work_section_subtitle'                => 'nullable|string|max:255',
            // Repeatable values
            'values.*.value_title'                 => 'nullable|string|max:255',
            'values.*.value_sub_title'             => 'nullable|string|max:255',
            'values.*.value'                       => 'nullable|string|max:255',
            // How to work
            'how_to_works.*.how_to_work_title'     => 'nullable|string|max:255',
            'how_to_works.*.how_to_work_sub_title' => 'nullable|string|max:255',
            'how_to_works.*.how_to_work_icon'      => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:20480',
        ]);

        $data         = $request->except(['_token', 'values', 'how_to_works', 'hero_image', 'service_icon']);
        $data['slug'] = Str::slug($request->service_title) . '-' . Str::random(5);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = uploadFile($request->file('hero_image'), 'uploads/services');
        }
        if ($request->hasFile('service_icon')) {
            $data['service_icon'] = uploadFile($request->file('service_icon'), 'uploads/services/icons');
        }

        $service = CoreService::create($data);

        // Save service values
        if ($request->has('values')) {
            foreach ($request->values as $val) {
                if (! empty(array_filter($val))) {
                    $service->serviceValues()->create($val);
                }
            }
        }

        // Save how to work items
        if ($request->has('how_to_works')) {
            foreach ($request->how_to_works as $index => $htw) {
                $htwData = [
                    'how_to_work_title'     => $htw['how_to_work_title'] ?? null,
                    'how_to_work_sub_title' => $htw['how_to_work_sub_title'] ?? null,
                ];
                if (isset($htw['how_to_work_icon']) && $request->hasFile("how_to_works.{$index}.how_to_work_icon")) {
                    $htwData['how_to_work_icon'] = uploadFile($request->file("how_to_works.{$index}.how_to_work_icon"), 'uploads/services/how-to-work', (string) Str::uuid());
                }
                if (! empty(array_filter($htwData))) {
                    $service->howToWorkServices()->create($htwData);
                }
            }
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(CoreService $service)
    {
        $service->load(['serviceValues', 'howToWorkServices']);
        return view('backend.layouts.service.create', compact('service'));
    }

    public function update(Request $request, CoreService $service)
    {
        $request->validate([
            'hero_title'                           => 'nullable|string|max:255',
            'hero_description'                     => 'nullable|string|max:255',
            'hero_image'                           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'main_section_title'                   => 'nullable|string|max:255',
            'main_section_subtitle'                => 'nullable|string|max:255',
            'service_title'                        => 'required|string|max:255',
            'service_subtitle'                     => 'nullable|string|max:255',
            'service_description'                  => 'nullable|string',
            'service_icon'                         => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:20480',
            'work_section_title'                   => 'nullable|string|max:255',
            'work_section_subtitle'                => 'nullable|string|max:255',
            'values.*.value_title'                 => 'nullable|string|max:255',
            'values.*.value_sub_title'             => 'nullable|string|max:255',
            'values.*.value'                       => 'nullable|string|max:255',
            'how_to_works.*.how_to_work_title'     => 'nullable|string|max:255',
            'how_to_works.*.how_to_work_sub_title' => 'nullable|string|max:255',
            'how_to_works.*.how_to_work_icon'      => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:20480',
        ]);

        $data = $request->except(['_token', '_method', 'values', 'how_to_works', 'hero_image', 'service_icon']);

        if ($request->hasFile('hero_image')) {
            deleteFile($service->hero_image);
            $data['hero_image'] = uploadFile($request->file('hero_image'), 'uploads/services');
        }
        if ($request->hasFile('service_icon')) {
            deleteFile($service->service_icon);
            $data['service_icon'] = uploadFile($request->file('service_icon'), 'uploads/services/icons');
        }

        $service->update($data);

        // Sync how to work items keep old records indexed
        $existingHtws = $service->howToWorkServices->keyBy('id');

        $service->howToWorkServices()->delete(); // delete DB records only, no file deletion yet

        if ($request->has('how_to_works')) {
            foreach ($request->how_to_works as $index => $htw) {
                $htwData = [
                    'how_to_work_title'     => $htw['how_to_work_title'] ?? null,
                    'how_to_work_sub_title' => $htw['how_to_work_sub_title'] ?? null,
                ];

                if ($request->hasFile("how_to_works.{$index}.how_to_work_icon")) {
                    // New icon uploaded — delete old one if exists, upload new
                    $oldIcon = $htw['existing_icon'] ?? null;
                    if ($oldIcon) {
                        deleteFile($oldIcon);
                    }
                    $htwData['how_to_work_icon'] = uploadFile(
                        $request->file("how_to_works.{$index}.how_to_work_icon"),
                        'uploads/services/how-to-work',
                        (string) Str::uuid()
                    );
                } else {
                    // No new icon — keep the existing one
                    $htwData['how_to_work_icon'] = $htw['existing_icon'] ?? null;
                }

                if (! empty(array_filter($htwData))) {
                    $service->howToWorkServices()->create($htwData);
                }
            }
        } else {
            // No how_to_works submitted at all — now safe to delete old icons
            foreach ($existingHtws as $htw) {
                deleteFile($htw->how_to_work_icon);
            }
        }

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function show(CoreService $service)
    {
        $service->load(['serviceValues', 'howToWorkServices', 'subServices']);
        return view('backend.layouts.service.show', compact('service'));
    }

    public function status(CoreService $service)
    {
        $service->is_active = ! $service->is_active;
        $service->save();

        return response()->json([
            'success' => true,
            'message' => $service->is_active ? 'Activated successfully' : 'Deactivated successfully',
        ]);
    }

    public function destroy(CoreService $service)
    {
        deleteFile($service->hero_image);
        deleteFile($service->service_icon);
        foreach ($service->howToWorkServices as $htw) {
            deleteFile($htw->how_to_work_icon);
        }
        foreach ($service->subServices as $sub) {
            deleteFile($sub->sub_service_icon);
        }
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
