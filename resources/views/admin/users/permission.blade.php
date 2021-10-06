@extends("admin.master")

@section("title")
 صلاحيات المورد
@endsection
@section("subtitle")
يمكنك اضافة حذف وتعديل الصلاحيات
@endsection


@section("content")


<form action="/admin/users/{{$user->id}}/set_permission" method="post" class="form-horizontal">
    @csrf
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label"></label>
    <div class="col-sm-10 col-md-5">

        <ul class="list-unstyled">
        @foreach($categories as $category)
        <?php
            //هل انا معي صلاحية على اللينك اللي انا فيه
            $hasPermission =  $user->categories->where("id",$category->id)->count();
        ?>
            <li>
            <label><input class="cbPermission" {{$hasPermission?'checked':''}} type="checkbox" value="{{$category->id}}" name="permission[]" /> <b>{{$category->name}}</b></label>

            </li>
        @endforeach
        </ul>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="/admin/users" class="btn btn-default">الغاء الامر</a>
    </div>
  </div>
</form>
@endsection


