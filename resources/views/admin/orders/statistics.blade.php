@extends("admin.master")

@section("title")
الإحصائيات
@endsection
@section("content")

<div class="row">
    <div class="col-sm-10">
        <form method="GET" action="{{ url('admin/orders/statistics') }}" class="row">
            @csrf
            <div class="col-sm-3">
                <input name="from" value="{{$from ?? ""}}" type="date" class="form-control" placeholder="من تاريخ">
            </div>
            <div class="col-sm-3">
                <input name="to" value="{{$to ?? ""}}" type="date" class="form-control" placeholder="إلى تاريخ">
            </div>
            <div class="col-sm-1">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>

</div>

<br>
@if(count($orders))
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>الصنف </th>
            <th width="40%">العدد </th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $key => $value)
        <?php
        $item=App\Models\Item::find($key);
         ?>
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $value }}</td>
            </tr>

        </tr>
        @endforeach
    </tbody>
  </table>

    @else
     <br>
     <br>
      <div class="alert alert-warning">نأسف لا يوجد بيانات لعرضها </div>
@endif



@endsection


