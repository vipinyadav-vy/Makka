@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            @if(session()->has("error"))
                <div class="alert alert-danger">
                    {{session()->get("error")}}
                </div>
            @endif
            <p class="login-box-msg">Sign in </p>
            <form action="{{ route('login') }}" method="post" autocomplete="off">
            @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}"  placeholder="Email" required autocomplete="off">
                
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-danger col-12">{{$message}}</p>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-danger col-12">{{$message}}</p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
           <diV class="col-12 text-right">
                <label>
                <a class="text-align: left !important;" href="{{ route('forgot-password') }}">Forget Password</a>
            </label>
           </diV>
        </div>
     </div>
</div>
@endsection




