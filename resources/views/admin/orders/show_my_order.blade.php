<?php 
$p=false;
foreach($order->details as $o)
    if($o->item->price)
        $p=true;
?>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th> رقم الصنف</th>
            <th>الصنف</th>
            @if ($p)
            <th>سعر الصنف</th> 
            @endif
            <th>الوحدة</th>
            <th>الكمية</th>
            <th>الملاحظات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->details as $o)
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
        @endforeach
    </tbody>
</table>
