<div class="row">
    <div class="col-xs-6">
        <p><strong> التاريخ : </strong><label  >  {{ $order->date}}  </label></p>
        <p><strong>الاسم :</strong> <span>{{ $order->created_by}}</span></p>
    </div>

    <div class="col-xs-6 invoice-logo-space">
            <img src="/metronic-rtl/assets/layouts/layout/img/logoo.png"  alt="" />
    </div>
</div>
<div class="row special_order_row ">
    <table class="table table-striped ">
        <tr >
            <td  class="col-xs-6">
                <label class=" control-label col-md-4"><strong>اسم الزبون :</strong></label>
                <label  class=" col-md-8">{{ $order->name}}  </label>

            </td>
            <td class="col-xs-6">
                <label class=" control-label col-md-4"><strong>العنوان :</strong></label>
                <label  class="col-md-8">{{ $order->address}}  </label>

        </td>
        </tr>
        <tr>
            <td class="col-md-6">
                <label class="  control-label col-md-4"><strong>جوال :</strong></label>
                <label class="col-md-8">{{ $order->mobile}}  </label>

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
                        <label  class="col-md-4" ><input disabled {{ $order->classic?"checked":""}} name="classic" type="checkbox">   كلاسيك</label> &nbsp;&nbsp;&nbsp;
                        <label  class="col-md-4"><input disabled  {{ $order->special?"checked":""}} name="special"  type="checkbox"> سبيشال </label> &nbsp;&nbsp;&nbsp;
                        <label  class="col-md-0"><input disabled {{ $order->sugar?"checked":""}}   name="sugar"    type="checkbox"> سكر    </label> &nbsp;&nbsp;&nbsp;
                    </label>
            </td>
            <td></td>
        </tr>

        <tr>
            <td class="col-md-6">
                <label class=" control-label col-md-4"><strong>تفاصيل خاصة :</strong></label>
                <label  class="col-md-10" rows="4">{{ $order->details}}  </label>
            </td>
            <td></td>
        </tr>
        <tr >
            <td class=" col-md-6">
                <label class="control-label col-md-3"><strong>التاريخ :</strong></label>
                <label class="col-md-8">{{ $order->date}}  </label>
            </td>
            <td class=" col-md-6">
                <label class="control-label col-md-3"><strong>الموظف: </strong></label>
                <label class="col-md-4">{{ $order->employee}}  </label>
                <label class="control-label col-md-2"><strong>الفرع:</strong></label>
                <label class="col-md-3"  >{{ $order->branch}}  </label>
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
</div>
