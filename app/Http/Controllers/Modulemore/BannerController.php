<?php

namespace App\Http\Controllers\Modulemore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Banner;

class BannerController extends Controller
{
    protected $myService;

    public function __construct(MyService $myService)
    {
        $this->myService = $myService;
    }

    //banner

    function selectbanner($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = Banner::active()
            ->where('Banner_menu', $menuId)
            ->paginate(20);
        $startIndex = ($list->currentPage() - 1) * $list->perPage() + 1;

        return view('admin.banner.banner', compact('title', 'list', 'menuId', 'startIndex'));
    }

    function addbanner($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;
        return view('admin.banner.addbanner', compact('title', 'menuId'));
    }

    function insertbanner(Request $request, $menuId, $category = "")
    {

        $id = DB::table('banner')->insertGetId([
            'banner_title' => $request->topic,
            'banner_link' => $request->link,
            'banner_menu' => $menuId,
            'banner_date_insert' => now(),
        ]);


        if ($request->hasFile('topic_picture')) {

            $file = $request->file('topic_picture');
            $ext = $file->getClientOriginalExtension();

            // สร้างชื่อกลาง
            $timestamp = now()->format('Ymd_His');

            $folder = "/content/{$menuId}";
            $filename = "{$id}_topicbanner_{$timestamp}.{$ext}";
            $path = $file->storeAs($folder, $filename, 'public');

            DB::table('banner')->where('banner_id', $id)
                ->update([
                    'banner_topic_picture' => $path
                ]);
        }

        return redirect('backend/banner/menu/' . $menuId);
    }

    function selectbannerone($menuId, $id)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = DB::table('banner')
            ->where('banner_id', $id)
            ->where('banner_display', "A")
            ->first();

        return view('admin.banner.editbanner', compact('title', 'list', 'menuId', 'id'));
    }

    function editbanner(Request $request, $menuId, $id, $category = "")
    {

        DB::table('banner')
            ->where('banner_id', $id)
            ->update([
                'banner_title' => $request->title,
                'banner_link' => $request->link,
                'banner_date_update' => now()
            ]);

        if ($request->hasFile('topic_picture')) {

            $file = $request->file('topic_picture');
            $ext = $file->getClientOriginalExtension();

            // สร้างชื่อกลาง
            $timestamp = now()->format('Ymd_His');

            $folder = "/content/{$menuId}";
            $filename = "{$id}_banner_{$timestamp}.{$ext}";
            $path = $file->storeAs($folder, $filename, 'public');

            DB::table('banner')->where('banner_id', $id)
                ->update([
                    'banner_topic_picture' => $path
                ]);
        }


        return redirect('backend/banner/menu/' . $menuId);
    }

    function deletebanner($menuId, $id)
    {

        DB::table('banner')->where('banner_id', $id)
            ->update([
                'banner_display' => 'D',
                'banner_date_update' => now()
            ]);
        return redirect('backend/banner/menu/' . $menuId);
    }
}
