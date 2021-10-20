@extends("admin.master")

@section("title")
اضافة صنف فرعي جديد
@endsection

@section("css")
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section("content")
<form action="/admin/items" enctype="multipart/form-data" method="post" class="form-horizontal">
    @csrf

    <div class="form-group">
        <label  for="item_num" class=" align col-sm-2 control-label"  >رقم الصنف </label>
        <div class="col-sm-10 col-md-5">
          <input  type="text" class="form-control" value="{{old('item_num')}}" id="item_num" name="item_num" placeholder="ادخل رقم الصنف">
        </div>
      </div>

    <div class="form-group">
        <label  for="name" class=" align col-sm-2 control-label"  >اسم الصنف </label>
        <div class="col-sm-10 col-md-5">
        <input  type="text" class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="ادخل اسم الصنف">
        </div>
    </div>

     <div class="form-group">
    <label for="category_id" class="align col-sm-2 control-label"> التصنيف الرئيسي</label>
    <div class="col-sm-5">
        <select name="category_id" id="category_id" class="form-control">
            <option value="">اختيار التصنيف</option>
            @foreach($categories as $c)
                <option {{$c->id==old('category_id')?"selected":""}} value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </select>
    </div>
  </div>


      <div class="form-group">
    <label for="unit_id" class="align col-sm-2 control-label">الوحدة</label>
    <div class="col-sm-5">
        <select  name="unit_id" id="unit_id" class="form-control">
            <option value="">اختيار الوحدة</option>
            @foreach($units as $u)
                <option {{$u->id==old('unit_id')?"selected":""}} value="{{$u->id}}">{{$u->name}}</option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    <label  for="price" class=" align col-sm-2 control-label"  >سعر الصنف </label>
    <div class="col-sm-10 col-md-5">
      <input type="number" min="1" class="form-control" value="{{old('price')}}" id="price" name="price" placeholder="ادخل سعر الصنف">
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input {{old('status')?"checked":""}} name="status" type="checkbox"> فعال
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">اضافة</button>
        <a href="/admin/items" class="btn btn-default">الغاء الامر</a>
    </div>
  </div>
</form>
@endsection

@section("js")
 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/metronic/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="/metronic/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/metronic/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/metronic/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
@endsection
