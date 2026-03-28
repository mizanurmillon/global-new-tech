<?php
namespace App\Http\Controllers\Api\V1;

use App\Enum\Page;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\CmsContentService;
use App\Traits\ApiResponse;

class CmsContentController extends Controller
{
    use ApiResponse;

    protected CmsContentService $cmsService;

    public function __construct(CmsContentService $cmsService)
    {
        $this->cmsService = $cmsService;
    }

    public function getPageContent(string $page)
    {
        try {
            $content = $this->cmsService->getPageContent($page);
            if ($page == Page::PARTNER->value) {
                $content['trusted_partners'] = Brand::query()->active()->get();
            }
            return $this->success($content, "Page content fetched successfully");
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage());
        }
    }

    public function getSectionContent($page, $section)
    {
        try {
            $content = $this->cmsService->getSectionContent($page, $section);
            return $this->success($content, "Section '{$section}' content fetched successfully");
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage());
        }
    }
}
