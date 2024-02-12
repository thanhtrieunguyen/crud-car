<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use Validator;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

// IMAGE==========
// ===============
use Illuminate\Http\Request;
use App\Models\Xe;
use App\Models\DongXe;
use App\Models\HangXe;
use App\Models\HinhXe;

class XeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $xes = Xe::with('dongXe', 'hangXe', 'hinhXe')
            ->latest()
            ->get();
        return view(
            'admin.xe.index',
            compact(
                'xes'
            )
        );
    }

    public function create()
    {
        $dongXe = DongXe::all();
        $hangXe = HangXe::all();
        return view('admin.xe.create', compact('dongXe', 'hangXe'));
    }

    public function store(StoreRequest $request)
    {

        // $string1 = '["https:\/\/res.cloudinary.com\/dr3b2kgb1\/image\/upload\/v1707563147\/f3wwo5kxddbtqgnhjpbv.png"]';
        // $array = json_decode($string1, true);
        // dd($array);

        $hinhXes = [];
        foreach ($request->file('hinhxe') as $hinh) {

            $uploadedFileUrl = cloudinary()->upload($hinh->getRealPath())->getSecurePath();

            array_push($hinhXes, $uploadedFileUrl);
            // Store the secure URL in your array

        }
        $hinhXeJsonString = json_encode($hinhXes);
        $hinhXe = HinhXe::create(['hinhxe' => $hinhXeJsonString]);



        $idhinhxe = $hinhXe->idhinhxe;

        $xeData = $request->except('hinhxe');
        $xeData['idhinhxe'] = $idhinhxe;
        $xe = Xe::create($xeData);

        return back()->with(['thong-bao' => 'Thêm xe ' . $xe->tenxe . ' thành công!', 'type' => 'success'])->with('loader', true);
        ;
    }


    public function edit($id)
    {
        $xe = Xe::findOrFail($id);
        $dongXe = DongXe::all();
        $hangXe = HangXe::all();

        $hinhXeStr = HinhXe::find($xe->idhinhxe);
        $hinhXeArr = json_decode($hinhXeStr->hinhxe);

        return view('admin.xe.edit', compact('xe', 'dongXe', 'hangXe', 'hinhXeArr'));

    }

    public function update(Request $request, $id)
    {
        // Lấy thông tin xe cần update
        $xe = Xe::findOrFail($id);

        // Lấy hình xe cũ
        $oldHinhXe = HinhXe::find($xe->idhinhxe);
        $oldHinhXeArr = json_decode($oldHinhXe->hinhxe);

        // Lưu hình xe mới
        $newHinhXes = [];

        foreach ($request->file('hinhxe') as $hinh) {

            $uploadedFileUrl = cloudinary()->upload($hinh->getRealPath())->getSecurePath();

            array_push($newHinhXes, $uploadedFileUrl);
            // Store the secure URL in your array
        }

        // dd($newHinhXes);

        // Ghép mảng hình cũ và mới
        $allHinhXes = array_merge($oldHinhXeArr, $newHinhXes);

        // Cập nhật lại hình xe
        $newHinhXeJson = json_encode($allHinhXes);
        $oldHinhXe->hinhxe = $newHinhXeJson;
        $oldHinhXe->save();

        // Cập nhật các trường khác
        $xeData = $request->except('hinhxe');
        $xe->update($xeData);

        // Trả về kết quả
        return redirect('admin/xe')->with('success', 'Cập nhật xe thành công');
    }

    public function destroy($id)
    {
        $xe = Xe::findOrFail($id);

        $xe->hinhXe()->delete();

        $xe->delete();

        return back()->with(['thong-bao' => 'Xóa xe ' . $xe->tenxe . ' thành công!', 'type' => 'success']);
    }



}
