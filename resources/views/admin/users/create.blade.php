@extends("admin.master")

@section("title")
اضافة مستخدم جديد
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
<form action="/admin/users" enctype="multipart/form-data" method="post" class="form-horizontal">
    @csrf
  <div class="form-group">
    <label for="name" class="align col-sm-2 control-label">الاسم  </label>
    <div class="col-sm-10 col-md-5">
      <input autofocus type="text" class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="ادخل الاسم ">
    </div>
  </div>

  <div class="form-group">
    <label for="user_name" class="align col-sm-2 control-label">اسم المستخدم  </label>
    <div class="col-sm-10 col-md-5">
      <input  type="text" class="form-control" value="{{old('user_name')}}" id="user_name" name="user_name" placeholder="ادخل اسم المستخدم">
    </div>
  </div>

  <div class="form-group">
    <label for="password" class="align col-sm-2 control-label">كلمة المرور  </label>
    <div class="col-sm-10 col-md-5">
      <input  type="password" class="form-control" value="{{old('password')}}" id="password" name="password" placeholder="ادخل كلمة المرور ">
    </div>
  </div>

  <div class="form-group">
    <label for="email" class="align col-sm-2 control-label">البريدالإلكتروني  </label>
    <div class="col-sm-10 col-md-5">
      <input  type="email" class="form-control" value="{{old('email')}}" id="email" name="email" placeholder="ادخل البريدالإلكتروني ">
    </div>
  </div>

     <div class="form-group">
    <label for="user_type" class="align col-sm-2 control-label">  تصنيف المستخدم</label>
    <div class="col-sm-5">
        <select name="user_type" id="user_type" class="form-control">
            <option      value="">اختيار التصنيف</option>
                <option  value="admin">الإدارة العامة</option>
                <option  value="branch">الفروع</option>
                <option  value="supplier">الموردون</option>
        </select>
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
        <a href="/admin/users" class="btn btn-default">الغاء الامر</a>
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
