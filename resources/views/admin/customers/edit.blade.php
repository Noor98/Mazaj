@extends("admin.master")

@section("title")
تعديل الزبون
@endsection

@section("content")
<form action="/admin/customers/{{$customer->id}}" method="post" class="form-horizontal">
    @csrf
    @method('put')
  <div class="form-group">
    <label for="name" class="align col-sm-2 control-label">اسم الزبون</label>
    <div class="col-sm-10 col-md-5">
      <input autofocus type="text" class="form-control" value="{{$customer->name}}" id="name" name="name" placeholder="ادخل اسم الزبون">
    </div>
  </div>


  <div class="form-group">
    <label for="mobile" class="align col-sm-2 control-label">جوال الزبون</label>
    <div class="col-sm-10 col-md-5">
      <input  type="text"  class="form-control" value="{{$customer->mobile}}" id="mobile" name="mobile" placeholder="ادخل جوال الزبون">
    </div>
  </div>
  <div class="form-group">
    <label for="address" class="align col-sm-2 control-label">عنوان الزبون</label>
    <div class="col-sm-10 col-md-5">
      <input  type="text"  class="form-control" value="{{$customer->address}}" id="address" name="address" placeholder="ادخل عنوان الزبون">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input {{$customer->status?"checked":""}} name="status" type="checkbox"> فعال
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="/admin/customers" class="btn btn-default">الغاء الامر</a>
    </div>
  </div>
</form>
@endsection

