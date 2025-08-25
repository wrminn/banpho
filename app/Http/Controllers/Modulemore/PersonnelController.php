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

use App\Models\Personnel;

class PersonnelController extends Controller
{
    protected $myService;

    public function __construct(MyService $myService)
    {
        $this->myService = $myService;
    }

    function selectdata($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = Personnel::active()
            ->where('personnel_menu', $menuId)
            ->orderBy('personnel_seq', 'asc')
            ->paginate(50);
        $startIndex = ($list->currentPage() - 1) * $list->perPage() + 1;

        return view('admin.personnel.personnel', compact('title', 'list', 'menuId', 'startIndex'));
    }

    function selectdataseq($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $list = Personnel::active()
            ->where('personnel_menu', $menuId)
            ->orderBy('personnel_seq', 'asc')
            ->paginate(50);
        $startIndex = ($list->currentPage() - 1) * $list->perPage() + 1;

        return view('admin.personnel.personnelseq', compact('title', 'list', 'menuId', 'startIndex'));
    }


    function add($menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;
        return view('admin.personnel.addpersonnel', compact('title', 'menuId'));
    }

    function insertpersonnel(Request $request, $menuId, $category = "")
    {

        $latestRecord = Personnel::latest('personnel_id')
            ->where('personnel_menu', $menuId)
            ->first();

        $seq = ($latestRecord['personnel_seq'] ?? 0) + 1;


        $id = DB::table('personnel')->insertGetId([
            'personnel_name' => $request->name,
            'personnel_position' => $request->position,
            'personnel_tel' => $request->tel,
            'personnel_menu' => $menuId,
            'personnel_date_insert' => now(),
            'personnel_seq' => $seq,
        ]);


        if ($request->hasFile('personnel_img')) {

            $file = $request->file('personnel_img');
            $ext = $file->getClientOriginalExtension();

            // สร้างชื่อกลาง
            $timestamp = now()->format('Ymd_His');

            $folder = "/content/{$menuId}";
            $filename = "{$id}_personnel_{$timestamp}.{$ext}";
            $path = $file->storeAs($folder, $filename, 'public');

            DB::table('personnel')->where('personnel_id', $id)
                ->update([
                    'personnel_path' => $path
                ]);
        }

        return redirect('backend/personnel/menu/' . $menuId);
    }

    function updateseqpersonnel(Request $request, $menuId)
    {
        $titles = $this->myService->getDataByKey($menuId);
        $title = $titles ?? 'ข้อมูลเมนู' . $menuId;

        $data = $request->input('users');

        foreach ($data as $item) {

            Personnel::where('personnel_menu', $menuId)
                ->where('personnel_id', $item['id'])
                ->update(
                    [
                        'personnel_seq' => $item['seq'],
                        'personnel_date_update' => now()
                    ]
                );
        }

        return response()->json(['status' => 'success']);
        // return view('admin.personnel.addpersonnel', compact('title', 'menuId'));
    }
}
