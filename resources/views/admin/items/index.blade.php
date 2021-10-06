@extends("admin.master")

@section("title")
الأصناف الفرعية
@endsection
@section("subtitle")
يمكنك اضافة حذف وتعديل الأصناف الفرعية
@endsection


@section("content")

<form class="row">
    <div class="col-sm-2">
        <input autofocus value="{{$q}}" type="text" class="form-control" name="q" placeholder="ادخل كلمة البحث" />
    </div>

	<div class="col-sm-3">
        <select name="category_id" id="category_id" class="form-control">
            <option value=""> اختيار التصنيف الرئيسي</option>
            @foreach($categories as $c)
                <option {{$c->id==$category_id?"selected":""}} value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </select>
    </div>

	<div class="col-sm-2">
        <select name="unit_id" id="unit_id" class="form-control">
            <option value="">اختيار الوحدة</option>
            @foreach($units as $u)
                <option {{$u->id==$unit_id?"selected":""}} value="{{$u->id}}">{{$u->name}}</option>
            @endforeach
        </select>
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

    <div class="col-sm-2">
        <a class="btn btn-success pull-right" href="{{ route('admin.items.create') }}">
            <i class="fa fa-plus"></i> اضافة صنف فرعي جديد</a>
    </div>
</form>
<br>
@if($items->count()>0)

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="10%">رقم الصنف</th>
            <th>اسم الصنف</th>
			<th width="15%">اسم الوحدة</th>
 			<th width="15%">اسم التصنيف</th>
             <th width="15%">السعر </th>

			<th width="10%">حالة الصنف</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $a)
        <tr>
            <td>{{$a->id}}</td>
            <td>{{$a->name}}</td>
            <td>{{$a->unit->name}}</td>
            <td>{{$a->category->name}}</td>
            <td>{{$a->price}}</td>
            <td><input type="checkbox" value="{{$a->id}}" class='cbStatus'
                       {{$a->status?"checked":""}} /></td>
            <td>
                <a href="/admin/items/{{$a->id}}/edit" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>

                <form class="inline" action="{{ route('admin.items.destroy', $a->id) }}" method="POST">
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
{{$items->links()}}


@endsection

@section("js")
    <script>
        $(function(){
            $(".cbStatus").click(function(){
                var id = $(this).val();
                //alert(id);
                $.get("/admin/items/"+id+"/status");
            });
        });
    </script>
@endsection


