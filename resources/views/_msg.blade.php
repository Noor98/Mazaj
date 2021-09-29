@if(\Session::get("msg")!=NULL)
    <?php 
        $msg=\Session::get("msg");
        $msgClass="alert-info";
        $first2letter=strtolower(substr($msg,0,2));
        if($first2letter=="s:"){
           $msg=substr($msg,2);$msgClass="alert-success"; 
        }
        else if($first2letter=="e:"){
           $msg=substr($msg,2);$msgClass="alert-danger"; 
        }
        else if($first2letter=="i:"){
           $msg=substr($msg,2);$msgClass="alert-info"; 
        }
        else if($first2letter=="w:"){
           $msg=substr($msg,2);$msgClass="alert-warning"; 
        }
    ?>
    <div class="alert {{$msgClass}}">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{$msg}}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif