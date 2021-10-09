<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status=request()["status"];
        $user_type=request()["user_type"];
        $q=request()["q"];
        $users=User::latest();
        if($q!=NULL)
            $users->whereRaw("(user_name  like ? or name  like ?)",["%$q%","%$q%"]);
        if($status!=NULL)
            $users->whereRaw("status = ?",[$status]);
        if($user_type!=NULL)
            $users->whereRaw("user_type = ?",[$user_type]);
        $users = $users->paginate(10)->appends(["q"=>$q,"status"=>$status,"user_type"=>$user_type]);
        return view('admin.users.index',compact('users','q','status','user_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $IsExists =User::where("user_name",$request["user_name"])->where("deleted_at",null)->count()>0;
        if($IsExists){
            return redirect("/admin/users/create")->withInput()->withSuccess("أدخل اسم مستخدم جديد/العنصر المنوي ادخاله موجود مسبقا");
        }
        $IsExists =User::where("email",$request["email"])->where("deleted_at",null)->count()>0;
        if($IsExists){
            return redirect("/admin/users/create")->withInput()->withSuccess("أدخل بريد الكتروني جديد/العنصر المنوي ادخاله موجود مسبقا");
        }
        $user = User::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'status' => $request->status?1:0,
            'user_type' => $request->user_type,
            'email' => $request->email,
            'password' => bcrypt( $request->password),
        ]);
        if($user) {
            return redirect()->route('admin.users.index')->withSuccess(" تمت عملية الإضافة بنجاح");
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
        $user=User::find($id);
        if($user == NULL){
            return redirect("/admin/users")->withSuccess(" الرجاء التأكد من الرابط المطلوب");
        }
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $IsExists = User::where("user_name",$request["user_name"])
        ->where("deleted_at",null)->where("id",'!=',$id)->count()>0;
         if($IsExists){
        return redirect("/admin/users/$id/edit")->withInput()->withSuccess("أدخل اسم مستخدم جديد/العنصر المنوي ادخاله موجود مسبقا");
         }
        $user = User::find($id)->update([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'status' => $request->status?1:0,
            'user_type' => $request->user_type,
            'email' => $request->email,
            'password' => bcrypt( $request->password),
        ]);
        if($user) {
            return redirect()->route('admin.users.index')->withSuccess(" تمت عماية التعديل بنجاح");
        }else {
            return redirect()->back()->withSuccess('يوجد خطأ في معلوماتك');
        }
    }

    public function admin()
    {
        $status=request()["status"];
        $q=request()["q"];
        $users=User::Where('user_type','admin');
        if($q!=NULL)
            $users->whereRaw("(user_name  like ? or name  like ?)",["%$q%","%$q%"]);
        if($status!=NULL)
            $users->whereRaw("status = ?",[$status]);
        $users = $users->paginate(10)->appends(["q"=>$q,"status"=>$status]);
        return view('admin.users.admin',compact('users','q','status'));
    }

    public function supplier()
    {
        $status=request()["status"];
        $q=request()["q"];
        $users=User::Where('user_type','supplier');
        if($q!=NULL)
            $users->whereRaw("(user_name  like ? or name  like ?)",["%$q%","%$q%"]);
        if($status!=NULL)
            $users->whereRaw("status = ?",[$status]);
        $users = $users->paginate(10)->appends(["q"=>$q,"status"=>$status]);
        return view('admin.users.supplier',compact('users','q','status'));
    }

    public function branch()
    {
        $status=request()["status"];
        $q=request()["q"];
        $users=User::Where('user_type','branch');
        if($q!=NULL)
            $users->whereRaw("(user_name  like ? or name  like ?)",["%$q%","%$q%"]);
        if($status!=NULL)
            $users->whereRaw("status = ?",[$status]);
        $users = $users->paginate(10)->appends(["q"=>$q,"status"=>$status]);
        return view('admin.users.branch',compact('users','q','status'));
    }

    public function permission($id)
    {
        $user=User::find($id);
        $categories=Category::all();
        if($user == NULL){
            return redirect("/admin/users/supplier")->withSuccess(" الرجاء التأكد من الرابط المطلوب");
        }
        return view('admin.users.permission',compact('user','categories'));
    }

    public function set_permission($id,Request $request)
    {
        $user=User::find($id);

        //حذفت صلاحياتك القديمة
         DB::table("category_user")->where("user_id",$id)->delete();
        //اخدت الصلاحيات بعد التعديل
        $permissions = $request["permission"];
        $user->categories()->sync( $permissions );
        return redirect("/admin/users/$id/permission")->withSuccess("تمت عملية الحفظ بنجاح");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->withSuccess('تمت عملية الحذف بنجاح');
    }

    public function status($id)
    {
        $user = User::find($id);
        if($user == NULL){
            return response()->json([
                'status' => '0',
                'msg' => 'لم تتم العملية'
            ]);
        }
        $user->status = !$user->status;
        $user->save();
        return response()->json([
            'status' => '1',
            'msg' => 'تمت العملية بنجاح'
        ]);
    }
}
