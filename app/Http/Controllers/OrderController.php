<?php

namespace App\Http\Controllers;

use App;
use App\Models\Order;
use App\Models\Order_detail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use PDF;


class OrderController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $orders = Order::all();
        $order_detail = order_detail::all();
        return view('sale.order', compact('orders','order_detail'));
    }

    public function saveCart(Request $request ){

        $request->validate([
            'product_id' => 'required',
        ],[
            'product_id.required' => "กรุณาเลือก ' เลือกสินค้า '",
        ]);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $latestOrder = App\Models\Order::orderBy('created_at','DESC')->first();
        $order->code = '#'.date('Y-m-d').'-'.str_pad($latestOrder->id + 1, 6, "0", STR_PAD_LEFT);
        //$order->code = date('Y-m-d H:i:s');
        $order->money_received = $request->input('money_received');
        $order->change = $request->input('change');
        $order->total_price = $request->input('total_price');
        $order->total_item = $request->input('total_item');
        $order->date = date('Y-m-d H:i:s');
        $order->save();
        // dd($order);

        foreach($request->product_id as $key=>$value){
            //dd($value);
            $order_detail = new Order_detail();
            $order_detail->product_id = $request->product_id[$key];
            $order_detail->order_id = $order->id;
            $order_detail->amount = $request->product_qty[$key];
            $order_detail->price = $request->product_item_price[$key];
            $order_detail->save();

            $pd = Product::find($request->product_id[$key]);
            $old_amount = $pd->pd_amount;

            $new_amount = $old_amount - $request->product_qty[$key];


            $pd->update([
                'pd_amount' => $new_amount,
            ]);

        }
        //dd($order_detail);
        //dd($request->product_id,$request->product_qty,$request->product_price);
        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");

    }

    public function editstatus(Request $request,$id){

        // dd($id,$request->Status);

        Order::find($id)->update([
            'status' => $request->Status,
        ]);

        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }

    public function order_detail(Request $request)
    {

        $id = $request->order_id;
        $order_details = Order::leftjoin('order_details','order_details.order_id','=','orders.id')
        ->leftjoin('products','products.id','=','order_details.product_id')
        ->leftjoin('users','users.id','=','orders.user_id')
        ->select('users.first_name','users.last_name','orders.change','orders.money_received','order_details.product_id',
        'order_details.amount','order_details.price','products.pd_name','products.pd_price','products.pd_image'
        )
        ->where('order_details.order_id',$id)
        ->get();

        $showorder = Order::where('id','=',$id)->first();

        $sumprice = DB::table("order_details") ->where('order_details.order_id',$id)->sum('price');
        $sumamount = DB::table("order_details") ->where('order_details.order_id',$id)->sum('amount');
        $count = DB::table("order_details") ->where('order_details.order_id',$id)->count('order_id');


        return view('sale.order_detail', compact('order_details','showorder','sumprice','sumamount','count'));

    }

    public function pdfer($id){

        // dd($id);

        $order_details = Order::leftjoin('order_details','order_details.order_id','=','orders.id')
        ->leftjoin('products','products.id','=','order_details.product_id')
        ->leftjoin('users','users.id','=','orders.user_id')
        ->select('users.first_name','users.last_name','orders.change','orders.money_received','order_details.product_id',
        'order_details.amount','order_details.price','products.pd_name','products.pd_price','products.pd_image'
        )
        ->where('order_details.order_id',$id)
        ->get();

        $showorder = Order::where('id','=',$id)->first();

        $sumprice = DB::table("order_details") ->where('order_details.order_id',$id)->sum('price');
        $sumamount = DB::table("order_details") ->where('order_details.order_id',$id)->sum('amount');
        $count = DB::table("order_details") ->where('order_details.order_id',$id)->count('order_id');


        $pdfs = PDF::loadView('pdf',compact('order_details','showorder','sumprice','sumamount','count'));
        $pdfs -> setpaper("A4", "portrait");
        $pdfs ->render();
        return @$pdfs->stream();
    }










    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
