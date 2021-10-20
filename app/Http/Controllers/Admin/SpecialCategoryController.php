<?php

namespace App\Http\Controllers\Admin;

use App\Models\SpecialCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class SpecialCategoryController extends Controller
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
        $items=SpecialCategory::latest()->withTrashed()->get();
        if($q!=NULL)
            $items=$items->where("name","like","$q");
        if($status!=NULL)
            $items=$items->where("status","=",$status);
        return view('admin.special_categories.index',compact('items','q','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.special_categories.create');
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
        $IsExists =SpecialCategory::where("name",$request["name"])->where("deleted_at",null)->count()>0;
        if($IsExists){
            return redirect("/admin/special_categories/create")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا");
        }
        $category = SpecialCategory::create([
            'name' => $request->name,
            'status' => $request->status?1:0,
        ]);
        if($category) {
            return redirect()->route('admin.special_categories.index')->withSuccess(" تمت عملية الإضافة بنجاح");;
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
        $category=SpecialCategory::find($id);
        if($category == NULL){
            return redirect("/admin/special_categories")->withSuccess(" الرجاء التأكد من الرابط المطلوب");
        }
        return view('admin.special_categories.edit',compact('category'));
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
        $IsExists = SpecialCategory::where("name",$request["name"])
        ->where("deleted_at",null)->where("id",'!=',$id)->count()>0;
         if($IsExists){
        return redirect("/admin/special_categories/$id/edit")->withInput()->withSuccess("العنصر المنوي ادخاله موجود مسبقا");
         }
        $category = SpecialCategory::find($id)->update([
            'name' => $request->name,
            'status' => $request->status?1:0
        ]);
        if($category) {
            return redirect()->route('admin.special_categories.index')->withSuccess(" تمت عماية التعديل بنجاح");
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
        $cat = SpecialCategory::find($id)->update([
            'deleted_by' => auth()->user()->user_name,
        ]);
        $cat = SpecialCategory::find($id);
        $cat->delete();

        return redirect()->back()->withSuccess('تمت عملية الحذف بنجاح');
    }


    public function status($id)
    {
        $item = SpecialCategory::find($id);
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
