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

use App\Models\Slide;

class SlideController extends Controller
{
    protected $myService;

    public function __construct(MyService $myService)
    {
        $this->myService = $myService;
    }

    //slide

    function selectslide($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = Slide::active()
            ->where('slide_menu', $menuId)
            ->paginate(20);
        $startIndex = ($list->currentPage() - 1) * $list->perPage() + 1;

        return view('admin.slide.slide', compact('title', 'list', 'menuId', 'startIndex'));
    }

    function addslide($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;
        return view('admin.slide.addslide', compact('title', 'menuId'));
    }

    function insertslide(Request $request, $menuId, $category = "")
    {

        $id = DB::table('slide')->insertGetId([
            'slide_title' => $request->topic,
            'slide_link' => $request->link,
            'slide_menu' => $menuId,
            'slide_date_insert' => now(),
        ]);


        if ($request->hasFile('topic_picture')) {
            $file = $request->file('topic_picture');
            $ext = $file->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');

            $folder = "content/{$menuId}"; // path ใน disk 'public'
            $filename = "{$id}_slide_{$timestamp}.{$ext}";
            $path = $file->storeAs($folder, $filename, 'public');

            $fullPath = storage_path('app/public/' . $path);
            if (file_exists($fullPath)) {
                chmod($fullPath, 0644);
            }

            $publicStoragePath = public_path('storage/' . $path);
            if (!file_exists(dirname($publicStoragePath))) {
                mkdir(dirname($publicStoragePath), 0775, true);
            }
            copy($fullPath, $publicStoragePath);
            chmod($publicStoragePath, 0644);

            DB::table('slide')->where('slide_id', $id)
                ->update([
                    'slide_topic_picture' => $path
                ]);
        }

        return redirect('backend/slide/menu/' . $menuId);
    }

    function selectslideone($menuId, $id)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = DB::table('slide')
            ->where('slide_id', $id)
            ->where('slide_display', "A")
            ->first();

        return view('admin.slide.editslide', compact('title', 'list', 'menuId', 'id'));
    }

    function editslide(Request $request, $menuId, $id, $category = "")
    {

        DB::table('slide')
            ->where('slide_id', $id)
            ->update([
                'slide_title' => $request->title,
                'slide_link' => $request->link,
                'slide_date_update' => now()
            ]);

        if ($request->hasFile('topic_picture')) {
            $file = $request->file('topic_picture');
            $ext = $file->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');

            $folder = "content/{$menuId}"; // path ใน disk 'public'
            $filename = "{$id}_slide_{$timestamp}.{$ext}";
            $path = $file->storeAs($folder, $filename, 'public');

            $fullPath = storage_path('app/public/' . $path);
            if (file_exists($fullPath)) {
                chmod($fullPath, 0644);
            }

            $publicStoragePath = public_path('storage/' . $path);
            if (!file_exists(dirname($publicStoragePath))) {
                mkdir(dirname($publicStoragePath), 0775, true);
            }
            copy($fullPath, $publicStoragePath);
            chmod($publicStoragePath, 0644);

            DB::table('slide')->where('slide_id', $id)
                ->update([
                    'slide_topic_picture' => $path
                ]);
        }
        return redirect('backend/slide/menu/' . $menuId);
    }

    function deleteslide($menuId, $id)
    {

        DB::table('slide')->where('slide_id', $id)
            ->update([
                'slide_display' => 'D',
                'slide_date_update' => now()
            ]);
        return redirect('backend/slide/menu/' . $menuId);
    }
}
