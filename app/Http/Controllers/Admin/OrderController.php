<?php

namespace App\Http\Controllers\Admin;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderDetails;
use App\Models\SpecialOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
{
    $this->middleware('admin')->only('delete');
    $this->middleware('admin_or_branch')->only('my_orders','show_my_orders','create');
    $this->middleware('admin_or_supplier')->only('show','index');

}

    public function index(Request $request){
        $q=$request["q"];
        $order_status=$request["order_status"];
        $from=$request["from"];
        $to=$request["to"];
        $orders=Order::latest();
        if ($q!="") {
            $orders=Order::join("users","user_id","users.id")
            ->whereRaw("true")->whereRaw("(order_no  like ? or name  like ?)",["%$q%","%$q%"]);
        }
        if ($order_status!="") {
            $orders=$orders->whereRaw(("(order_status like ?)"), ["%$order_status%"]);
        }
        if($from!="")
            $orders=$orders->whereRaw("order_date >= ?",[$from]);
        if($to!="")
            $orders=$orders->whereRaw("order_date <= ?",[$to]);
        $orders=$orders
            ->paginate(10)
            ->appends(["q"=>$q,"order_status"=>$order_status,"from"=>$from,"to"=>$to]);
        return view("admin.orders.index", compact(
            "orders",
            "q",
            "order_status",
            "from",
            "to",

        ));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where("status","1")->get();
        return view('admin.orders.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id ,
            'order_date' => $request->order_date,
            'order_status' => 0,
            'description' => $request->description,
        ]);
        for($i=0;$i<sizeof($request["item_id_arr"]);$i++){
            $id=$request["item_id_arr"][$i];
            $qty=$request["qty_arr"][$i];
            $desc=$request["desc_arr"][$i];
            $item=Item::find($id);
            $details = OrderDetails::create([
                'order_id' => $order->id ,
                'item_id' => $item->id,
                'unit_id' => $item->unit_id,
                'quantity' =>$qty,
                'item_description' =>$desc,
                'date'=>date('Y-m-d'),
                'status'=>0,
            ]);
        }
        return redirect()->route('admin.orders.create')->withSuccess(" تمت عملية الإضافة بنجاح");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
        return view('admin.orders.show',compact('order'));
    }

    public function read($id)
    {
        $order=Order::find($id);
        foreach($order->details as $o)
            foreach(auth()->user()->categories as $c)
                if($o->item->category->id==$c->id){
                    $o->status = 1;
                    $o->save();
                }
        if($order->order_status == 0)
        {
            $F=true;
            foreach($order->details as $o){
                if($o->status==0)
                    $F=false;
            }
            if($F){
                $order->order_status = 1;
                $order->read_date=date('Y-m-d h:i:s');
                $order->save();
                return redirect()->route('admin.orders.show',compact('order'))->withSuccess(" تمت القراءة بنجاح");
            }
        }
        return redirect()->route('admin.orders.show',compact('order'))->withSuccess(" تمت القراءة بنجاح");
    }



    public function my_orders(Request $request)
    {
        $q=$request["q"];
        $from=$request["from"];
        $to=$request["to"];
        $orders=Order::where("user_id",auth()->user()->id);
        $special_orders=SpecialOrder::where("created_by",auth()->user()->user_name);
        if ($q!="") {
            $orders=$orders->whereRaw("true")->whereRaw("(order_no  like ?)",["%$q%"]);
            $special_orders=$special_orders->whereRaw("true")->whereRaw("(order_no  like ?)",["%$q%"]);
        }
        if($from!=""){
        $orders=$orders->where("order_date",">=" ,$from);
        $special_orders=$special_orders->where("date",">=",$from);
        }
        if($to!=""){
        $orders=$orders->where("order_date","<=",$to);
        $special_orders=$special_orders->where("date","<=",$to);
        }
        $orders=$orders
            ->paginate(10)
            ->appends(["q"=>$q,"from"=>$from,"to"=>$to]);
        $special_orders=$special_orders
            ->paginate(10)
            ->appends(["q"=>$q,"from"=>$from,"to"=>$to]);
        return view("admin.orders.my_orders", compact(
            "orders",
        "special_orders",
            "q",
            "from",
            "to",

        ));
    }

    public function show_my_order($id)
    {
        $order=Order::find($id);
        return view('admin.orders.show_my_order',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function statistics(Request $request)
    {
        $from=$request->input('from');
        $to=$request->input('to');
        $orders=OrderDetails::where("date",'=',date('Y-m-d'))->get();
        if($request->has('from')){
        $orders=OrderDetails::where("date",'>=',$from)->get();
        }
        if($request->has('to')){
            $orders=$orders->where("date",'<=',$to);
            }
        $orders=$orders->groupBy('item_id')->map(function ($row)  {
                return $row->sum("quantity");
             });
        if($from!=""|| $to!="")
        return view('admin.orders.statistics',['orders'=>$orders,'from'=>$from,'to'=>$to]);
        else{
        return view('admin.orders.statistics',['orders'=>[]]);
        }
   }



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
        $order = Order::find($id);
        $order->delete();
        foreach($order->details as $o)
               $o->delete();
         return redirect()->back()->withSuccess('تمت عملية الحذف بنجاح');
    }
}
