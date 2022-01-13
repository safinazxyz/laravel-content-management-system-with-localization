@extends('layouts.admin_layout.admin_auth_layout')
@section('admin-auth-content')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{trans('auth.forgotPasswordForm.title')}}</p>
            @if(Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(Session::has('status'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('status') }}
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
            <form action="{{ route('admin.forgot.password') }}" method="post">@csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control"
                           placeholder="{{trans('auth.forgotPasswordForm.emailPlaceholder')}}"
                           id="email"
                    name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{trans('auth.forgotPasswordForm.password')}}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{ route('admin.login') }}">{{trans('auth.login.login')}}</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('admin.register.page') }}" class="text-center">{{trans('auth.register.register')}}</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
