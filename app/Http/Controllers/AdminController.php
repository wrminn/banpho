<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    protected $myService;

    public function __construct(MyService $myService)
    {
        $this->middleware('auth');
        $this->myService = $myService;
    }

    function index() {}

    function backend()
    {
        return view('admin.backend');
    }


    // เมนูหน้าเดียว

    function listtexteditor($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $file = null;
        $list = DB::table('texteditor')
            ->where('texteditor_menu', $menuId)
            ->first();

        if (!empty($list)) {

            $list = DB::table('texteditor_detail')
                ->where('texteditor_id', $list->texteditor_id)
                ->first();

            $file = DB::table('texteditor_upload')
                ->where('texteditor_id', $list->texteditor_id)
                ->where('texteditor_display', "A")
                ->get()->toArray();
        }

        return view('admin.texteditor.listtexteditor', compact('title', 'list', 'file', 'menuId'));
    }

    function inserttexteditor(Request $request, $menuId, $category = "")
    {

        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = DB::table('texteditor')
            ->where('texteditor_menu', $menuId)
            ->first();

        if (!empty($list)) {
            $filename = null;
            $data_texteditor = [
                'texteditor_detail' => $request->detail,
            ];
            DB::table('texteditor')->where('texteditor_id', $list->texteditor_id)
                ->update([
                    'texteditor_date_update' => now()
                ]);
            DB::table('texteditor_detail')->where('texteditor_id', $list->texteditor_id)
                ->update([
                    'texteditor_detail' => $request->detail
                ]);
        } else {
            $data_texteditor = [
                'texteditor_title' => $title,
                'texteditor_category_id' =>  $category ? $category : 0,
                'texteditor_menu' => $menuId,
            ];
            DB::table('texteditor')->insert($data_texteditor);

            $list_select = DB::table('texteditor')
                ->where('texteditor_menu', $menuId)
                ->first();

            $data_texteditor_detail = [
                'texteditor_detail' => $request->detail,
                'texteditor_id' => $list_select->texteditor_id,
            ];
            DB::table('texteditor_detail')->insert($data_texteditor_detail);
        }

        if ($request->hasFile('file')) {

            $list_select = DB::table('texteditor')
                ->where('texteditor_menu', $menuId)
                ->where('texteditor_display', 'A')
                ->first();

            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            // สร้างชื่อกลาง
            $timestamp = now()->format('Ymd_His');

            $folder = "/content/{$menuId}";
            $filename = "{$list_select->texteditor_id}_default_{$timestamp}.{$ext}";
            $path = $file->storeAs($folder, $filename, 'public');

            $data_texteditor_upload = [
                'texteditor_id' => $list_select->texteditor_id,
                'texteditor_upload_seq' => "1",
                'texteditor_upload_name' => $file->getClientOriginalName(),
                'texteditor_upload_file' => $path,
            ];
            DB::table('texteditor_upload')->insert($data_texteditor_upload);
        }

        return redirect('backend/listtexteditor/menu/' . $menuId);
    }

    function deletetexteditorfile($menuId, $id)
    {
        DB::table('texteditor_upload')->where('texteditor_upload_id', $id)
            ->update([
                'texteditor_display' => 'D',
            ]);
        return redirect('backend/listtexteditor/menu/' . $menuId);
    }

}
