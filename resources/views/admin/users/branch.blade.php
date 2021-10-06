@extends("admin.master")

@section("title")
الفروع
@endsection
@section("subtitle")
يمكنك اضافة حذف وتعديل الفروع
@endsection


@section("content")

<form class="row">
    <div class="col-sm-2">
        <input autofocus value="{{$q}}" type="text" class="form-control" name="q" placeholder="ادخل كلمة البحث" />
    </div>

    <div class="col-sm-2">
        <select name="status" class="form-control">
            <option value="">جميع الحالات</option>
            <option {{$status=='1'?"selected":""}} value="1">فعال</option>
            <option {{$status=='0'?"selected":""}} value="0">غير فعال</option>
        </select>
    </div>
    <div class="col-sm-1">
        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
    </div>

    <div class="col-sm-7">
        <a class="btn btn-success pull-right" href="{{ route('admin.users.create') }}">
            <i class="fa fa-plus"></i> اضافة فرع جديد</a>
    </div>
</form>
<br>
@if($users->count()>0)

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>الاسم </th>
			<th width="20%">اسم الدخول</th>
			<th width="30%"> الحالة</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{$u->name}}</td>
            <td>{{$u->user_name}}</td>
            <td><input type="checkbox" value="{{$u->id}}" class='cbStatus'
                       {{$u->status?"checked":""}} /></td>
            <td>
                <a href="/admin/users/{{$u->id}}/permission" class="btn btn-xs btn-warning">
                    <i class="glyphicon glyphicon-lock"></i>
                </a>
                <a href="/admin/users/{{$u->id}}/edit" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>

                <form class="inline" action="{{ route('admin.users.destroy', $u->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('هل انت متأكد من الاستمرار في العملية؟')" class="btn Confirm btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else

<br>
<div class="alert alert-warning"><b>نأسف</b>, لا يوجد بيانات لعرضها ...</div>
@endif
{{$users->links()}}


@endsection

@section("js")
    <script>
        $(function(){
            $(".cbStatus").click(function(){
                var id = $(this).val();
                //alert(id);
                $.get("/admin/users/"+id+"/status");
            });
        });
    </script>
@endsection


