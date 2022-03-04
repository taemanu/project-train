<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
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
        $order_count = [
            Order::all()->where('status','<>',0)->count(),
            // $order_time = Order::select('date')->where('status', 1)->orderBy('id', 'DESC')->first(),
            Order::query()->orderBy('id', 'DESC')->first()->date,

            Order::query()->where('status',1)->sum('total_price'),

            Order::all()->where('status', 3)->count(),

            Order::query()->where('status',3)->orWhere('status', '=', 1)->orderBy('id', 'DESC')->first()->date,

            Order::query()->where('status','<>',0)->sum('total_item'),

            Order::query()->where('status',1)->orderBy('id', 'DESC')->first()->date,

        ];
        $recent = Order::orderBy('id', 'DESC')->take(15)->get();

        $top_pd = DB::table('order_details')
        ->join('products','products.id','=','order_details.product_id')
        ->join('orders','orders.id','=','order_details.order_id')
        ->select('products.pd_name','products.pd_image', DB::raw('SUM(order_details.amount) as count'))
        ->where('orders.status','!=',0)
        ->orderBy('count', 'desc')
        ->groupBy('products.pd_name')
        ->limit(12)
        ->get();

        // dd($top_pd);



        return view('home', compact('order_count','recent','top_pd'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function update_user(Request $request)
    {
        $request->validate([
            'f_name' => 'required|max:255',
            'l_name' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',

        ],[
            'f_name.required' => "กรุณาป้อน ' ชื่อ '",
            'l_name.required' => "กรุณาป้อน ' นามสกุล '",

            'phone.required' => "กรุณาป้อน ' เบอร์โทรศัพท์ '",

            'address.required' => "กรุณาป้อน ' ที่อยู่ '",

        ]);

        User::find($request->id)->update([
            "first_name" => $request->f_name,
            "last_name" => $request->l_name,
            "phone" => $request->phone,
            "address" => $request->address,
        ]);

        return redirect()->back()->with('success',"อัพเดทข้อมูลเรียบร้อย");

    }

    public function changPassword(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'oldpass' =>[
                'required',function($attribute,$value,$fail){
                    if (!\Hash::check($value , Auth::user()->password)) {
                        return $fail(__('รหัสผ่านปัจจุบันไม่ถูกต้อง'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpass'=>'required|min:8|max:30',
            'confirmpass' => 'required|same:newpass'
            ],[
                'oldpass.required'=>'ใส่รหัสผ่านปัจจุบันของคุณ',
                'oldpass.min'=>'รหัสผ่านเก่าต้องมีอักขระอย่างน้อย 8 ตัว',
                'oldpass.max'=>'รหัสผ่านเก่าต้องมีอักขระไม่เกิน 30 ตัว',
                'newpass.required'=>'ใส่รหัสผ่านใหม่',
                'newpass.min'=>'รหัสผ่านใหม่ต้องมีอักขระอย่างน้อย 8 ตัว',
                'newpass.max'=>'รหัสผ่านใหม่ต้องมีอักขระไม่เกิน 30 ตัว',
                'confirmpass.required'=>'ป้อนรหัสผ่านใหม่ของคุณอีกครั้ง',
                'confirmpass.same'=>'รหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ต้องตรงกัน'
            ]);

            if( !$validator->passes()){
                return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
            }else{
                $update = User::find(Auth::user()->id)->update([
                    'password' => \Hash::make($request->newpass)
                ]);

                if( !$update ){
                    return response()->json(['status'=>0,'msg'=>'มีบางอย่างผิดพลาด ไม่สามารถอัปเดตรหัสผ่านได้']);
                }else{
                    return response()->json(['status'=>1,'msg'=>'รหัสผ่านของคุณถูกเปลี่ยนเรียบร้อยแล้ว']);
                }
            }
    }
}
