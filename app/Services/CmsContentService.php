<?php
namespace App\Services;

use App\Enum\Section;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\CmsContent;
use App\Models\CmsContentItem;
use App\Models\SocialMedia;
use App\Models\SystemSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CmsContentService
{
    public function getPageContent(string $page): array
    {
        $contents = CmsContent::with('items')
            ->where('page', $page)
            ->active()
            ->orderBy('id', 'asc')
            ->get();

        $response   = [];
        $pageConfig = config("cms_sections.{$page}", []);

        foreach ($contents as $content) {
            $section       = $content->section;
            $sectionConfig = $pageConfig[$section] ?? [];

            $allowedFields = $sectionConfig['fields'] ?? [];
            $allowedItems  = $sectionConfig['items'] ?? [];

            // Filter main fields
            $filteredContent = [];
            foreach ($allowedFields as $field) {
                $filteredContent[$field] = $content->$field;
            }

            //  Call reusable section switch
            $items = $this->resolveSectionItems($section);

            // If switch didn't handle section → dynamic filtering
            if ($items === null) {
                $items = $content->items->map(function ($item) use ($allowedItems) {
                    $filteredItem = [];
                    foreach ($allowedItems as $field) {
                        $filteredItem[$field] = $item->$field;
                    }
                    return $filteredItem;
                });
            }

            $filteredContent['items'] = $items;
            $response[$section]       = $filteredContent;

            // check item empty
            $this->removeIfEmpty($response[$section], 'items');
        }

        return $response;
    }

    public function getSectionContent(string $page, string $section)
    {
        $sectionData = CmsContent::where('page', $page)
            ->where('section', $section)
            ->with('items')
            ->first();

        if (! $sectionData) {
            throw new ModelNotFoundException("Section '{$section}' not found on page '{$page}'");
        }

        $sectionConfig = config("cms_sections.{$page}.{$section}", []);

        $allowedFields = $sectionConfig['fields'] ?? [];
        $allowedItems  = $sectionConfig['items'] ?? [];

        // Filter fields
        $filteredContent = [];
        foreach ($allowedFields as $field) {
            $filteredContent[$field] = $sectionData->$field;
        }

        //  Call reusable section switch
        $items = $this->resolveSectionItems($section);

        if ($items === null) {
            $items = $sectionData->items->map(function ($item) use ($allowedItems) {
                $filteredItem = [];
                foreach ($allowedItems as $field) {
                    $filteredItem[$field] = $item->$field;
                }
                $filteredItem['id'] = $item->id;
                return $filteredItem;
            });
        }

        $filteredContent['items'] = $items;

        $this->removeIfEmpty($filteredContent, 'items');

        return $filteredContent;
    }

    // Store new CMS Content with related items.

    public function store(array $data)
    {
        if (isset($data['background_image']) && is_object($data['background_image'])) {
            $data['background_image'] = uploadFile($data['background_image'], 'uploads/cms/backgrounds');
        }

        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = uploadFile($data['image'], 'uploads/cms/images');
        }
        // video
        if (isset($data['video']) && is_object($data['video'])) {
            $data['video'] = uploadFile($data['video'], 'uploads/cms/videos');
        }

        $items = $data['items'] ?? [];
        unset($data['items']);

        return DB::transaction(function () use ($data, $items) {
            $content = CmsContent::create($data);

            foreach ($items as $item) {
                if (isset($item['image']) && is_object($item['image'])) {
                    $item['image'] = uploadFile($item['image'], 'uploads/cms/items', (string) Str::uuid());
                }
                // icon and hover video
                if (isset($item['icon']) && is_object($item['icon'])) {
                    $item['icon'] = uploadFile($item['icon'], 'uploads/cms/items', (string) Str::uuid());
                }
                if (isset($item['hover_video']) && is_object($item['hover_video'])) {
                    $item['hover_video'] = uploadFile($item['hover_video'], 'uploads/cms/items', (string) Str::uuid());
                }
                $content->items()->create($item);
            }

            return $content;
        });
    }

    // Update an existing CMS Content and sync its items.

    public function update(CmsContent $cms_content, array $data)
    {
        return DB::transaction(function () use ($cms_content, $data) {
            if (isset($data['background_image']) && is_object($data['background_image'])) {
                deleteFile($cms_content->background_image);
                $data['background_image'] = uploadFile($data['background_image'], 'uploads/cms/backgrounds');
            }

            if (isset($data['image']) && is_object($data['image'])) {
                deleteFile($cms_content->image);
                $data['image'] = uploadFile($data['image'], 'uploads/cms/images');
            }

            if (isset($data['video']) && is_object($data['video'])) {
                deleteFile($cms_content->video);
                $data['video'] = uploadFile($data['video'], 'uploads/cms/videos');
            }

            $itemsData = $data['items'] ?? [];
            unset($data['items']);

            $cms_content->update($data);

            $existingIds  = $cms_content->items()->pluck('id')->toArray();
            $submittedIds = array_filter(array_column($itemsData, 'id'));
            $deleteIds    = array_diff($existingIds, $submittedIds);

            if (! empty($deleteIds)) {
                CmsContentItem::whereIn('id', $deleteIds)->each(function ($item) {
                    deleteFile($item->image);
                    $item->delete();
                });
            }

            foreach ($itemsData as $itemData) {
                $isUpdating = ! empty($itemData['id']);
                $item       = $isUpdating ? CmsContentItem::find($itemData['id']) : null;

                if (isset($itemData['image']) && is_object($itemData['image'])) {
                    if ($item) {
                        deleteFile($item->image);
                    }

                    $itemData['image'] = uploadFile($itemData['image'], 'uploads/cms/items', (string) Str::uuid());
                } else {
                    unset($itemData['image']);
                }
                // icon and hover video
                if (isset($itemData['icon']) && is_object($itemData['icon'])) {
                    if ($item) {
                        deleteFile($item->icon);
                    }

                    $itemData['icon'] = uploadFile($itemData['icon'], 'uploads/cms/items', (string) Str::uuid());
                } else {
                    unset($itemData['icon']);
                }
                if (isset($itemData['hover_video']) && is_object($itemData['hover_video'])) {
                    if ($item) {
                        deleteFile($item->hover_video);
                    }

                    $itemData['hover_video'] = uploadFile($itemData['hover_video'], 'uploads/cms/items', (string) Str::uuid());
                } else {
                    unset($itemData['hover_video']);
                }

                $item ? $item->update($itemData) : $cms_content->items()->create($itemData);
            }

            return $cms_content;
        });
    }

    // Delete CMS content and its related assets.

    public function destroy(CmsContent $cms_content)
    {
        DB::transaction(function () use ($cms_content) {
            deleteFile($cms_content->background_image);
            deleteFile($cms_content->image);

            foreach ($cms_content->items as $item) {
                deleteFile($item->image);
                $item->delete();
            }

            $cms_content->delete();
        });
    }

    private function resolveSectionItems(string $section)
    {
        switch ($section) {
            case Section::FOOTER_SECTION->value:
                return [
                    'social_media' => SocialMedia::all(),
                    'settings'     => SystemSetting::first(),
                ];

            case Section::TRUSTED_PARTNERS_SECTION->value:
                return Brand::query()->active()->get(['name', 'logo', 'website_url']);

            case Section::TESTIMONIALS_SECTION->value:
                return Testimonial::query()->active()->latest()->limit(10)->get();

            case Section::TEAM_SECTION->value:
                return TeamMember::query()->latest()->get();
                
            case Section::BLOG_SECTION->value:
                return Blog::query()->active()->latest()->limit(3)->get(['id', 'title', 'short_description', 'image']);

        }

        return null;
    }

    private function removeIfEmpty(&$filteredContent, $key = 'items')
    {
        if (! array_key_exists($key, $filteredContent)) {
            return;
        }

        $value = $filteredContent[$key];

        // Collection empty
        if ($value instanceof \Illuminate\Support\Collection  && $value->isEmpty()) {
            unset($filteredContent[$key]);
            return;
        }

        // Array empty
        if (is_array($value) && empty($value)) {
            unset($filteredContent[$key]);
            return;
        }

        // Null or false
        if (empty($value)) {
            unset($filteredContent[$key]);
        }
    }
}
