@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('admin/sidebar.settings.settings')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('admin/sidebar.home')}}</a></li>
                        <li class="breadcrumb-item active">Admin {{trans('admin/settingForms.settings')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-12 col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{trans('admin/settingForms.updateAdminPassword')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('admin.update.admin.current.pwd') }}"
                        name="updatePasswordForm" id="updatePasswordForm">@csrf
                            @if($errors->any())
                                <div class="alert alert-danger mt-2">
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
                            @if(Session::has('error_message'))
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(Session::has('success_message'))
                                <div class="alert alert-success mt-2" role="alert">
                                    {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('admin/settingForms.adminEmail')}}</label>
                                    <input class="form-control"
                                           value="{{$adminDetails->email}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('admin/settingForms.adminType')}}</label>
                                    <input class="form-control"
                                           value="{{$adminDetails->type}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{trans('admin/settingForms.currentPassword')}}</label>
                                    <input type="password" class="form-control" name="current_password"
                                           id="current_password"
                                           placeholder="{{trans('admin/settingForms.placeholder.currentPsw')}}" required>
                                    <div id="chkCurrentPwd"></div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{trans('admin/settingForms.newPassword')}}</label>
                                    <input type="password" class="form-control" name="new_pwd"
                                           id="new_pwd"
                                           placeholder="{{trans('admin/settingForms.placeholder.newPsw')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{trans('admin/settingForms.confirmPassword')}}</label>
                                    <input type="password" class="form-control"  name="confirm_new_pwd"
                                           id="confirm_new_pwd"
                                           placeholder="{{trans('admin/settingForms.placeholder.confirmPsw')}}" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{trans('admin/settingForms.submit')}}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
