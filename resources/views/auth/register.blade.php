@extends('layouts.app')
@section('title','Register')

@section('auth')
    <div class="wrapper wrapper-login">
        <div class="container container-signup animated fadeIn ">
            <h3 class="text-center">{!! trans('auth.sign_up') !!}</h3>
            <form id="register" method="post" action="{{route('register')}}" novalidate>
                @csrf
                <div class="login-form">
                    <div class="form-group">
                        <label for="fullname" class="placeholder"><b>{!! trans('auth.full_name') !!}</b></label>
                        <input  id="fullname" name="name" type="text" class="form-control" value="{{old('name')}}"  required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="placeholder"><b>{!! trans('auth.email') !!}</b></label>
                        <input  id="email" name="email" type="email" class="form-control  @error('email') is-invalid @enderror" autocomplete="off" value="{{old('email')}}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="placeholder"><b>{!! trans('auth.password') !!}</b></label>
                        <div class="position-relative">
                            <input  id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation2" class="placeholder"><b>{!! trans('auth.confirm_password') !!}</b></label>
                        <div class="position-relative">
                            <input  id="password_confirmation2" name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row form-action">
                        <div class="col-md-6">
                            <a href="{{url('login')}}"  class="btn btn-primary btn-link w-100 fw-bold">{!! trans('auth.sign_in') !!}</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit"  class="btn btn-primary w-100 fw-bold">{!! trans('auth.sign_up') !!}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
