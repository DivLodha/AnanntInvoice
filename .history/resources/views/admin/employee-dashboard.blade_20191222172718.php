@extends('admin.layouts.master')
@section('styles')
<style>
.overview-tables{
overflow-y:scroll;
height:400px;
}

.portlet{
height:500px;
}

.table{
    height:400px;
}
</style>
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Anannt Invoice System
                        <small>statistics and reports</small>
                    </h1>
                </div>
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Dashboard</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                            <span data-counter="counterup" data-value="{{$total_customer}}"></span>
                            </div>
                            <div class="desc">Total Students </div>
                        </div>
                    </a>
                </div>
                
            <!-- END DASHBOARD STATS 1-->
            <!-- BEGIN EXAMPLE TABLE PORTLET 1-->
            <div class="row">
                 <div class="col-md-6">
                 <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="icon-settings font-green"></i>
                            <span class="caption-subject bold uppercase">Due Payments</span>
                        </div>
                    </div>
                    <div class="portlet-body overview-tables">
                        <table class="table table-striped table-bordered" id="due_payment">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Total Fee</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                                $fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::DECIMAL);
                                if($due_list){
                                $count = 1;
                               
                                foreach ($due_list as $record) {?>
                                <tr>
                                <td data-id="{{$record->id}}">{{$count++}}</td>
                                <td> {{$record->name}} </td>
                                <td> {{$record->discounted_fee}} </td>
                                <td> {{$record->paid_amount}} </td>
                                <td> {{$record->due_amount}} </td>
                                </tr>
                                <?php }
                                ?>
                                <tr>
                                <td colspan="4" align="center">
                                <strong>Total Due Amount</strong>
                                </td>

                                <td>
                                {{$fmt->format($due_list->sum('due_amount'))}}
                                </td>
                                </tr>
                                <?php
                                } ?>

                                @if(!$due_list)
                                <tr>
                                <td colspan="8" style="text-align:left;padding-left:20px;">
                                    <h4>No Results Found</h4>
                                </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>
            <!-- END EXAMPLE TABLE PORTLET 1-->
            <!-- BEGIN EXAMPLE TABLE PORTLET 2-->
            
             <!-- END EXAMPLE TABLE PORTLET 2-->               
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
   

     function fetch_data(month,year){
        $.ajax({
            url:"administrator/dashboard/monthly/fetch_data?year="+year+"&month="+month,
            success:function(data){
                $('#monthly_overview_body').html('');
                $('#monthly_overview_body').html(data);
            }
        })
    }

    function fetch_season_overview(start_date,end_date){
        $.ajax({
            url:"administrator/dashboard/date-wise/fetch_data?start_date="+start_date+"&end_date="+end_date,
            success:function(data){
                $('#season_overview_body').html('');
                $('#season_overview_body').html(data);
            }
        })
    }

    function fetch_course_overview(start_date,end_date,course){
        $.ajax({
            url:"administrator/dashboard/course-wise/fetch_data?start_date="+start_date+"&end_date="+end_date+"&course="+course,
            success:function(data){
                $('#course_overview_body').html('');
                $('#course_overview_body').html(data);
            }
        })
    }

    $(document).on('click','#monthly_overview_search',function(event){
        var month = $("#monthly_overview_month").val();
        var year = $("#monthly_overview_year").val();
        if(month == "" || year == ""){
            $("#monthly_overview-error").show();
        }
        else{
            $("#monthly_overview-error").hide();
            fetch_data(month,year);
        }
        
    });

    $(document).on('click','#season_overview_search',function(event){
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        if(start_date == "" || end_date == ""){
            $("#season_overview-error").show();
            $('#season_overview_body').html('');
        }
        else{
            $("#season_overview-error").hide();
            fetch_season_overview(start_date,end_date);
        }
        
    });

    $(document).on('click','#course_overview_search',function(event){
        var start_date = $("#course_start_date").val();
        var end_date = $("#course_end_date").val();
        var course = $("#overview_course").val();
        if(course == ""){
            $("#course_overview-error").show();
            $('#course_overview_body').html('');
        }
        else{
            $("#course_overview-error").hide();
            fetch_course_overview(start_date,end_date,course);
        }
        
    });
});
</script>
@endsection
