@extends('layouts.admin_layout.admin_auth_layout')
@section('admin-auth-content')
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">{{trans('auth.register.title')}}</p>
            @if(Session::has('error_message'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.register') }}" method="post">@csrf
                <div class="input-group mb-3">
                    <input  id="full_name" name="full_name"
                            type="text" class="form-control" placeholder="{{trans('auth.register.fullNamePlaceholder')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input  id="email" name="email" type="email" class="form-control" placeholder="{{trans('auth.register.emailPlaceholder')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input  id="password" name="password"
                            type="password" class="form-control" placeholder="{{trans('auth.register.passwordPlaceholder')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password_confirmation" name="password_confirmation"
                           type="password" class="form-control" placeholder="{{trans('auth.register.confirmPasswordPlaceholder')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <!-- /.col -->
                    <div class="col-4">
                        <a href="{{ route('admin.login') }}" type="button" class="btn btn-default">{{trans('auth.login.login')}}</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{trans('auth.register.register')}}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
@endsection
