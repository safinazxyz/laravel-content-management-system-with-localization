@extends('layouts.admin_layout.admin_auth_layout')
@section('admin-auth-content')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{trans('auth.login.title')}}</p>
            @if(Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(Session::has('success_message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success_message') }}
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
            <form action="{{ route('admin.login') }}" method="post">@csrf
                <div class="input-group mb-3">
                    <input name="email" id="email" type="email" class="form-control" placeholder="{{trans('auth.login.emailPlaceholder')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input name="password" id="password" type="password" class="form-control" placeholder="{{trans('auth.login.passwordPlaceholder')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <!-- /.col -->
                    <div class="col-4">
                        <a href="{{ route('admin.register.page') }}" type="button" class="btn btn-default">{{trans('auth.register.register')}}</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{trans('auth.login.login')}}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('admin.forgot.password.page') }}">{{trans('auth.forgotPassword')}}</a>
            </p>
        </div>
    </div>
@endsection
