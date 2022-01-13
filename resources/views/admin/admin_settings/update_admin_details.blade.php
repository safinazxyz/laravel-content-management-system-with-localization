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
                        <li class="breadcrumb-item active">{{trans('admin/settingForms.updateAdminDetails.formTitle')}}</li>
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
                            <h3 class="card-title">{{trans('admin/settingForms.updateAdminDetails.formTitle')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('admin.update.admin.details') }}"
                        name="updateAdminDetailsForm" id="updateAdminDetailsForm"
                        enctype="multipart/form-data">@csrf
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
                                    <label for="exampleInputEmail1">{{trans('admin/settingForms.updateAdminDetails.email')}}</label>
                                    <input class="form-control"
                                           value="{{$adminDetails->email}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('admin/settingForms.updateAdminDetails.type')}}</label>
                                    <input class="form-control"
                                           value="{{$adminDetails->type}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('admin/settingForms.updateAdminDetails.name')}}</label>
                                    <input type="text" id="admin_name"
                                           name="admin_name" class="form-control"
                                           value="{{ucwords(strtolower($adminDetails->name))}}"
                                    placeholder="{{trans('admin/settingForms.updateAdminDetails.placeholder.name')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('admin/settingForms.updateAdminDetails.mobile')}}</label>
                                    <input class="form-control" type="text"
                                           id="admin_mobile" name="admin_mobile"
                                           value="{{$adminDetails->mobile}}"
                                           placeholder="{{trans('admin/settingForms.updateAdminDetails.placeholder.mobile')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{trans('admin/settingForms.updateAdminDetails.image')}}</label>
                                    <input class="form-control"
                                           type="file" id="admin_image" name="admin_image"
                                    accept="image/*">
                                    @if(!empty(Auth::guard('admin')->user()->image))
                                        <a href="{{ url('img/admin_img/admin_profile/'.Auth::guard('admin')->user()->image) }}">
                                            {{trans('admin/settingForms.updateAdminDetails.viewImage')}}</a>
                                        <input class="form-control"
                                               type="hidden" id="current_admin_image"
                                               name="current_admin_image"
                                        value="{{ Auth::guard('admin')->user()->image }}">
                                        @endif
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
