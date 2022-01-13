@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('admin/sidebar.settings.adminUser')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('admin/sidebar.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('admin/settingForms.updateUsersList.formTitle')}}</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{trans('admin/settingForms.updateUsersList.formTitle')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{trans('admin/settingForms.updateUsersList.type')}}</th>
                                    <th>{{trans('admin/settingForms.updateUsersList.name')}}</th>
                                    <th>{{trans('admin/settingForms.updateUsersList.email')}}</th>
                                    <th>{{trans('admin/settingForms.updateUsersList.mobile')}}</th>
                                    <th>{{trans('admin/settingForms.updateUsersList.status')}}</th>
                                    <th>{{trans('admin/settingForms.updateUsersList.createdAt')}}</th>
                                    <th>{{trans('admin/settingForms.updateUsersList.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($adminDetails as $key=>$admin)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    @if(!empty($admin->type))
                                        <td>{{$admin->type}}</td>
                                        @else
                                        <td></td>
                                    @endif
                                    @if(!empty($admin->name))
                                        <td>{{ucwords(strtolower($admin->name))}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(!empty($admin->email))
                                        <td>{{$admin->email}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(!empty($admin->mobile))
                                        <td>{{$admin->mobile}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if($admin->status===1)
                                        <td class="bg-olive">Active</td>
                                    @else
                                        <td class="btn-secondary">InActive</td>
                                     @endif
                                    @if(!empty($admin->created_at))
                                        <td>{{$admin->created_at}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                        <button class="btn btn-success btn-icon btn-sm " data-myname="{{$admin->name}}" data-mystatus="{{$admin->status}}"
                                                data-myid="{{$admin->id}}" data-mytype="{{$admin->type}}" data-myphoto="{{$admin->image}}"
                                                    data-toggle="modal" data-target="#edit"> <i class="fa fa-edit"></i></button>
                                            @if(strtolower($admin->type)!=='admin')
                                            <button type="submit" title="delete" style="border: none;
                                            background-color:transparent;"
                                                    href="javascript:"
                                                    rel="{{ $admin->id }}" rel1="delete-sub-admin"
                                            class="deleteRecord">
                                                <i class="fas fa-trash fa-lg text-danger"></i>
                                            </button>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{trans('admin/settingForms.updateUsersList.editModal.title')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('admin.edit.admin.status') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="admin_id" id="admin_id" value="">
                    <div class="form-group">
                        <label for="name">{{trans('admin/settingForms.updateUsersList.editModal.photo')}}</label>
                        <img alt="profile photo" height="100" width="100"  id="admin_photo" src="">
                    </div>
                    <div class="form-group">
                        <label for="name">{{trans('admin/settingForms.updateUsersList.editModal.name')}}</label>
                        <input type="text" class="form-control" name="admin_name" id="admin_name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">{{trans('admin/settingForms.updateUsersList.editModal.type')}}</label>
                        <input type="text" class="form-control" name="admin_type" id="admin_type" readonly>
                    </div>
                    <div class="form-group adminStatus">
                        <label for="name">{{trans('admin/settingForms.updateUsersList.editModal.status')}}</label>
                        <input type="hidden" name="admin_status" id="admin_status" value=""/>
                    <input type="checkbox" class="form-control" name="admin_status_checkbox" id="admin_status_checkbox">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        {{trans('admin/settingForms.updateUsersList.editModal.close')}}</button>
                    <button type="submit" class="btn btn-primary adminStatus">
                        {{trans('admin/settingForms.updateUsersList.editModal.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
