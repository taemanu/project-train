<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $categories = Categories::all();
        $product = Product::all();

        return view('products.product', compact('categories', 'product'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'pd_code' => 'required|unique:Products|max:255',
            'pd_name' => 'required|unique:Products|max:255',
            'pd_image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'pd_code.required' => "กรุณาป้อน ' รหัสสินค้า '",
                'pd_code.max' => "ห้ามป้อนเกินที่กำหนดไว้",
                'pd_code.unique' => "ข้อมูล ' รหัสสินค้า ' ซ้ำ",

                'pd_name.required' => "กรุณาป้อน ' ชื่อสินค้า '",
                'pd_name.max' => "ห้ามป้อนเกินที่กำหนดไว้",
                'pd_name.unique' => "ข้อมูล ' ชื่อสินค้า ' ซ้ำ",

                'pd_image.required' => "กรุณาอัพโหลดรูปภาพเข้ามา",
            ]
        );

        //การเข้ารหัสรูปภาพ
        $pd_image = $request->file('pd_image');

        //generate ชื่อภาพ
        $name_gen = hexdec(uniqid());

        // ดึงนามสกุลรูปภาพ
        $img_ext = strtolower($pd_image->getClientOriginalExtension());

        //รวม ชื่อใหม่ กับ นามสกุล
        $img_name = $name_gen . '.' . $img_ext;

        // การ อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/product/';
        $full_path = $upload_location . $img_name;
        // dd($request->pd_image);

        $product = new Product;
        $product->pd_code = $request->input('pd_code');
        $product->pd_name = $request->input('pd_name');
        $product->pd_price = $request->input('pd_price');
        $product->pd_amount = $request->input('pd_amount');
        $product->pd_minimum = $request->input('pd_minimum');
        $product->cate_id = $request->input('cate');
        $product->status = $request->input('Status');
        $product->pd_image = $full_path;
        $product->save();

        //อัพโหลดไป public
        $pd_image->move($upload_location, $img_name);

        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");

    }

    public function update_pd(Request $request , $id)
    {
        $request->validate([
            'pd_code' => 'required|max:255|unique:Products,pd_code,'.$id,
            'pd_name' => 'required|max:255|unique:Products,pd_name,'.$id,
            'pd_image' => 'mimes:jpg,jpeg,png'
        ],[
            'pd_code.required' => "กรุณาป้อน ' รหัสสินค้า '",
            'pd_code.max' => "ห้ามป้อนเกินที่กำหนดไว้",
            'pd_code.unique' => "ข้อมูล ' รหัสสินค้า ' ซ้ำ",

            'pd_name.required' => "กรุณาป้อน ' ชื่อสินค้า '",
            'pd_name.max' => "ห้ามป้อนเกินที่กำหนดไว้",
            'pd_name.unique' => "ข้อมูล ' ชื่อสินค้า ' ซ้ำ",

            'pd_image.mimes' => 'อัพโหลดไฟล์นามสกุล jpg, jpeg, png เท่านั้น'

        ]);


                //การเข้ารหัสรูปภาพ
                $product_image = $request->file('pd_image');

                //อัพเดทภาพและชื่อ
                if($product_image){
                                    //การเข้ารหัสรูปภาพ
                                    $product_image = $request->file('pd_image');

                                    //generate ชื่อภาพ
                                    $name_gen = hexdec(uniqid());

                                    // ดึงนามสกุลรูปภาพ
                                    $img_ext = strtolower($product_image->getClientOriginalExtension());

                                    //รวม ชื่อใหม่ กับ นามสกุล
                                    $img_name = $name_gen.'.'.$img_ext;


                                    // การ อัพโหลดและบันทึกข้อมูล
                                    $upload_location = 'image/product/';
                                    $full_path = $upload_location.$img_name;



                                    //บันทึกข้อมูลรูปภาพไป DB
                                    Product::find($id)->update([
                                        "pd_code" => $request->pd_code,
                                        "pd_name" => $request->pd_name,
                                        "pd_price" => $request->pd_price,
                                        "pd_amount" => $request->pd_amount,
                                        "pd_minimum" => $request->pd_minimum,
                                        "cate_id" => $request->cate,
                                        "status" => $request->Status,
                                        'pd_image' => $full_path,
                                    ]);

                                    //ลบภาพเก่า ภาพใหม่มาแทน
                                    $old_image = $request->old_image;
                                    unlink($old_image);

                                    //อัพโหลดไป public
                                    $product_image ->move($upload_location,$img_name);

                                    return redirect()->back()->with('success',"อัพเดทข้อมูลเรียบร้อย");

                }else{
                    //อัพเดทชื่ออย่างเดียว
                    Product::find($id)->update([
                        "pd_code" => $request->pd_code,
                        "pd_name" => $request->pd_name,
                        "pd_price" => $request->pd_price,
                        "pd_amount" => $request->pd_amount,
                        "pd_minimum" => $request->pd_minimum,
                        "cate_id" => $request->cate,
                        "status" => $request->Status,
                    ]);
                    return redirect()->back()->with('success',"อัพเดทข้อมูลเรียบร้อย");
                }


    }

    public function delete_pd(Request $request)
    {


        $pd = Product::find($request->idpd);

        unlink($pd->pd_image);

        $pd->delete();


        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function cart(Request $request){
        $products = Product::all()->where('status', true);
        return view('sale.cart', compact('products'));
    }

}
