<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('dashboard.warehouse_report');
     }
}
