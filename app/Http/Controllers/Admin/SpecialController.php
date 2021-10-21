<?php

namespace App\Http\Controllers\Admin;
use App\Models\Item;
use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use App\Models\SpecialOrder;
use Illuminate\Http\Request;
use App\Models\SpecialDetails;
use App\Models\SpecialCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialRequest;

class SpecialController extends Controller
{
    public $num=1;
    public function __construct()
{
    $this->middleware('admin_or_branch')->only('show_my_orders','create');
    $this->middleware('admin_or_supplier')->only('show','index');

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q=$request["q"];
        $order_status=$request["order_status"];
        $from=$request["from"];
        $to=$request["to"];
        $F=false;
        foreach(auth()->user()->categories as $c)
            if($c->id==7){
                $F=true;
            }
        if(auth()->user()->user_type=='admin'||$F)
            $orders=SpecialOrder::latest()->withTrashed()->get();
        else
            return redirect()->route('admin.dashboard')->withSuccess("لا يوجد لك صلاحية على الرابط المطلوب");
        if ($q!="") {
            $orders=$orders->where("customer_id", "like","$q");
        }
        if ($order_status!="") {
            $orders=$orders->where("status","like", "$order_status");
        }
        if($from!="")
            $orders=$orders->where("date", '>=',$from);
        if($to!="")
            $orders=$orders->where("date",'<=',$to);
        //$orders=$orders
        //->paginate(10)
        //->appends(["q"=>$q,"order_status"=>$order_status
        //,"from"=>$from,"to"=>$to]);
    return view('admin.special_order.index', compact(
        "orders",
        "q",
        "order_status",
        "from",
        "to"
    ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(date('H:i:s A')>= "08:00:00 AM" && date('H:i:s A')<="24:00:00 AM"){
            $customers=Customer::Latest();
            $type=SpecialCategory::all()->where('status',1);
            return view('admin.special_order.create',compact('type'));
        }
        else
            return redirect()->route('admin.my_orders')->withSuccess(" غير مسموح إنشاء طلبية في هذا الوقت: يمكنك الإضافة من الساعة 8 صباحا إالى الساعة 12 منتصف الليل");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialRequest $request)
    {
        if($request->customer_id){
            $order = SpecialOrder::create([
                'order_no'        =>  $request->order_num,
                'customer_id'     => $request->customer_id,
                'status'          => 0,
                'created_by'      => auth()->user()->user_name,
                'delivery_branch' => $request->delivery_branch,
                'delivery_date'   => $request->delivery_date,
                'delivery_address'=> $request->delivery_address,
                'delivery_time'   => $request->delivery_time,
                'size'            => $request->size,
                'count'           => $request->count,
                'details'         => $request->details,
                'price'           => $request->price,
                'date'            => $request->date,
                'employee'        => $request->employee,
                'branch'          => $request->branch,
                'payment'         => $request->payment,
                'remaining'       => ($request->price)-($request->payment),
                    ]);
        }
        else if($request->name){
            $customer = Customer::create([
                'name'   => $request->name,
                'address'   => $request->address,
                'mobile'   => $request->mobile,
                'status' => 1,
            ]);
            $order = SpecialOrder::create([
                'order_no'        =>  $request->order_num,
                'customer_id'     => $customer->id,
                'status'          => 0,
                'created_by'      => auth()->user()->user_name,
                'delivery_branch' => $request->delivery_branch,
                'delivery_date'   => $request->delivery_date,
                'delivery_address'=> $request->delivery_address,
                'delivery_time'   => $request->delivery_time,
                'size'            => $request->size,
                'count'           => $request->count,
                'details'         => $request->details,
                'price'           => $request->price,
                'date'            => $request->date,
                'employee'        => $request->employee,
                'branch'          => $request->branch,
                'payment'         => $request->payment,
                'remaining'       => ($request->price)-($request->payment),
                    ]);

        }
        $type = $request["type"];
        //dd($type);
        $new_order=SpecialOrder::find($order->id);
        $new_order->special_categories()->sync( $type );

        return redirect()->route('admin.special_order.create')->withSuccess(" تمت عملية الإضافة بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type=SpecialCategory::all()->where('status',1);
        $order=SpecialOrder::find($id);
        return view('admin.special_order.show',compact('order','type'));
    }


    public function read($id)
    {
        $order=SpecialOrder::find($id);
        if($order->status == 0)
        {
            $order->status = 1;
            $order->read_date=date('Y-m-d h:i:s');
            $order->save();
            return redirect()->route('admin.special_order.index',compact('order'))->withSuccess(" تمت القراءة بنجاح");
        }
        return redirect()->route('admin.special_order.index',compact('order'))->withSuccess(" تمت القراءة بنجاح");
    }

    public function show_my_order($id)
    {
        $type=SpecialCategory::all()->where('status',1);
        $order=SpecialOrder::find($id);
        return view('admin.special_order.show_my_order',compact('order','type'));
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
        $order=SpecialOrder::find($id)->update([
            'deleted_by' => auth()->user()->user_name,
        ]);
        $order=SpecialOrder::find($id);
        $order->delete();
        return redirect()->back()->withSuccess('تمت عملية الحذف بنجاح');
    }
}
