@extends("admin.master")

@section("title")
تعديل المستخدم
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
<form action="/admin/users/{{$user->id}}"   enctype="multipart/form-data" method="post" class="form-horizontal">
    @csrf
    <input type="hidden" name="_method" value="put" />

  <div class="form-group">
    <label for="name" class="col-sm-2 control-label"> الاسم </label>
    <div class="col-sm-10 col-md-5">
      <input autofocus type="text" class="form-control" value="{{$user->name}}"
             id="name" name="name" >
    </div>
  </div>

  <div class="form-group">
    <label for="user_name" class="col-sm-2 control-label">اسم المستخدم </label>
    <div class="col-sm-10 col-md-5">
      <input  type="text" class="form-control" value="{{$user->user_name}}"
             id="user_name" name="user_name" >
    </div>
  </div>

  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">كلمة المرور  </label>
    <div class="col-sm-10 col-md-5">
      <input  type="password" class="form-control" value="password" id="password" name="password" placeholder="ادخل كلمة المرور ">
    </div>
  </div>

  <div class="form-group">
    <label for="email" class="col-sm-2 control-label" > البريدالإلكتروني </label>
    <div class="col-sm-10 col-md-5 ">
      <input  type="email" class="form-control " readonly="true" value="{{$user->email}}"
             id="email" name="email" >
    </div>
  </div>

     <div class="form-group">
<label for="user_type" class="col-sm-2 control-label"> تصنيف المستخدم </label>
    <div class="col-sm-5">
        <select required name="user_type" id="user_type" class="form-control">
            <option      value="">اختيار التصنيف</option>
            <option  {{$user->user_type=='admin'?"selected":""}} value="admin">الإدارة العامة</option>
            <option  {{$user->user_type=='branch'?"selected":""}} value="branch">الفروع</option>
            <option  {{$user->user_type=='supplier'?"selected":""}} value="supplier">الموردون</option>
        </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input {{$user->status?"checked":""}} name="status" type="checkbox"> فعال
        </label>
      </div>
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
