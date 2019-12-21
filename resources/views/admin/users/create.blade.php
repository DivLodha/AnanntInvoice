@extends('admin.layouts.master')
@section('styles')
    <link href="{{asset('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .name {
            font-weight: bolder;
        }

        .portlet-body .value {
            font-weight: 500;
        }
    </style>
@endsection
@section('content')



    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->

            <!-- END PAGE HEAD-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">ADD Users</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form action="{{route('users.store')}}" method="POST"
                                  id="users-add" enctype="multipart/form-data">
                                @csrf
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="firstName" id="firstName" placeholder="First Name"
                                                   title="First Name is Required" value="{{old('firstName')}}" class="form-control input-md" required >
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="lastName" id="lastName" placeholder="Last Name"
                                                   title="Last Name is Required" value="{{old('lastName')}}" class="form-control input-md">
                                        </div>
                                        <div class="form-group">
                                        <select name="country"  id="country_select" class="form-control input-md" required>
                                                <option value="">Please select country</option>
                                                <option value="India" @if(old('country') == "India") selected @endif>India</option>
                                                <option value="Dubai" @if(old('country') == "Dubai") selected @endif>Dubai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" placeholder="Email"
                                                   title="Email is Required" value="{{old('email')}}" class="form-control input-md" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" placeholder="Password"
                                                   title="Password is Required" value="" class="form-control input-md" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirmPassword"  id="confirmPassword" placeholder="Confirm Password"
                                                   title="Confirm Password is Required" value="" class="form-control input-md" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <input type="submit" id="users_add_submit"
                                   class="btn grey" value="Submit">
                                <a href="{{admin_url('users')}}" class="btn grey">Back</a>
                            </form>

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
@section('scripts')
    <script src="{{asset('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
   
@endsection
