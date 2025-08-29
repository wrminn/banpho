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

use App\Models\Texteditor;
use App\Models\Category;


class TexteditorController extends Controller
{

    protected $myService;

    public function __construct(MyService $myService)
    {
        $this->myService = $myService;
    }

    function list($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = Texteditor::active()
            ->where('texteditor_menu', $menuId)
            ->paginate(20);

        $startIndex = ($list->currentPage() - 1) * $list->perPage() + 1;

        return view('admin.list.list', compact('title', 'list', 'menuId', 'startIndex'));
    }

    function add($menuId, $cateID = null)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        return view('admin.list.add', compact('title', 'menuId', 'cateID'));
    }

    function insert(Request $request, $menuId, $category = "")
    {

        $id = DB::table('texteditor')->insertGetId([
            'texteditor_title' => $request->topic,
            'texteditor_date_show' => $request->date,
            'texteditor_category_id' => $category ? $category : 0,
            'texteditor_menu' => $menuId,
            'texteditor_date_insert' => now(),
        ]);

        if (!empty($request->detail)) {
            $data_texteditor_detail = [
                'texteditor_detail' => $request->detail,
                'texteditor_id' => $id,
                'texteditor_detail_seq' => 1,
            ];
            DB::table('texteditor_detail')->insert($data_texteditor_detail);
        }

        if ($request->hasFile('topic_picture')) {

            $file = $request->file('topic_picture');
            $ext = $file->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');

            $folder = "content/{$menuId}"; // path ใน disk 'public'
            $filename = "{$id}_topic_{$timestamp}.{$ext}";
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

            DB::table('texteditor')->where('texteditor_id', $id)
                ->update([
                    'texteditor_topic_picture' => $path
                ]);
        }

        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $key => $file) {

                $ext = $file->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $seq = $key + 1;

                $folder = "content/{$menuId}";
                $filename = "{$id}_list_{$seq}_{$timestamp}.{$ext}";
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

                $data_texteditor_upload = [
                    'texteditor_id'        => $id,
                    'texteditor_upload_seq' => $seq,
                    'texteditor_upload_name' => $file->getClientOriginalName(),
                    'texteditor_upload_file' => $path,
                ];

                DB::table('texteditor_upload')->insert($data_texteditor_upload);
            }
        }

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $key => $file) {

                $ext = $file->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $seq = $key + 1;

                $folder = "content/{$menuId}";
                $filename = "{$id}_list_{$seq}_{$timestamp}.{$ext}";
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


                $data_texteditor_upload = [
                    'texteditor_id'          => $id,
                    'texteditor_upload_seq'  => $seq,
                    'texteditor_upload_name' => $file->getClientOriginalName(),
                    'texteditor_upload_file' => $path,
                ];

                DB::table('texteditor_upload')->insert($data_texteditor_upload);
            }
        }

        if (empty($category)) {
            return redirect('backend/list/menu/' . $menuId);
        } else {
            return redirect('backend/listcat/menu/' . $menuId . '/cate/' . $category);
        }
    }

    function edit($menuId, $id)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;
        $list = DB::table('texteditor')
            ->leftJoin('texteditor_detail', 'texteditor.texteditor_id', '=', 'texteditor_detail.texteditor_id')
            ->where('texteditor.texteditor_id', $id)
            ->first();

        if (!empty($list)) {
            $file = DB::table('texteditor_upload')
                ->where('texteditor_id', $id)
                ->where('texteditor_display', "A")
                ->get()->toArray();
        }
        return view('admin.list.edit', compact('title', 'list', 'file', 'menuId', 'id'));
    }

    function update(Request $request, $menuId, $id, $category = "")
    {

        DB::table('texteditor')
            ->where('texteditor_id', $id)
            ->update([
                'texteditor_title' => $request->topic,
                'texteditor_date_show' => $request->date,
                'texteditor_date_update' => now()
            ]);
        DB::table('texteditor_detail')
            ->where('texteditor_id', $id)
            ->update([
                'texteditor_detail' => $request->detail
            ]);

        if ($request->hasFile('topic_picture')) {

            $file = $request->file('topic_picture');
            $ext = $file->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');

            $folder = "content/{$menuId}"; // path ใน disk 'public'
            $filename = "{$id}_topic_{$timestamp}.{$ext}";
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

            DB::table('texteditor')->where('texteditor_id', $id)
                ->update([
                    'texteditor_topic_picture' => $path
                ]);
        }

        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $key => $file) {

                $ext = $file->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $seq = $key + 1;

                $folder = "content/{$menuId}";
                $filename = "{$id}_list_{$seq}_{$timestamp}.{$ext}";
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

                $data_texteditor_upload = [
                    'texteditor_id'        => $id,
                    'texteditor_upload_seq' => $seq,
                    'texteditor_upload_name' => $file->getClientOriginalName(),
                    'texteditor_upload_file' => $path,
                ];

                DB::table('texteditor_upload')->insert($data_texteditor_upload);
            }
        }

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $key => $file) {

                $ext = $file->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $seq = $key + 1;

                $folder = "content/{$menuId}";
                $filename = "{$id}_list_{$seq}_{$timestamp}.{$ext}";
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


                $data_texteditor_upload = [
                    'texteditor_id'          => $id,
                    'texteditor_upload_seq'  => $seq,
                    'texteditor_upload_name' => $file->getClientOriginalName(),
                    'texteditor_upload_file' => $path,
                ];

                DB::table('texteditor_upload')->insert($data_texteditor_upload);
            }
        }

        return redirect('backend/list/menu/' . $menuId);
    }

    function deletelistid($menuId, $id)
    {
        DB::table('texteditor')->where('texteditor_id', $id)
            ->update([
                'texteditor_display' => 'D',
                'texteditor_date_update' => now()
            ]);
        return redirect('backend/list/menu/' . $menuId);
    }

    function deletelistfile($menuId, $id, $idFile)
    {
        DB::table('texteditor_upload')->where('texteditor_upload_id', $idFile)
            ->update([
                'texteditor_display' => 'D',
            ]);
        return redirect('backend/edit/menu/' . $menuId . '/id/' . $id);
    }

    //category

    function selectcategory($menuId, $cateID = null)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $cate = Category::active()
            ->where('categories_menu', $menuId)
            ->paginate(20);

        $list = Texteditor::active()
            ->where('texteditor_menu', $menuId)
            ->where('texteditor_category_id', $cateID)
            ->paginate(20);

        $startIndex = ($list->currentPage() - 1) * $list->perPage() + 1;
        return view('admin.list.listcategory', compact('title', 'list', 'cate', 'menuId', 'cateID', 'startIndex'));
    }

    function addcategory($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;
        return view('admin.list.addcategory', compact('title', 'menuId'));
    }

    function insertcategory(Request $request, $menuId)
    {

        $id = DB::table('categories')->insertGetId([
            'categories_name' => $request->name_category,
            'categories_menu' => $menuId,
            'categories_date_insert' => now(),
        ]);
        return redirect('backend/listcat/menu/' . $menuId);
    }

    function selectcategorylist($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = Category::active()
            ->where('categories_menu', $menuId)
            ->paginate(20);
        $startIndex = ($list->currentPage() - 1) * $list->perPage() + 1;
        $cateID = 0;

        return view('admin.list.categorylist', compact('title', 'list', 'menuId', 'cateID', 'startIndex'));
    }

    function editcategory($menuId, $id)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;
        $list = DB::table('categories')
            ->where('categories_id', $id)
            ->first();


        return view('admin.list.editcategory', compact('title', 'list', 'menuId', 'id'));
    }
    function updatecategory(Request $request, $menuId, $id)
    {
        DB::table('categories')
            ->where('categories_id', $id)
            ->update([
                'categories_name' => $request->categories_name,
                'categories_date_update' => now()
            ]);
        return redirect('backend/categorylist/menu/' . $menuId);
    }
    function deletecategoryid($menuId, $id)
    {
        DB::table('categories')->where('categories_id', $id)
            ->update([
                'categories_display' => 'D',
                'categories_date_update' => now()
            ]);
        return redirect('backend/categorylist/menu/' . $menuId);
    }
}
