@extends('admin.layouts.master')
@section('styles')
<style>
.search_bar{
    float: right;
    position: relative;
    height: auto;
}

.search_bar .search_text{
    width: 250px;
    padding: 10px 15px;
}

.search_bar .search-icon{
    position: absolute;
    right: 10px;
    top: 8px;
    background:transparent;
    border:medium none;
}

.speaker_search{
    float: left;
    width: 100%;
    padding: 10px 0px;
    border-bottom: 1px solid #eee;
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
                    <h1>Invoices
                        <small>List of Invoices</small>
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
                                <span class="caption-subject bold uppercase">Invoice</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="search_bar pull-left">
                                               <input type="text" class="search_text" id="search_text" name="search_text" placeholder="SEARCH">
                                               <a type="submit" class="search-icon" id="search_speaker">
                                                   <i class="fa fa-search" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                    </div>
                                    <!-- <div class="col-md-6  text-right">
                                        <div class="btn-group">
                                        <a href="{{admin_url('customer/create')}}" class="btn btn-success">Add New Customer</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                                <thead>
                                <tr>
                                    <th> Sr </th>
                                    <th> Invoice No </th>
                                    <th> Name </th>
                                    <th> Email Id </th>
                                    <th> Paid Amount </th>
                                    <th> VAT Amount </th>
                                    <th> Actions </th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                @include("admin.edu-invoice.fetch_data")
                                </tbody>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1"/>
                            </table>
                            
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
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){

    //function for fetch data according to pagination using ajax call
    function fetch_data(page,query){
        $.ajax({
            url:"invoice/pagination/fetch_data?page="+page+"&query="+query,
            success:function(data){
                $('tbody').html('');
                $('tbody').html(data);
            }
        })
    }

    $(document).on('click','#search_team_member',function(event){
        
        var query = $("#search_text").val();
        var page = $("#hidden_page").val();
        fetch_data(page,query);
    });

    $(document).on('keyup','#search_text',function(event){
        
        var query = $("#search_text").val();
        var page = $("#hidden_page").val();
        fetch_data(page,query);
    });

    
    $(document).on('click','.pagination a',function(event){
        
        event.preventDefault();
        var query = $("#search_text").val();
        var page = $(this).attr('href').split("page=")[1];
        $("#hidden_page").val(page);
        fetch_data(page,query);
    });

     
});
</script>

@endsection

