<?php
namespace App\Http\Controllers\Web\Backend\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('logo', function ($row) {
                    if ($row->logo && file_exists(public_path($row->logo))) {
                        return '<img src="' . asset($row->logo) . '" height="50" width="50" style="border-radius:50%">';
                    }
                    return '<span class="text-muted">No Logo</span>';
                })
                ->addColumn('is_active', function ($row) {
                    $next    = $row->is_active ? 0 : 1;
                    $checked = $row->is_active ? 'checked' : '';
                    return '
                        <a href="#" class="change_status"
                            data-id="' . $row->id . '"
                            data-enabled="' . $next . '"
                            data-title="Do you want to ' . ($next ? 'Enable' : 'Disable') . ' this Brand?"
                            data-description="' . ($next ? 'This content will be visible.' : 'This content will be hidden.') . '"
                            data-bs-toggle="modal"
                            data-bs-target="#statusModal">
                            <label class="switch">
                                <input type="checkbox" ' . $checked . '>
                                <span class="slider round"></span>
                            </label>
                        </a>';
                })

                ->addColumn('action', function (Brand $brand) {
                    return view('components.action-buttons', [
                        'id'     => $brand->id,
                        'show'   => 'admin.brands.show',
                        'edit'   => 'admin.brands.edit',
                        'delete' => true,
                    ])->render();
                })

                ->rawColumns(['logo', 'is_active', 'action'])
                ->make(true);
        }

        return view('backend.layouts.brand.index');
    }

    public function create()
    {
        return view('backend.layouts.brand.create');
    }

    public function store(BrandRequest $request)
    {
        $data              = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            $data['logo'] = uploadFile($request->file('logo'), 'uploads/brands');
        }

        Brand::create($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('backend.layouts.brand.create', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $data              = $request->validated();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            deleteFile($brand->logo);
            $data['logo'] = uploadFile($request->file('logo'), 'uploads/brands');
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function show(Brand $brand)
    {
        return view('backend.layouts.brand.show', compact('brand'));
    }

    public function status(Brand $brand)
    {
        $brand->is_active = ! $brand->is_active;
        $brand->save();

        return response()->json([
            'success' => true,
            'message' => $brand->is_active ? 'Activated successfully' : 'Deactivated successfully',
        ]);
    }

    public function destroy(Brand $brand)
    {
        deleteFile($brand->logo);
        $brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
