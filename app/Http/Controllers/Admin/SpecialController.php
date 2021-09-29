<?php

namespace App\Http\Controllers\Admin;
use App\Models\Item;
use App\Models\Order;
use App\Models\Category;
use App\Models\SpecialOrder;
use Illuminate\Http\Request;
use App\Models\SpecialDetails;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialRequest;

class SpecialController extends Controller
{
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
            $orders=SpecialOrder::latest();
        else
            return redirect()->route('admin.dashboard')->withSuccess("لا يوجد لك صلاحية على الرابط المطلوب");
        if ($q!="") {
            $orders=$orders->whereRaw(("(order_no  like ? or name  like ?)"), ["%$q%","%$q%"]);
        }
        if ($order_status!="") {
            $orders=$orders->whereRaw(("(status like ?)"), ["%$order_status%"]);
        }
        if($from!="")
            $orders=$orders->where("date", '>=',$from);
        if($to!="")
            $orders=$orders->where("date",'<=',$to);
        $orders=$orders
        ->paginate(10)
        ->appends(["q"=>$q,"order_status"=>$order_status
        ,"from"=>$from,"to"=>$to]);
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
        return view('admin.special_order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialRequest $request)
    {
       $order = SpecialOrder::create([
        'order_no'        => $request->order_no,
        'name'            => $request->name,
        'status'          => 0,
        'created_by'      => auth()->user()->user_name,
        'address'         => $request->address,
        'mobile'          => $request->mobile,
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
        'remaining'       => $request->remaining,
        'sugar'           => $request->sugar?1:0,
        'classic'         => $request->classic?1:0,
        'special'         => $request->special?1:0,
            ]);
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
        $order=SpecialOrder::find($id);
        return view('admin.special_order.show',compact('order'));
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
        $order=SpecialOrder::find($id);
        return view('admin.special_order.show_my_order',compact('order'));
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
        $order=SpecialOrder::find($id);
        $order->delete();
        return redirect()->back()->withSuccess('تمت عملية الحذف بنجاح');
    }
}
