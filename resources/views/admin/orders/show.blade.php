@extends("admin.master")

@section('css')
    <style>
        @media print {

         #print_Button {display: none;}

        }
        @page
        {
            size: auto;   /* auto is the current printer page size */
            margin: 8mm;  /* this affects the margin in the printer settings */
        }
    </style>
@endsection
@section("content")
<div class=" main-content-body-invoice" id="print">


    <div  class="row">
        <div class="row">
            <h3 style="margin-right: 1cm">
            طلبية # {{ $order->id }}
            </h3>
            <div class="form-group" style="margin-left: 1cm">
                <div class="col-md-12"><img align="left" style="height: 80px; width: 200px;" src="/metronic-rtl/assets/layouts/layout/img/logoo.png" /></div>
            </div>
        </div>
        <div class="form-group">
            <h1 style="text-align:center"> <strong> {{ $order->user->name}} </strong></h1>
        </div>
        <div class="col-md-12 form-horizontal">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">التاريخ:  </label>
                    <span class="col-sm-10 col-md-5"> <strong> {{ $order->order_date}} </strong></span>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">ملاحظات:  </label>
                    <span style="border-style: groove;" class="col-sm-10 col-md-5"> <strong>
                        @if($order->description==null)
                        لا يوجد ملاحظات
                        @else
                        {{ $order->description}}
                        @endif
                    </strong></span>
            </div>
        </div>
    </div>

    <hr>
    <?php 
    $p=false;
    foreach($order->details as $o)
        if($o->item->price)
            $p=true;
    ?>
    <table class="table table-hover table-bordered  table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>الصنف</th>
                @if ($p)
                <th>سعر الصنف</th> 
                @endif
                <th> الوحدة</th>
                <th>الكمية</th>
                <th>ملاحظات</th>

            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $o)
                @if(auth()->user()->user_type=='admin')
                        <tr>
                            <td>{{$o->item->item_num}}</td>
                            <td>{{$o->item->name}}</td>
                            @if ($p)
                            <td>{{$o->item->price}}</td>
                            @endif
                            <td>{{$o->item->unit->name}}</td>
                            <td>{{$o->quantity}} </td>
                            <td width="30%">{{$o->item_description}} </td>
                        </tr>

                @elseif (auth()->user()->user_type=='supplier')
                    @foreach(auth()->user()->categories as $c)
                        @if($o->item->category_id==$c->id)
                            <tr>
                                <td>{{$o->item->item_num}}</td>
                                <td>{{$o->item->name}}</td>
                                @if ($p)
                                <td>{{$o->item->price}}</td>
                                @endif
                                <td>{{$o->item->unit->name}}</td>
                                <td>{{$o->quantity}} </td>
                                <td width="30%">{{$o->item_description}} </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
    class="mdi mdi-printer ml-1"></i>طباعة</button>

<a href="/admin/orders/{{$order->id}}/read" class="btn btn-success">مقروءة</a>

<a href="/admin/orders" class="btn btn-default">رجوع</a>

@stop

@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
