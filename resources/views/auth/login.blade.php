@extends('layouts.app')
@section("css")
<style>
.remember{
    margin-right:12% !important;
}

.login{
    margin-right:22% !important;
}
</style>
@stop
@section('content')
<div class="container" style="max-width:50%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: rgba(255, 255, 255, 0.247)">
                <!--<div class="card-header text-right" >{{ __('تسجيل الدخول') }}</div>-->
                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}" style="margin-top: 2em">
                        @csrf

                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('اسم المستخدم') }}</label>

                            <div class="col-md-6">
                                <input id="user_name" type="user_name" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4 remember" >
                                <div class="form-check">
                                    <input class="form-check-input " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label mr-4" for="remember">
                                        {{ __('تذكرني') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="login col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('دخول') }}
                                </button>

                                {{--@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('نسيت كلمة المرور?') }}
                                    </a>
                                @endif
                                --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
