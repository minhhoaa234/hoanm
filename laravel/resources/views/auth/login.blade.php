@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                                <style>
                                    #logo-akb{
                                        display:block;
                                        margin:auto;
                                        width: auto;
                                    }
                                </style>
                                <a href=""> </a>
                            
                        </div>
                            
                        <div class="row">
                        <br>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                                @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" type="text" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="{{__('E-Mail Address') }}">

                                    @error('email')
                                        <div class="alert alert-danger " data-dismiss="alert" >
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="{{ __('Password') }}">

                                    @error('password')
                                        <div class="alert alert-danger " data-dismiss="alert" >
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn  btn-block login-submit" >
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

