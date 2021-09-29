<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Item;
use App\Models\Unit;
use App\Models\Category;
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
        $items=Item::latest();
        if($q!=NULL)
            $items->whereRaw("(name like ?)",["%$q%"]);
        if($status!=NULL)
            $items->whereRaw("status = ?",[$status]);
        if($category_id!=NULL)
            $items->whereRaw("category_id = ?",[$category_id]);
        if($unit_id!=NULL)
            $items->whereRaw("unit_id = ?",[$unit_id]);

        $items = $items->paginate(10)->appends(["q"=>$q,"status"=>$status,"category_id"=>$category_id,"unit_id"=>$unit_id]);
        $categories=Category::all();
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
        $categories=Category::where("status","1")->get();
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
            return redirect("/admin/items/create")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا");
        }
        $item = Item::create([
            'name' => $request->name,
            'status' => $request->status?1:0,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
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
        $categories=Category::all();
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
        return redirect("/admin/items/$id/edit")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا");
         }

        $item = Item::find($id)->update([
            'name' => $request->name,
           'status' => $request->status?1:0,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
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



}
