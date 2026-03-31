<?php
namespace App\Http\Controllers\Web\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('image', function ($row) {
                    if ($row->image && file_exists(public_path($row->image))) {
                        return '<img src="' . asset($row->image) . '" height="50">';
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
                            data-title="Do you want to ' . ($next ? 'Enable' : 'Disable') . ' this Blog?"
                            data-description="' . ($next ? 'This content will be visible.' : 'This content will be hidden.') . '"
                            data-bs-toggle="modal"
                            data-bs-target="#statusModal">
                            <label class="switch">
                                <input type="checkbox" ' . $checked . '>
                                <span class="slider round"></span>
                            </label>
                        </a>';
                })

                ->addColumn('action', function (Blog $blog) {
                    return view('components.action-buttons', [
                        'id'     => $blog->id,
                        'show'   => 'admin.blogs.show',
                        'edit'   => 'admin.blogs.edit',
                        'delete' => true,
                    ])->render();
                })

                ->rawColumns(['image', 'is_active', 'action'])
                ->make(true);
        }

        return view('backend.layouts.blog.index');
    }

    public function create()
    {
        return view('backend.layouts.blog.create');
    }

    public function store(BlogRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = uploadFile($request->file('image'), 'uploads/blogs');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('backend.layouts.blog.create', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            deleteFile($blog->image);
            $data['image'] = uploadFile($request->file('image'), 'uploads/blogs');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function show(Blog $blog)
    {
        return view('backend.layouts.blog.show', compact('blog'));
    }

    public function status(Blog $blog)
    {
        $blog->is_active = ! $blog->is_active;
        $blog->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated',
        ]);
    }

    public function destroy(Blog $blog)
    {
        deleteFile($blog->image);
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
