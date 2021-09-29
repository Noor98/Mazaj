@extends("admin.master")

@section("title")
الطلبيات الخاصة
@endsection
@section("content")

<div class="row">
    <div class="col-sm-10">
        <form method="get" action="/admin/special_order" class="row">
            @csrf
            <div class="col-sm-3">
                <input autofocus name="q" value="{{$q}}" type="text" class="form-control" placeholder="  رقم الطلبية">
            </div>
             <div class="col-sm-3">
                <input name="from" value="{{$from}}" type="date" class="form-control" placeholder="من تاريخ">
            </div>
            <div class="col-sm-3">
                <input name="to" value="{{$to}}" type="date" class="form-control" placeholder="الى تاريخ">
            </div>
            <div class="col-sm-2">
                <select name="order_status" class="form-control">
                    <option value="">جميع الحالات</option>
                    <option {{$order_status=='1'?"selected":""}} value="1">مقروءة</option>
                    <option {{$order_status=='0'?"selected":""}} value="0"> جديدة</option>
                </select>
            </div>
            <div class="col-sm-1">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    @if(auth()->user()->user_type=='admin')
    <div class="col-sm-2 text-right">
        <a class="btn btn-success" href="/admin/special_order/create"><i class="glyphicon glyphicon-plus"></i>طلبية خاصة </a>
    </div>
    @endif
</div>

<br>
@if($orders->count()>0)
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>تاريخ الطلبية</th>
            <th>الحالة</th>
            <th width="20%">تاريخ القراءة</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $o)
        <tr>
            <td>{{$o->id}}</td>
            <td>{{$o->name}}</td>
            <td>{{date('Y-m-d', strtotime($o->date))}}</td>
            <td>
             @if($o->status==0)
                <strong><span style="color: red">جديدة</span></strong>
              @else
               <strong> <span style="color: rgb(20, 184, 20)">مقروءة</span></strong>
              @endif
               </td>
            <td>
                @if($o->read_date!="")
                {{date('Y-m-d h:i:s A', strtotime($o->read_date))}}
                @endif
            </td>
            <td>
                <a title="" href="/admin/special_order/{{ $o->id }}" class="btn  btn-info btn-xs">

                    <i class="glyphicon glyphicon-list"></i>
                </a>

                @if(auth()->user()->user_type=='admin')
                <form class="inline" action="{{ route('admin.special_order.destroy', $o->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('هل انت متأكد من الاستمرار في العملية؟')" class="btn Confirm btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
           {{$orders->links()}}
    @else
     <br>
     <br>
      <div class="alert alert-warning">نأسف لا يوجد بيانات لعرضها </div>
@endif

@endsection


