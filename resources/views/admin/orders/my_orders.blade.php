@extends("admin.master")

@section("title")
طلبياتي
@endsection
@section("content")

<div class="row">
    <div class="col-sm-8">
        <form method="get" action="/admin/orders/my_orders" class="row">
            <div class="col-sm-3">
            <input autofocus name="q" value="{{$q}}" type="text" class="form-control" placeholder="  رقم الطلبية">
            </div>
            <div class="col-sm-3">
                <input name="from" value="{{$from}}" type="date" class="form-control" placeholder="من تاريخ">
            </div>
            <div class="col-sm-3">
                <input name="to" value="{{$to}}" type="date" class="form-control" placeholder="الى تاريخ">
            </div>
            <div class="col-sm-1">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
       <div class="col-sm-2 text-right">
            <a class="btn btn-success" href="/admin/orders/create"><i class="glyphicon glyphicon-plus"></i> طلبية جديدة</a>
        </div>
        <div class="col-sm-2 text-right">
            <a class="btn btn-success" href="/admin/special_order/create"><i class="glyphicon glyphicon-plus"></i> طلبية خاصة</a>
        </div>

</div>

<br>
@if($orders->count()>0 || $special_orders->count()>0 )
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>تاريخ الطلبية</th>
            <th width="40%">ملاحظات</th>
            <th width="5%">عرض</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $o)
        <tr>
            <td>{{$o->id}}</td>
            <td>{{date('Y-m-d', strtotime($o->order_date))}}</td>
            <td>{{$o->description}}</td>
            <td>
                <a title="" href="/admin/orders/my_orders/{{ $o->id }}" class="btn PopUp btn-info btn-xs">

                    <i class="glyphicon glyphicon-list"></i>
                </a>
            </td>
        </tr>
        @endforeach

        @foreach($special_orders as $o)
        <tr>
            <td>{{$o->id}}</td>
            <td>{{date('Y-m-d', strtotime($o->date))}}</td>
            <td></td>
            <td>
                <a title="" href="/admin/special_order/my_orders/{{ $o->id }}" class="btn PopUp btn-info btn-xs">

                    <i class="glyphicon glyphicon-list"></i>
                </a>
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


