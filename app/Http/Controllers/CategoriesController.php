<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        $request->validate([
            'cate_name' => 'required|unique:Categories|max:255',
        ],
            [
                'cate_name.required' => "กรุณาป้อนข้อมูลเข้ามา",
                'cate_name.max' => "ห้ามป้อนเกินที่กำหนดไว้",
                'cate_name.unique' => "ข้อมูลที่บันทึกซ้ำ",
            ]
        );

        $categories = new Categories;
        $categories->cate_name = $request->input('cate_name');
        $categories->status = 1;
        $categories->save();

        return redirect()->back()->withInput(['tab' => 'category'])->with('success', "บันทึกข้อมูลเรียบร้อย");

    }


    public function update_cate(Request $request, $id)
    {
        $request->validate([
            'cate_name'=>'required|max:255|unique:Categories,cate_name,'.$id,
        ],

        [
            'cate_name.required'=>"กรุณาป้อมข้อมูลเข้ามา",
            'cate_name.max'=>"ห้ามป้อนเกินที่กำหนดไว้",
            'cate_name.unique'=>"ข้อมูลที่บันทึกมีอยู่แล้ว"
        ]
        );

        categories::find($id)->update([
            'cate_name' => $request->cate_name,
            'status' => 1,
        ]);

        // dd($request->cate_name, $request->Status);

        return redirect()->back()->withInput(['tab' => 'category'])->with('success', "อัพเดทข้อมูลเรียบร้อย");
    }

    public function delete_cate(Request $request, $id){

        $cate = Categories::find($request->idcate);
        $cate->delete();

        // dd($request->idcate);
        return redirect()->back()->withInput(['tab' => 'category'])->with('success', "ลบข้อมูลเรียบร้อย");
    }

}
