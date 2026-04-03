<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Blog::query()->active()->latest();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $blogs = $query->paginate((int) $request->get('per_page', 15))->appends($request->query());

        return $this->success($blogs, "Blogs fetched successfully.");
    }

    public function show(Blog $blog)
    {
        return $this->success($blog, "Blog details fetched successfully");
    }

}
