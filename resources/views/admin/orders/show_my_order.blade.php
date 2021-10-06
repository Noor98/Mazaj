<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>الصنف</th>
            <th>سعر الصنف</th>
            <th>الوحدة</th>
            <th>الكمية</th>
            <th>الملاحظات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->details as $o)
        <tr>
            <td>{{$o->item->name}}</td>
            <td>{{$o->item->price}}</td>
            <td>{{$o->item->unit->name}}</td>
            <td>{{$o->quantity}} </td>
            <td width="30%">{{$o->item_description}} </td>
        </tr>
        @endforeach
    </tbody>
</table>
