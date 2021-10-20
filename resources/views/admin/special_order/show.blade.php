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
    <div class="row">
        <div class="col-md-8">
            <h3 class="page-title">طلبية خاصة # {{ $order->id }}
            </h3>
        </div>
        <div class="col-xs-4 invoice-logo-space">
            <img src="/metronic-rtl/assets/layouts/layout/img/logoo.png"  alt="" />
    </div>
    </div>


    <h1 style="text-align:center"> <strong>{{ $order->created_by}}</strong></h1>

            <div class="row">
                <div class="col-xs-6">
                    <p><strong> التاريخ : </strong><label  >  {{ $order->date}}  </label></p>
                </div>


            </div>
            <div class="row special_order_row ">
                <table class="table table-striped ">
                    <tr >
                        <td  class="col-xs-6">
                            <label class=" control-label col-md-4"><strong>اسم الزبون :</strong></label>
                            <label  class=" col-md-8">{{ $order->customer->name}}  </label>

                        </td>
                        <td class="col-xs-6">
                            <label class=" control-label col-md-4"><strong>العنوان :</strong></label>
                            <label  class="col-md-8">{{ $order->customer->address}}  </label>

                    </td>
                    </tr>
                    <tr>
                        <td class="col-md-6">
                            <label class="  control-label col-md-4"><strong>جوال :</strong></label>
                            <label class="col-md-8">{{ $order->customer->mobile}}  </label>

                        </td>
                        <td class="col-md-6">
                            <label class=" control-label col-md-4"><strong>توصيل الفرع :</strong></label>
                            <label class="col-md-8">{{ $order->delivery_branch}}  </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-6">
                            <label class="  control-label col-md-4"><strong>تاريخ التسليم :</strong></label>
                                <label    class="col-md-8">{{ $order->delivery_date}}  </label>

                        </td>
                        <td class="col-md-6">
                            <label class=" control-label col-md-4"><strong>وقت التسليم :</strong></label>
                            <label  class="col-md-8">{{ $order->delivery_time}}  </label>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-6">
                            <label class=" control-label col-md-4"><strong>عنوان التسليم :</strong></label>
                            <label   class="col-md-8">{{ $order->delivery_address}}  </label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="col-md-6">
                            <label class=" control-label col-md-4"><strong>الحجم :</strong></label>
                            <label  class="col-md-8">{{ $order->size}}  </label>
                        </td>
                        <td>
                            <label class=" control-label col-md-4"><strong>عدد الأشخاص :</strong></label>
                            <label  class="col-md-8">{{ $order->count}}  </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-6">
                            <label class="control-label col-md-2"><strong>النوع :</strong></label>
                                <label class="col-md-12" >
                                    @foreach ($type as $t )
                                    <?php
                                    $checked =  $order->special_categories()->where("id",$t->id)->count();
                                    ?>
                                    <label class="control-label"><input {{$checked?'checked':''}} value="{{$t->id}}" name="type[]" type="checkbox">  {{ $t->name}}</label> &nbsp;&nbsp;&nbsp;
                                    @endforeach
                                </label>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="col-md-6">
                            <label class=" control-label col-md-4"><strong>تفاصيل خاصة :</strong></label>
                            @if ( $order->details!=null)
                            <label style="margin-right: 2.5cm; border-style: groove; " class="col-md-10" rows="4">{{ $order->details}}  </label>
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr >
                        <td class=" col-md-6">
                            <label class="control-label col-md-3"><strong>التاريخ :</strong></label>
                            <label class="col-md-8">{{ $order->date}}  </label>
                        </td>
                        <td class=" col-md-6">
                            <label class="control-label col-md-2"><strong>الموظف: </strong></label>
                            <label class="col-md-4">{{ $order->employee}}  </label>
                            <label class="control-label col-md-2"><strong>الفرع :</strong></label>
                            <label class="col-md-4"  >{{ $order->branch}}  </label>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-md-6">
                            <label class="col-md-4">  <strong>إجمالي السعر :</strong></label>
                            <label class="col-md-5">{{ $order->price}}  </label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="col-md-6">
                            <label class=" col-md-4"><strong>دفعة :</strong></label>
                            <label  class="col-md-5">{{ $order->payment}}  </label>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="col-md-6">
                            <label class=" col-md-4"><strong>متبقي :</strong></label>
                            <label class="col-md-8">{{ $order->remaining}}  </label>
                        </td>
                        <td>
                            <label class=" control-label col-md-3"><strong>التوقيع : </strong></label>
                            <label class="col-md-8"> </label>
                        </td>
                    </tr>

               </table>
              <br>
            </div>
</div>
            <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
            class="mdi mdi-printer ml-1"></i>طباعة</button>
            <a href="/admin/special_order/{{$order->id}}/read" class="btn btn-success">مقروءة</a>
            <a href="/admin/special_order" class="btn btn-default">رجوع</a>
            <input type="hidden" name="imgs" id="imgs" value="" />
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





