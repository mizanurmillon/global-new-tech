<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CoreService;
use App\Models\Technology;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = CoreService::query()->active()->latest();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('service_title', 'like', "%{$search}%")
                    ->orWhere('service_subtitle', 'like', "%{$search}%");
            });
        }

        $blogs = $query->paginate((int) $request->get('per_page', 15))->appends($request->query());

        return $this->success($blogs, "Blogs fetched successfully.");
    }

    public function show(string $coreService)
    {
        $coreService = CoreService::where('slug', $coreService)->active()->firstOrFail();

        $coreService->load(['serviceValues', 'subServices', 'howToWorkServices']);

        $technologies = Technology::query()->active()->get(['title', 'icon']);

        $data = [
            'service'      => $coreService,
            'technologies' => $technologies,
        ];

        return $this->success($data, "Core service details fetched successfully");
    }

}
