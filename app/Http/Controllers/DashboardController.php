<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function ReportSale()
     {

        $chart1 = DB::table('orders')
        ->select(DB::raw('DATE(date) as date'),DB::raw('SUM(total_price) as all_income'))
        ->where('status','!=',0)
        ->groupBy(DB::raw('DATE(date)'))
        ->limit(14)
        ->get();
        $data = [];
        foreach ($chart1 as $items) {
            $data['label'][] =  \Carbon\Carbon::parse( $items->date)->format('d/m/Y');
            $data['data'][] = $items->all_income;
        }
        $data['data'] = json_encode($data);
        // dd($data['data']);



        $chart2 = DB::table('orders')
        ->select(DB::raw('count(status) as cnt_order'),'status')
        ->groupBy('status')
        ->get();

        $data2 =[];

        foreach ($chart2 as $items) {
            $data2['status'][] = $items->status;
            $data2['data'][] = $items->cnt_order;
        }


        $jsonResult= json_encode($data2);

        $Order = Order::all()->count();

// dd($jsonResult);

        $chart3 = DB::table('orders')
        ->select(DB::raw('month(date) as date'),DB::raw('SUM(total_price) as m_income'))
        ->where('status','!=',0)
        ->groupBy(DB::raw('month(date)'))
        ->get();
        $data3 =[];
        foreach ($chart3 as $items) {
            $data3['data'][] = $items->m_income;
        }
        $jsonResult1 = json_encode($data3);
    //    dd($jsonResult1);
        return view('dashboard.sale_report',$data,compact('Order','jsonResult','jsonResult1'));
     }

//////////////////////////////////////////////

     public function ReportWarehouse()
     {
        $chart1 = DB::table('categories')
        ->leftjoin('products','products.cate_id','=','categories.id')
        ->select('categories.cate_name as name',DB::raw('count(products.id) as cnt_pd'))
        ->where('categories.status',1)->where('products.status',1)
        ->groupBy('categories.cate_name')
        ->get();

        $data1 =[];

        foreach ($chart1 as $items) {
            $data1['label'][] = $items->name;
            $data1['data'][] = $items->cnt_pd;
        }


        $jsonResult= json_encode($data1);

        ///////////////////////

        $chart2 = DB::table('products')
        ->select('pd_name',DB::raw('sum(pd_amount) as sum_am'))
        ->where('status',1)
        ->orderBy('sum_am', 'asc')
        ->limit(25)
        ->groupBy('id')
        ->get();

        $data2 = [];

        foreach ($chart2 as $items){
            $data2['label'][] = $items->pd_name;
            $data2['data'][] = $items->sum_am;
        }

        $jsonResult1= json_encode($data2);
        // dd($jsonResult1);

        $minimum = DB::table("products")
        ->join('categories','categories.id','products.cate_id')
        ->select('products.*','categories.cate_name')
        ->orderBy('products.pd_amount', 'asc')
        ->limit(10)
        ->get();


        // dd($minimum);


        return view('dashboard.warehouse_report',compact('jsonResult','jsonResult1','minimum'));
     }
}
