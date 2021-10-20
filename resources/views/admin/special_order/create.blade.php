@extends("admin.master")
@section("content")
<div class="row hidden-print">
    <div class="col-md-12">
          <h3 class="page-title">طلبية خاصة</h3>
   </div>
</div>

<form action="/admin/special_order" method="post" class="form-horizontal form-row-stripped">
    @csrf
    <div class="invoice">
        <div class="row">
            <div class="col-xs-6">
                <p> التاريخ : <strong> {{ date('Y-m-d H:i:s A') }}</strong></p>
                <p>الاسم : <span > <strong> {{ auth()->user()->user_name}} </strong></span></p>
            </div>

            <div class="col-xs-6 invoice-logo-space">
                    <img src="/metronic-rtl/assets/layouts/layout/img/logoo.png"  alt="" />
            </div>
        </div>
        <hr />

        <div class="row special_order_row ">
            <!--<div class="col-md-12">
                <div class="form-group">
                    <label class="align  control-label col-md-2">رقم الطلبية</label>
                    <div class="col-md-4">
                    <input name="order_num" type="text"  value="{{ old("order_num") }}"  class="form-control">
                    </div>
                </div>
            </div>-->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align control-label col-md-4">اسم الزبون</label>
                    <div class="col-md-8">
                        <select name="customer_id" id="customer_id" class="autosearch form-control">
                            <option value="">اختر الزيون</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="align control-label col-md-4">اسم الزبون الجدبد</label>
                    <div class="col-md-8">
                    <input id="name" name="name" type="text"   value="{{ old("name") }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align control-label col-md-4">العنوان</label>
                    <div class="col-md-8">
                    <input id="address" name="address" type="text"   value="{{ old("address") }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align  control-label col-md-4">جوال</label>
                    <div class="col-md-8">
                    <input id="mobile" name="mobile" type="text"  value="{{ old("mobile") }}"  class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align control-label col-md-4">توصيل الفرع</label>
                    <div class="col-md-8">
                    <input name="delivery_branch" type="text"  value="{{ old("delivery_branch") }}"  class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align  control-label col-md-4">تاريخ التسليم</label>
                    <div class="col-md-8">
                    <input name="delivery_date" type="date" value="{{ old("delivery_date") }}" class="form-control date-picker">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align control-label col-md-4">وقت التسليم</label>
                    <div class="col-md-8">
                    <input name="delivery_time"  value="{{ old("delivery_time") }}" type="time" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="align control-label col-md-2">عنوان التسليم</label>
                    <div class="col-md-10">
                    <input name="delivery_address" type="text"  value="{{ old("delivery_address") }}"class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align control-label col-md-4">الحجم</label>
                    <div class="col-md-8">
                    <input name="size" type="text"  value="{{ old("size") }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align control-label col-md-4">عدد الأشخاص</label>
                    <div class="col-md-8">
                    <input name="count"  type="number" min="1"  value="{{ old("count") }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="align control-label col-md-2">النوع</label>
                    <div class="col-md-10">
                        @foreach ($type as $t )
                        <label class="control-label"><input   value="{{$t->id}}" name="type[]" type="checkbox">  {{ $t->name}}</label> &nbsp;&nbsp;&nbsp;
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="align control-label col-md-2">تفاصيل خاصة</label>
                    <div class="col-md-10">
                    <textarea name="details" class="form-control"  rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="align control-label col-md-4">التاريخ</label>
                    <div class="col-md-8">
                    <input name="date" type="date"   value="{{ old("date") }}" class="form-control date-picker">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="align control-label col-md-4">الموظف</label>
                    <div class="col-md-8">
                    <input name="employee" type="text"  value="{{ old("employee") }}"    class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="align control-label col-md-4">الفرع</label>
                    <div class="col-md-8">
                    <input name="branch" type="text"   value="{{ old("branch") }}"  class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="align control-label col-md-2">  إجمال السعر</label>
                    <div class="col-md-5">
                    <input name="price"  type="number"    value="{{ old("price") }}" min="1" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="align control-label col-md-2">دفعة</label>
                    <div class="col-md-5">
                    <input name="payment" type="number"    value="{{ old("payment") }}"   min="1" class="form-control">
                    </div>
                </div>
            </div>
            <div class="align form-group">
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">إضافة</button>
                  <a href="/admin/orders/my_orders" class="btn btn-default">الغاء</a>
                </div>
            </div>
            <input type="hidden" name="imgs" id="imgs" value="" />
        </div>
    </div>
</form>

@stop

@section("js")

<script>
        $(function(){
            $("#customer_id").change(function(){
                    if($(this).val()!=""){
                        $("#address").val("");
                        $("#mobile").val("");
                        $("#name").prop("disabled",true);
                    var id=$(this).val();
                    $.get("/admin/customers/by_order_type/"+id,function(json){
                        $(json.customer).each(function(){
                            $("#address").val(this.address);

                        });
                        $(json.customer).each(function(){
                            $("#mobile").val(this.mobile);
                        });
                        },"json");
                    }
                    else{
                        $("#address").val("");
                        $("#mobile").val("");
                    }
            });
        });
        $('.autosearch').select2({
            placeholder: ' اختر الزبون',
            ajax: {
                url: '/admin/search/customers',
                dataType: 'json',
                delay: 220,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (data) {
                            return {
                                text: data.name,
                                id: data.id
                            }
                        })
                    };
                },
                cache: true
            }
        });



</script>
@endsection
