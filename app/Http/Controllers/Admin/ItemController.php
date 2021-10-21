<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Item;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Category_User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{

    /**public function __construct() {
        $this->middleware('admin')->except('index');
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status=request()["status"];
        $q=request()["q"];
        $category_id=request()["category_id"];
        $unit_id=request()["unit_id"];
        $items = Category_User::select("items.item_num","items.name as name","items.id","items.status","items.price","units.name as u_name","categories.name as c_name","items.category_id","items.unit_id")
                        ->join("items","category_user.category_id","items.category_id")
                        ->join("units","items.unit_id","units.id")
                        ->join("categories","items.category_id","categories.id")
                        ->where("user_id",auth()->user()->id)
                        ->where("items.deleted_at",null)
                        ->orderBy("items.created_at",'desc')
                        ->get();
        if($q!=NULL)
            $items=$items->where("name","like","$q");
        if($status!=NULL)
            $items=$items->where("status","=",$status);
        if($category_id!=NULL)
            $items=$items->where("category_id","=",$category_id);
        if($unit_id!=NULL)
            $items=$items->where("unit_id","=",$unit_id);
        $categories= Category_User::join("categories","category_user.category_id","categories.id")
                    ->where("user_id",auth()->user()->id)
                    ->latest()
                    ->get();
        $units=Unit::all();
        return view('admin.items.index',compact('items','q','status','category_id','unit_id','categories','units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category_User::join("categories","category_user.category_id","categories.id")
                    ->where("user_id",auth()->user()->id)
                    ->latest()
                    ->get();
        $units=Unit::where("status","1")->get();
        return view('admin.items.create',compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $IsExists =Item::where("name",$request["name"])->where("deleted_at",null)->count()>0;
        if($IsExists){
            return redirect("/admin/items/create")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا/ اختر اسم صنف آخر");
        }
        $IsExists =Item::where("item_num",$request["item_num"])->where("deleted_at",null)->count()>0;
        if($IsExists){
            return redirect("/admin/items/create")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا/ اختر رقم صنف آخر");
        }
        $item = Item::create([
            'name' => $request->name,
            'item_num' => $request->item_num,
            'status' => $request->status?1:0,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'price' => $request->price,

        ]);
        if($item) {
            return redirect()->route('admin.items.index')->withSuccess(" تمت عملية الإضافة بنجاح");
        }else {
            return redirect()->back()->withSuccess('يوجد خطأ في معلوماتك');
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
        $item=Item::find($id);
        $categories= Category_User::join("categories","category_user.category_id","categories.id")
                    ->where("user_id",auth()->user()->id)
                    ->latest()
                    ->get();
        $units=Unit::all();
        if($item == NULL){
            return redirect("/admin/items")->withSuccess(" الرجاء التأكد من الرابط المطلوب");
        }
        return view('admin.items.edit',compact('item','categories','units'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $IsExists = Item::where("name",$request["name"])
        ->where("deleted_at",null)->where("id",'!=',$id)->count()>0;
         if($IsExists){
        return redirect("/admin/items/$id/edit")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا/ اختراسمصنف آخر");
         }
         $IsExists = Item::where("item_num",$request["item_num"])
        ->where("deleted_at",null)->where("id",'!=',$id)->count()>0;
         if($IsExists){
        return redirect("/admin/items/$id/edit")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا/ اختر رقم صنف آخر");
         }
        $item = Item::find($id)->update([
            'name' => $request->name,
            'item_num' => $request->item_num,
            'status' => $request->status?1:0,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'price' => $request->price,
        ]);
        if($item) {
            return redirect()->route('admin.items.index')->withSuccess(" تمت عماية التعديل بنجاح");
        }else {
            return redirect()->back()->withSuccess('يوجد خطأ في معلوماتك');
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
        $item = Item::find($id);
        $item->delete();
        return redirect()->back()->withSuccess('تمت عملية الحذف بنجاح');
    }

    public function status($id)
    {
        $item = Item::find($id);
        if($item == NULL){
            return response()->json([
                'status' => '0',
                'msg'    => 'لم تتم العملية'
            ]);
        }
        $item->status = !$item->status;
        $item->save();
        return response()->json([
            'status' => '1',
            'msg'    => 'تمت العملية بنجاح'
        ]);
    }

    public function by_order_type($id)
    {
       $items = Item::Where("category_id",$id)->where("status","1")->get();
       return response()
             ->json(['items' => $items]);
    }

    public function item_price($id)
    {
      $item=Item::find($id);
      $price=$item->price;
       return response()
             ->json(['price' => $price]);
    }
    public function Search(Request $req)
    {
            $items = Category_User::select("id", "name")->join("items","category_user.category_id","items.category_id")
                        ->where("status","1")
                        ->where("user_id",auth()->user()->id)
                        ->get();
            if($req->has('q')){
                $search = $req->q;
                $items = Category_User::select("id", "name")->join("items","category_user.category_id","items.category_id")
                        ->where("status","1")
                        ->where("user_id",auth()->user()->id)
                        ->whereRaw("(name  like ? or id  like ?)", ["%$search%","%$search%"])
                        ->get();
                }
        return response()->json($items);
    }



}
