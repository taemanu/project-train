<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cate = Categories::all();
        $stock = stock::all();
        return view('warehouse.stock',compact('cate','stock'));
    }

    public function fetch(Request $request)
    {
        $id = $request->get('cate_id');
        $result = array();
        $querys = DB::table('products')
        ->join('categories','categories.id','=','products.cate_id')
        ->select('products.id','products.pd_name','products.pd_amount')
        ->where('categories.id',$id)
        ->get();

        $output = '<option value="">เลือกสินค้า</option>';

        foreach ($querys as $value) {
            $output .='<option value="'.$value->id.'">'.$value->pd_name.'</option>';
        }

        echo $output;

    }

    public function updatestock(Request $request)
    {
        $request->validate([
            'product' => 'required',
        ],[
            'product.required' => "กรุณาเลือก ' เลือกสินค้า '",
        ]);

        $pd = Product::find($request->product);
        $old_amount = $pd->pd_amount;

        if ($request->status == 1) {
            $new_amount = $old_amount + $request->amount;
        }else{
            $new_amount = $old_amount - $request->amount;
        }

        $pd->update([
            'pd_amount' => $new_amount,
        ]);

        $stock = new stock();
        $stock->pd_id = $request->product;
        $stock->user_id = Auth::user()->id;
        $stock->before_amount = $old_amount;
        $stock->stock_amount = $request->amount;
        $stock->after_amount = $new_amount;
        $stock->status_status = $request->status;
        $stock->save();


        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }


}


