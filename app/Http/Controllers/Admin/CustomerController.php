<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status=request()["status"];
        $q=request()["q"];
        $customers=Customer::Latest()->withTrashed()->get();
        if($q!=NULL)
            $customers=$customers->where("name","like","$q");
        if($status!=NULL)
            $customers=$customers->where("status","=",$status);
       // $customers = $customers->paginate(10)->appends(["q"=>$q,"status"=>$status]);
        return view('admin.customers.index',compact('customers','q','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $IsExists =Customer::where("name",$request["name"])->where("deleted_at",null)->count()>0;
        if($IsExists){
            return redirect("/admin/customers/create")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا");
        }

        $customer = Customer::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'status' => $request->status?1:0,
        ]);
        if($customer) {
            return redirect()->route('admin.customers.index')->withSuccess(" تمت عملية الإضافة بنجاح");;
        }else {
            return redirect()->back()->withSuccess('يوجد خطأ في معلوماتك');;
        }
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
        $customer=Customer::find($id);

        if($customer == NULL){
            return redirect("/admin/customers")->withSuccess(" الرجاء التأكد من الرابط المطلوب");
        }

        return view('admin.customers.edit',compact('customer'));
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
        $request->validate([
            'name' => 'required'
        ]);

        $IsExists = Customer::where("name",$request["name"])
        ->where("deleted_at",null)->where("id",'!=',$id)->count()>0;
         if($IsExists){
        return redirect("/admin/customers/$id/edit")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا");
         }

        $customer = Customer::find($id)->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'status' => $request->status?1:0
        ]);

        if($customer) {
            return redirect()->route('admin.customers.index')->withSuccess(" تمت عماية التعديل بنجاح");;
        }else {
            return redirect()->back()->withSuccess('يوجد خطأ في معلوماتك');;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id)->update([
            'deleted_by' => auth()->user()->user_name,
        ]);
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->back()->withSuccess('تمت عملية الحذف بنجاح');
    }

    public function status($id)
    {

        $customer = Customer::find($id);
        if($customer == NULL){
            return response()->json([
                'status' => '0',
                'msg' => 'لم تتم العملية'
            ]);
        }
        $customer->status = !$customer->status;
        $customer->save();
        return response()->json([
            'status' => '1',
            'msg' => 'تمت العملية بنجاح'
        ]);
    }

    public function by_order_type($id)
    {
       $customer = Customer::Where("id",$id)->where("status","1")->get();
       return response()
             ->json(['customer' => $customer]);
    }

    public function Search(Request $req)
    {
            $items = Customer::select("id", "name")
                        ->where("status","1")
                        ->get();
        //dd($items);
        if($req->has('q')){
                $search = $req->q;
                $items = Customer::select("id", "name")
                        ->where("status","1")
                        ->whereRaw("(name  like ? or id  like ?)", ["%$search%","%$search%"])
                        ->get();
                }
        //dd($items);
        return response()->json($items);
    }
}
