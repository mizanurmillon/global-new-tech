<?php
namespace App\Http\Controllers\Web\Backend\Testimonial;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('image', function ($row) {
                    if ($row->image && file_exists(public_path($row->image))) {
                        return '<img src="' . asset($row->image) . '" height="50" width="50" style="border-radius:50%">';
                    }
                    return '<span class="text-muted">No Image</span>';
                })                

                ->addColumn('rating', function ($row) {
                    return $row->rating ? str_repeat('⭐', $row->rating) : 'N/A';
                })

                ->addColumn('is_active', function ($row) {
                    $next    = $row->is_active ? 0 : 1;
                    $checked = $row->is_active ? 'checked' : '';

                    return '
                        <a href="#" class="change_status"
                            data-id="' . $row->id . '"
                            data-enabled="' . $next . '"
                            data-title="Do you want to ' . ($next ? 'Enable' : 'Disable') . ' this Testimonial?"
                            data-description="' . ($next ? 'This will be visible.' : 'This will be hidden.') . '"
                            data-bs-toggle="modal"
                            data-bs-target="#statusModal">
                            <label class="switch">
                                <input type="checkbox" ' . $checked . '>
                                <span class="slider round"></span>
                            </label>
                        </a>';
                })

                ->addColumn('action', function ($row) {
                    return view('components.action-buttons', [
                        'id'     => $row->id,
                        'show'   => 'admin.testimonials.show',
                        'edit'   => 'admin.testimonials.edit',
                        'delete' => true,
                    ])->render();
                })

                ->rawColumns(['image', 'rating', 'is_active', 'action'])
                ->make(true);
        }

        return view('backend.layouts.testimonial.index');
    }

    public function create()
    {
        return view('backend.layouts.testimonial.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio'      => 'nullable|string|max:255',
            'image'    => 'nullable|image',
            'rating'   => 'required|integer|min:1|max:5',
            'text'     => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = uploadFile($request->file('image'), 'uploads/testimonials');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('backend.layouts.testimonial.create', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio'      => 'nullable|string|max:255',
            'image'    => 'nullable|image',
            'rating'   => 'nullable|integer|min:1|max:5',
            'text'     => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            deleteFile($testimonial->image);
            $data['image'] = uploadFile($request->file('image'), 'uploads/testimonials');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Updated successfully.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('backend.layouts.testimonial.show', compact('testimonial'));
    }

    public function status($id)
    {
        $testimonial            = Testimonial::findOrFail($id);
        $testimonial->is_active = ! $testimonial->is_active;
        $testimonial->save();

        return response()->json([
            'success' => true,
            'message' => $testimonial->is_active ? 'Activated' : 'Deactivated',
        ]);
    }

    public function destroy(Testimonial $testimonial)
    {
        deleteFile($testimonial->image);
        $testimonial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
