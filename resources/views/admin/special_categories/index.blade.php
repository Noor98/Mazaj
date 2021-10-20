@extends("admin.master")

@section("title")
 التصنفات الخاصة
@endsection
@section("subtitle")
يمكنك اضافة حذف وتعديل التصنيفات الخاصة
@endsection


@section("content")
<form class="row">
    <div class="col-sm-3">
        <input autofocus   value="{{$q}}" type="text" class="form-control" name="q" placeholder="ادخل كلمة البحث" />
    </div>
    <div class="col-sm-2">
        <select name="status" class="form-control">
            <option value="">جميع الحالات</option>
            <option {{$status=='1'?"selected":""}} value="1">فعال</option>
            <option {{$status=='0'?"selected":""}} value="0">غير فعال</option>
        </select>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
    </div>
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
        <a class="btn btn-success pull-right" href="/admin/special_categories/create">
            <i class="fa fa-plus"></i> اضافة تصنيف خاص جديد</a>
    </div>
</form>
<br>
@if($items->count()>0)
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th  width="30%">التصنيف الخاص</th>
            <th width="10%">الحالة</th>
            <th width="20%">محذوف بواسطة</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $a)
        <tr>
            <td>{{$a->name}}</td>
            <td><input type="checkbox" value="{{$a->id}}" class='cbStatus' {{$a->status?"checked":""}} /></td>
            <td>{{$a->deleted_at}} _ {{$a->deleted_by}}</td>
            <td>
                @if ($a->deleted_at==null)
                <a href="/admin/special_categories/{{$a->id}}/edit" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <form  class="inline" action="{{ route('admin.special_categories.destroy', $a->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button  onclick="return confirm('هل انت متأكد من الاستمرار في العملية؟')" class="btn Confirm btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else

<br>
<div class="alert alert-warning"><b>نأسف</b>, لا يوجد بيانات لعرضها ...</div>
@endif


@endsection

@section("js")
    <script>
        $(function(){
            $(".cbStatus").click(function(){
                var id = $(this).val();
                $.get("/admin/special_categories/"+id+"/status");
            });
        });
    </script>
@endsection


