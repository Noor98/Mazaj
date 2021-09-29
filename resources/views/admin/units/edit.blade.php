@extends("admin.master")

@section("title")
تعديل الوحدة
@endsection

@section("content")
<form action="/admin/units/{{$item->id}}" method="post" class="form-horizontal">
    @csrf
    @method('put')
  <div class="form-group">
    <label for="name" class="align col-sm-2 control-label">اسم الوحدة</label>
    <div class="col-sm-10 col-md-5">
      <input autofocus type="text" class="form-control" value="{{$item->name}}" id="name" name="name" placeholder="ادخل اسم الوحدة">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input {{$item->status?"checked":""}} name="status" type="checkbox"> فعال
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="/admin/units" class="btn btn-default">الغاء الامر</a>
    </div>
  </div>
</form>
@endsection

