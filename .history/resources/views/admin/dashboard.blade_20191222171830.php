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
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$total_revenue}}"></span> </div>
                            <div class="desc">Total Revenue </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$total_due}}"></span>
                            </div>
                            <div class="desc">Total Due</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$total_paid}}"></span></div>
                            <div class="desc">Total Paid </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
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
            <div class="col-md-6">
                 <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="icon-settings font-green"></i>
                            <span class="caption-subject bold uppercase">Monthly Overview</span>
                        </div>
                    </div>
                    <div class="form-group">
                       
                        <div class="col-md-9">
                            <div class="margin-bottom-10">
                                <select class="bs-select form-control input-small" data-style="green" name="monthly_overview_year" id="monthly_overview_year">
                                    <option value="">Year</option>
                                    <option value="2019" selected>2019</option>
                                    <option value="2020">2020</option>
                                </select>
                                <select class="bs-select form-control input-small" data-style="purple" name="monthly_overview_month" id="monthly_overview_month">
                                    <option value="">Month</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <button class="btn btn-md blue table-group-action-submit pull-right" id="monthly_overview_search">
                            <i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                    <div class="col-sm-12">
                    <label id="monthly_overview-error" class="error" for="monthly_overview_year" style="display:none">Please Select Month and Year both.</label>
                    </div>
                   
                    <div class="portlet-body overview-tables" style="height:350px;">
                        <table class="table table-striped table-bordered " id="monthly_overview">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Invoice No</th>
                                    <th>Course Name</th>
                                    <th>Paid Amount</th>
                                </tr>
                            </thead>
                            <tbody id="monthly_overview_body">
                            @include("admin.dashboard-monthly-overview")
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            <div class="clearfix"></div>
            <!-- END EXAMPLE TABLE PORTLET 1-->
            <!-- BEGIN EXAMPLE TABLE PORTLET 2-->
            <div class="row">
                 <div class="col-md-6">
                 <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="icon-settings font-green"></i>
                            <span class="caption-subject bold uppercase">Season Overview</span>
                        </div>
                    </div>
                    <div class="form-group">
                       
                        <div class="col-md-5">
                            <div class="margin-bottom-10" >
                            <label for="start_date">Please Select Start Date</label>
                                <div class="input-group input-small date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="start_date" name="start_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-5">
                            <div class="margin-bottom-10" >
                                <label for="end_date">Please Select End Date</label>
                                <div class="input-group input-small date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="end_date" name="end_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                        <div class="margin-bottom-10">
                        <button class="btn btn-md blue table-group-action-submit pull-right" id="season_overview_search">
                            <i class="fa fa-search"></i> Search</button>
                                </div>
                        
                        </div>
                    </div>
                    <div class="col-sm-12">
                    <label id="season_overview-error" class="error" for="season_overview_year" style="display:none">Please Select Start and End Date.</label>
                    </div>
                    <div class="portlet-body overview-tables" style="height:330px;">
                        <table class="table table-striped table-bordered " id="seasonal_overview">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Paid Amount</th>
                                </tr>
                            </thead>
                            <tbody id="season_overview_body">
                            @include("admin.dashboard-season-overview")
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="icon-settings font-green"></i>
                            <span class="caption-subject bold uppercase">Course Wise Overview</span>
                        </div>
                    </div>
                    <div class="form-group">
                       
                        <div class="col-md-3">
                            <div class="margin-bottom-10" >
                            <label for="course_start_date">Start Date</label>
                                <div class="input-group input-small date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="course_start_date" name="course_start_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="margin-bottom-10" >
                                <label for="course_end_date">End Date</label>
                                <div class="input-group input-small date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" class="form-control" id="course_end_date" name="course_end_date">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <label for="course_end_date">Please Select Course</label>
                        <select class="bs-select form-control input-small" data-style="purple" name="overview_course" id="overview_course">
                                    <option value="">Courses</option>
                                    <option value="GRE Group">GRE Group</option>
                                    <option value="GRE One-on-One">GRE One-on-One</option>
                                    <option value="GMAT Group">GMAT Group</option>
                                    <option value="GMAT One-on-One">GMAT One-on-One</option>
                                    <option value="TOEFL">TOEFL</option>
                                    <option value="SAT Group">SAT Group</option>
                                    <option value="SAT One-on-One">SAT One-on-One</option>
                                    <option value="ACT">ACT</option>
                                    <option value="IELTS-General">IELTS-General</option>
                                    <option value="IELTS-Academic">IELTS-Academic</option>
                                    <option value="MS Admissions Counselling">MS Admissions Counselling</option>
                                    <option value="MBA Admissions Counselling">MBA Admissions Counselling</option>
                                    <option value="Under-Grad Admissions Counselling">Under-Grad Admissions Counselling</option>
                                    <option value="Boaster Camp">Boaster Camp</option>
                                    <option value="Refresher Course">Refresher Course</option>
                                    <option value="Other">Other</option>
                                </select>
                        </div>
                        <div class="col-md-2">
                        <div class="margin-bottom-10">
                        <button class="btn btn-md blue table-group-action-submit pull-right" id="course_overview_search">
                            <i class="fa fa-search"></i> Search</button>
                                </div>
                        
                        </div>
                    </div>
                    <div class="col-sm-12">
                    <label id="course_overview-error" class="error" for="course_overview_year" style="display:none">Please Select Course.</label>
                    </div>
                    <div class="portlet-body overview-tables" style="height:330px;">
                        <table class="table table-striped table-bordered " id="course_overview">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Course</th>
                                    <th>Course Fee</th>
                                    <th>Total Fee</th>
                                    <th>Paid Amount</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="course_overview_body">
                            @include("admin.dashboard-course-overview")
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
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
