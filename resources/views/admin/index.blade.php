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
                    <h1>Records
                        <small>List of Records</small>
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
                                <span class="caption-subject bold uppercase">Records List</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6  text-right">
                                        <div class="btn-group">
                                        <a href="{{admin_url('invoice/create')}}" class="btn btn-success">Add New Record</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                                <thead>
                                <tr>
                                    <th> Invoice No </th>
                                    <th> Name </th>
                                    <th> Email Id </th>
                                    <th> Created </th>
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
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                
                                $count = 1;
                                foreach ($list as $record) {?>
                                <tr class="odd gradeX">
                                   
                                    <td data-id="{{$record->id}}">{{$record->invoice_no}}</td>
                                    <td> {{$record->name}} </td>
                                    <td> {{$record->email}} </td>
                                    <td> {{$record->created_at}} </td>
                                    <td><div class="dropdown show">
                                            <a class="btn btn-secondary green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Actions
                                              <i class="fa fa-angle-down"></i>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li>
                                                <a href="{{admin_url("invoice/")}}/{{$record->id}}/edit">
                                                <i class="icon-pencil"></i> Edit </a>
                                            </li>
                                            <li>
                                              <a href="{{admin_url("invoice/")}}/{{$record->invoice_no}}" target="_blank">
                                               <i class="icon-eye"></i> Generate Invoice PDF </a>
                                          </li>
                                            <li><a href="javascript:{}" onclick="document.getElementById('my_form{{$record->id}}').submit();">
                                            <i class="icon-trash"></i> Delete </a></li>
                                            <form action="{{admin_url("invoice/")}}/{{$record->id}}" method="post" id="my_form{{$record->id}}">
                                                {!! method_field('delete') !!}
                                                {!! csrf_field() !!}    
                                             </form>
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
