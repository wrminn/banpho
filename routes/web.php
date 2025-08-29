<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Modulemore\TexteditorController;
use App\Http\Controllers\Modulemore\BannerController;
use App\Http\Controllers\Modulemore\SlideController;
use App\Http\Controllers\Modulemore\PersonnelController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('backend', [AdminController::class, 'backend'])->name('backend');

    //list
    Route::get('backend/list/menu/{menu}', [TexteditorController::class, 'list'])->name('list');
    Route::get('backend/add/menu/{menu}', [TexteditorController::class, 'add'])->name('list.ncate');
    Route::get('backend/add/menu/{menu}/cate/{cate}', [TexteditorController::class, 'add'])->name('list.cate');
    Route::post('backend/add/menu/{menu}', [TexteditorController::class, 'insert'])->name('texteditor.insert');
    Route::post('backend/add/menu/{menu}/cate/{cate}', [TexteditorController::class, 'insert'])->name('texteditor.insert.cate');
    Route::get('backend/edit/menu/{menu}/id/{id}', [TexteditorController::class, 'edit'])->name('listedit');
    Route::post('backend/update/menu/{menu}/id/{id}', [TexteditorController::class, 'update'])->name('texteditor.update');
    Route::get('backend/deletelistid/menu/{menu}/id/{id}', [TexteditorController::class, 'deletelistid'])->name('delete.list');
    Route::get('backend/deletelistfile/menu/{menu}/id/{id}/idfile/{idfile}', [TexteditorController::class, 'deletelistfile'])->name('delete.listfile');

    //listcategory
    Route::get('backend/listcat/menu/{menu}/cate/{cate}', [TexteditorController::class, 'selectcategory'])->name('list.category');
    Route::get('backend/categorylist/menu/{menu}', [TexteditorController::class, 'selectcategorylist']);
    Route::get('backend/addcategory/menu/{menu}', [TexteditorController::class, 'addcategory']);
    Route::post('backend/addcategory/menu/{menu}', [TexteditorController::class, 'insertcategory'])->name('category.insert');
    Route::get('backend/editcategory/menu/{menu}/id/{id}', [TexteditorController::class, 'editcategory'])->name('category.edit');
    Route::post('backend/updatecategory/menu/{menu}/id/{id}', [TexteditorController::class, 'updatecategory'])->name('category.update');
    Route::get('backend/deletecategoryid/menu/{menu}/id/{id}', [TexteditorController::class, 'deletecategoryid'])->name('category.delete');

    //texteditor
    Route::get('backend/listtexteditor/menu/{menu}', [AdminController::class, 'listtexteditor'])->name('listtexteditor.menu');
    Route::post('backend/listtexteditor/menu/{menu}', [AdminController::class, 'inserttexteditor'])->name('listtexteditor.insert');
    Route::get('backend/deletefile/menu/{menu}/id/{id}', [AdminController::class, 'deletetexteditorfile'])->name('delete.filetexteditor');

    //banner
    Route::get('backend/banner/menu/{menu}', [BannerController::class, 'selectbanner'])->name('selectbanner');
    Route::get('backend/addbanner/menu/{menu}', [BannerController::class, 'addbanner'])->name('addbanner');
    Route::post('backend/addbanner/menu/{menu}', [BannerController::class, 'insertbanner'])->name('banner.insert');
    Route::get('backend/editbanner/menu/{menu}/id/{id}', [BannerController::class, 'selectbannerone'])->name('bannerone');
    Route::post('backend/editbanner/menu/{menu}/id/{id}', [BannerController::class, 'editbanner'])->name('editbannerone');
    Route::get('backend/deletebanner/menu/{menu}/id/{id}', [BannerController::class, 'deletebanner'])->name('deletebannerone');

    //slide
    Route::get('backend/slide/menu/{menu}', [SlideController::class, 'selectslide'])->name('selectslide');
    Route::get('backend/addslide/menu/{menu}', [SlideController::class, 'addslide'])->name('addslide');
    Route::post('backend/addslide/menu/{menu}', [SlideController::class, 'insertslide'])->name('slide.insert');
    Route::get('backend/editslide/menu/{menu}/id/{id}', [SlideController::class, 'selectslideone'])->name('slideone');
    Route::post('backend/editslide/menu/{menu}/id/{id}', [SlideController::class, 'editslide'])->name('editslideone');
    Route::get('backend/deletesilde/menu/{menu}/id/{id}', [SlideController::class, 'deleteslide'])->name('deleteslideid');

    //personnel
    Route::get('backend/personnel/menu/{menu}', [PersonnelController::class, 'selectdata'])->name('selectpersonnel');
    Route::get('backend/addpersonnel/menu/{menu}', [PersonnelController::class, 'add']);
    Route::post('backend/addpersonnel/menu/{menu}', [PersonnelController::class, 'insertpersonnel'])->name('personnel.insert');
    Route::get('backend/editpersonnel/menu/{menu}/id/{id}', [PersonnelController::class, 'selectpersonnelid'])->name('personnel.edit');
    Route::post('backend/editpersonnel/menu/{menu}/id/{id}', [PersonnelController::class, 'editpersonnel'])->name('editpersonnelone');
    Route::get('backend/deletepersonnel/menu/{menu}/id/{id}', [PersonnelController::class, 'deletepersonnel'])->name('deletepersonnelid');
    Route::get('backend/personnelseq/menu/{menu}', [PersonnelController::class, 'selectdataseq']);
    Route::post('backend/personnelseq/menu/{menu}', [PersonnelController::class, 'updateseqpersonnel'])->name('updateseqpersonnel');
});

Route::get('complaint/menu/{menu}', [ComplaintController::class, 'index'])->name('complaint');
