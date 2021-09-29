<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class CategoryController extends Controller
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
        $items=Category::latest();
        if($q!=NULL)
            $items->whereRaw("(name like ?)",["%$q%"]);
        if($status!=NULL)
            $items->whereRaw("status = ?",[$status]);
        $items = $items->paginate(10)->appends(["q"=>$q,"status"=>$status]);
        return view('admin.categories.index',compact('items','q','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
        $IsExists =Category::where("name",$request["name"])->where("deleted_at",null)->count()>0;
        if($IsExists){
            return redirect("/admin/categories/create")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا");
        }
        $category = Category::create([
            'name' => $request->name,
            'status' => $request->status?1:0,
        ]);
        if($category) {
            return redirect()->route('admin.categories.index')->withSuccess(" تمت عملية الإضافة بنجاح");;
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
        $item=Category::find($id);
        if($item == NULL){
            return redirect("/admin/categories")->withSuccess(" الرجاء التأكد من الرابط المطلوب");
        }
        return view('admin.categories.edit',compact('item'));
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
        $IsExists = Category::where("name",$request["name"])
        ->where("deleted_at",null)->where("id",'!=',$id)->count()>0;
         if($IsExists){
        return redirect("/admin/categories/$id/edit")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا");
         }
        $category = Category::find($id)->update([
            'name' => $request->name,
            'status' => $request->status?1:0
        ]);
        if($category) {
            return redirect()->route('admin.categories.index')->withSuccess(" تمت عماية التعديل بنجاح");
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
        $cat = Category::find($id);
        if($cat->items->count()>0){
            return redirect()->route('admin.categories.index')->withSuccess("لا يمكن حذف التصنيف لاحتوائه على اصناف");
        }
        $cat->delete();

        return redirect()->back()->withSuccess('تمت عملية الحذف بنجاح');
    }


    public function status($id)
    {
        $item = Category::find($id);
        if($item == NULL){
            return response()->json([
                'status' => '0',
                'msg' => 'لم تتم العملية'
            ]);
        }
        $item->status = !$item->status;
        $item->save();
        return response()->json([
            'status' => '1',
            'msg' => 'تمت العملية بنجاح'
        ]);
    }
}
