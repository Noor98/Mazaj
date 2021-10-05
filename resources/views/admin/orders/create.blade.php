@extends("admin.master")

@section("title")
اضافة طلبية جديدة
@endsection
@section("content")
<div class="row">
    <div class="col-md-12">

        <form method="post" action="/admin/orders"  enctype="multipart/form-data" class="
         form-horizontal">
           @csrf

        <div class="form-group">
            <label for="name" class="align col-sm-2 control-label">اسم المستخدم </label>
            <div class="col-sm-10 col-md-5">
                <span > <strong> {{ auth()->user()->user_name  }} </strong></span>
            </div>
        </div>

        <div class="form-group">
            <label for="order_date" class="align col-sm-2 control-label">تاريخ الطلبية</label>
                <div class="col-sm-5">
                    <span > <strong> {{ date('Y-m-d') }} </strong></span>
                </div>
        </div>

        <div class="form-group">
             <label for="name" class="align col-sm-2 control-label"> التصنيف</label>
                <div class="col-sm-5">
                    <select name="category_id" id="category_id" class="form-control">
                        <option value=""> التصنيف</option>
                        @foreach($categories as $c)
                            <option {{old("categories")==$c->id?"selected":""}} value="{{$c->id}}">{{$c->name}} </option>
                        @endforeach
                    </select>
                 </div>
        </div>



        <div class="form-group">
            <label for="description" class="align col-sm-2 control-label">ملاحظات</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" id="description" placeholder="ملاحظات">{{old("description")}}</textarea>
                </div>
        </div>

        <div class="form-group">
            <label for="description" class="align col-sm-2 control-label">الاصناف</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <select name="item_id" id="item_id" class="autosearch form-control">
                                <option value="">اختر الصنف</option>

                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" id="quantity" min="1" step="1" name="quantity" placeholder="الكمية" class="form-control" />
                        </div>

                        <div class="col-sm-2">
                            <input readonly id="unit" placeholder="الوحدة" class="form-control" />
                        </div>

                        <div class="col-sm-4">
                            <input type="text" id="item_description"  name="item_description" placeholder="ملاحظات" class="form-control" />
                        </div>
                        <div class="col-sm-1">
                            <button id="btnAdd" class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <hr>
                    <div class="panel">
                        <div class="panel-heading">
                            الاصناف
                        </div>
                        <table class="table table-striped table-hover" id="tbl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الصنف</th>
                                    <th>الوحدة</th>
                                    <th>الكمية</th>
                                    <th>ملاحظات</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="item_id_arr"></div>
                        <div class="qty_arr"></div>
                        <div class="desc_arr"></div>

                    </div>
                </div>
        </div>

         <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">إضافة</button>
                <a href="/admin/orders/my_orders" class="btn btn-default">الغاء</a>
            </div>
          </div>

</form>
    </div>
</div>
@endsection

@section("css")
<style>
    .error{
        border-color: red !important;
    }
</style>
@endsection


@section("js")

    <script>
       $(function(){
            $("#category_id").change(function(){
                $("#item_id").prop("disabled",true);
                $("#item_id").children(":gt(0)").remove();
                var id=$(this).val();
                $.get("/admin/items/by_order_type/"+id,function(json){
                    $("#item_id").prop("disabled",false);
                    $(json.items).each(function(){
                        $("#item_id").append("<option value='"+this.id+"'>"+this.name+"</option>");
                    });
                },"json");
            });

            $("#item_id").change(function(){
                if($(this).val()!=""){
                   var id=$(this).val();
                   $.get("/admin/units/by_order_type/"+id,function(json){
                    $(json.unit).each(function(){
                        $("#unit").val(this.name);
                       });
                    },"json");
                }
                else{
                    $("#unit").val("");
                }
            });


            $(document).on("click",".btnDel",function(){
                $(this).closest("tr").remove();
                UpdateHiddenFields();
            })

            $(document).on("change",".error",function(){
                if($(this).val()!="")
                    $(this).removeClass("error");
            });

            $("#btnAdd").click(function(){
                var id=$("#item_id").val();
                var name=$("#item_id").children(":selected").text();
                var unit=$("#unit").val();
                var quantity=$("#quantity").val();
                var item_description=$("#item_description").val();
                var error=false;



                /*if($("#category_id").val()==""){
                    if(!error)
                        $("#category_id").focus();
                    $("#category_id").addClass("error");
                    error=true;
                }*/

                if(id==""){
                    if(!error)
                        $("#item_id").focus();
                    $("#item_id").addClass("error");
                    error=true;
                }

                if(quantity<=0){
                    if(!error)
                        $("#quantity").focus();
                    $("#quantity").addClass("error");
                    error=true;
                }


                if(!error){
                $("#tbl tbody").append('<tr>'+
                '<td class="id">'+id+'</td>'+
                '<td>'+name+'</td>'+
                '<td>'+unit+'</td>'+
                '<td  class="quantity">'+quantity+'</td>'+
                '<td class="item_description">'+item_description+'</td>'+
                '<td><button class="btn btnDel btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>'+
                '</tr>');
                $("#item_id").val("").change().focus();
                $("#quantity,#unit,#item_description").val("");
                UpdateHiddenFields();
                  }
            });
        });

        function UpdateHiddenFields(){
            $(".item_id_arr").html("");
            $(".qty_arr").html("");
            $(".desc_arr").html("");
            $("#tbl tbody tr").each(function(){
                var id=$(this).find(".id").text();
                $(".item_id_arr").append("<input type='hidden' name='item_id_arr[]' value='"+id+"' />");

                var quantity=$(this).find(".quantity").text();
                $(".qty_arr").append("<input type='hidden' name='qty_arr[]' value='"+quantity+"' />");

                var item_description=$(this).find(".item_description").text();
                $(".desc_arr").append("<input type='hidden' name='desc_arr[]' value='"+item_description+"' />");

            });
        }
        $('.autosearch').select2({
        placeholder: ' اختر الصنف',
        ajax: {
            url: '/admin/search',
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
