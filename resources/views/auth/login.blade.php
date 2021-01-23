@extends('layouts.app')
@section('title','Login')

@section('auth')
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <h3 class="text-center">{!! trans('auth.sign_in') !!}</h3>
            <form id="login" method="post" action="{{route('login')}}">
                @csrf
                <div class="login-form">
                    <div class="form-group">
                        <label for="email" class="placeholder"><b>{!! trans('auth.email') !!}</b></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="placeholder"><b>{!! trans('auth.password') !!}</b></label>
                        <div class="position-relative">
                            <input id="password" name="password" type="password" class="form-control" required>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-action-d-flex mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberme" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label m-0" for="rememberme">{!! trans('auth.remember_me') !!}</label>
                        </div>
                        <button type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">{!! trans('auth.sign_in') !!}</button>
                    </div>
                    <div class="login-account">
                        <span class="msg">{!! trans('auth.dont_have_account_question') !!}</span>
                        <a href="{{url('register')}}"  class="link">{!! trans('auth.sign_up') !!}</a>
                    </div>
                </div>
            </form>
        </div>


    </div>
@endsection
