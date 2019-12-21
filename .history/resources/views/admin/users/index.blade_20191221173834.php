@extends('admin.layouts.master')

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Users
                        <small>List of Users</small>
                    </h1>
                </div>
            </div>
            <!-- END PAGE HEAD-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">User List</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                           <a href="{{admin_url('users/create')}}"><button class="btn btn-primary pull-right">Create User</button></a>
                                    </div>
                                </div>
                            </div>
                            {{-- <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2"> --}}
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                                <thead>
                                <tr>
                                    <th> Id </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Status </th>
                                    <th> created </th>
                                    <th> Actions </th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                //dd($list);
                                $count = 1;
                                foreach ($list as $users) {?>
                                <tr class="odd gradeX">
                                   
                                    <td data-id="{{$users->id}}">{{$count++}}</td>
                                    <td> {{$users->name}} </td>
                                    <td> {{$users->email}} </td>

                                    <td>
                                        <span class="label label-sm label-success"> @if(!empty($users->email_verified_at)) Verified @else Pending @endif </span>
                                    </td>
                                    <td>  {{$users->created_at}} </td>
                                    <td><div class="dropdown show">
                                    @if($users->role == 1)
                                            <h4>ADMIN</h4>
                                    @else
                                    <a class="btn btn-secondary green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Actions
                                              <i class="fa fa-angle-down"></i>
                                            </a>
                                    @endif
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            @if($users->role != 1)
                                            <li><a onclick="return confirm('Are you sure you want to delete this user?');" href="{{admin_url('users_destroy/'.$users->id)}}">
                                                        <i class="icon-trash"></i>Delete</a>
                                            </li>
                                            @endif
                                            </div>
                                          </div>
                                    </td>
                                </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                            {{ $list->links() }}
                        </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END DASHBOARD STATS 1-->

            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection
