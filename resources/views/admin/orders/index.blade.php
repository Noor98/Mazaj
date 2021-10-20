@extends("admin.master")

@section("title")
الطلبيات
@endsection
@section("content")

<div class="row">
    <div class="col-sm-10">
        <form method="get" action="/admin/orders" class="row">
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
        <a class="btn btn-success" href="/admin/orders/create"><i class="glyphicon glyphicon-plus"></i> طلبية جديدة</a>
    </div>
    @endif
</div>

<br>
@if($orders->count()>0)
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>الاسم </th>
            <th>تاريخ الطلبية</th>
            <th>الحالة</th>
            <th width="20%">تاريخ القراءة</th>
            <th width="20%">ملاحظات</th>
            @if(auth()->user()->user_type=='admin')
            <th width="20%">محذوفة بواسطة </th>
            @endif
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $o)

            @if(auth()->user()->user_type=='admin')
                <tr>
                    <td>{{$o->id}}</td>
                    <td>{{$o->user->name}}</td>
                    <td>{{date('Y-m-d', strtotime($o->order_date))}}</td>
                    <td>
                    @if($o->order_status==0)
                        <strong><span style="color: red">جديدة</span></strong>
                    @else
                    <strong> <span style="color: rgb(20, 184, 20)">مقروءة</span></strong>
                    @endif
                    </td>
                    <td>
                        @if($o->read_date!="")
                        {{$o->read_date}}
                        @endif
                    </td>
                    <td>{{$o->description}}</td>
                    <td>{{$o->deleted_at}} _ {{$o->deleted_by}}</td>
                    <td>
                        @if ($o->deleted_at==null)
                        <a title="" href="/admin/orders/{{ $o->id }}" class="btn btn-info btn-xs">

                            <i class="glyphicon glyphicon-list"></i>
                        </a>

                        <form class="inline" action="{{ route('admin.orders.destroy', $o->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('هل انت متأكد من الاستمرار في العملية؟')" class="btn Confirm btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
            @elseif (auth()->user()->user_type=='supplier')
                <?php $F= false;?>
                @foreach($o->details as $i)
                    @foreach(auth()->user()->categories as $c)
                       @if($i->item->category->id==$c->id)
                         <?php $F=true;?>
                        @endif
                    @endforeach
                @endforeach
                @if($F)
                <tr>
                    <td>{{$o->id}}</td>
                    <td>{{$o->user->name}}</td>
                    <td>{{date('Y-m-d', strtotime($o->order_date))}}</td>
                    <td>
                        <?php $F=true; ?>
                        @if($o->order_status==0)
                            @foreach($o->details as $i)
                                @foreach(auth()->user()->categories as $c)
                                    @if($i->status && $i->item->category->id==$c->id)
                                    <?php $F=false;?>
                                    @endif
                                @endforeach
                            @endforeach
                            @if($F)
                            <strong><span style="color: red">جديدة</span></strong>
                            @else
                            <strong><span style="color: rgb(0, 60, 255)">لها بقية</span></strong>
                            @endif
                        @else
                        <strong><span style="color: rgb(20, 184, 20)">مقروءة</span></strong>
                        @endif
                        </td>
                    <td>
                        @if($o->read_date!="")
                        {{$o->read_date}}
                        @endif
                    </td>
                    <td>{{$o->description}}</td>
                    <td>
                        <a title="" href="/admin/orders/{{ $o->id }}" class="btn btn-info btn-xs">

                            <i class="glyphicon glyphicon-list"></i>
                        </a>

                    </td>
                </tr>
                @endif
            @endif

        @endforeach
    </tbody>
  </table>
    @else
     <br>
     <br>
      <div class="alert alert-warning">نأسف لا يوجد بيانات لعرضها </div>
@endif

@endsection


