@extends('admin.layouts.master')
@section('styles')
<link href="{{asset('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
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
                                <span class="caption-subject bold uppercase">Create Invoice</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                        <form action="{{route('invoice.update',$record->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                       <div class="form-group col-sm-6">
                                            <!-- <label for="name">Invoice Number : yymm</label> -->
                                            <input type="text" name="invoice_no" id="invoice_no" placeholder="Invoice Number" title="Invoice Number" value="{{old('invoice_no',$record->invoice_no)}}" class="form-control input-md" required readonly>
                                         </div>
                                        <div class="form-group col-sm-6">
                                            <!-- <label for="name">Date : </label> -->
                                            <input type="date" name="date" id="date" placeholder="Date" title="Date" value="{{old('date',$record->date)}}" class="form-control input-md" required>
                                         </div>
                                        <div class="form-group col-sm-6">
                                            <!-- <label for="name">Name : </label> -->
                                            <input type="text" name="name" id="name" placeholder="Name" title="Name" value="{{old('name',$record->name)}}" class="form-control input-md" required>
                                        </div>
                                         <div class="form-group col-sm-6">
                                            <!-- <label for="name">Email Id : </label> -->
                                            <input type="email" name="email" id="email" placeholder="Email" title="Email" value="{{old('email',$record->email)}}" class="form-control input-md" required>
                                         </div>
                                         <div class="form-group col-sm-6">
                                            <!-- <label for="name">Contact : </label> -->
                                            <input type="contact" name="contact" id="contact" placeholder="Contact" title="Contact" value="{{old('contact',$record->contact)}}" class="form-control input-md" required>
                                         </div>

                                         <div class="clearfix"></div>
                                         <div class="row">
                                       <div class="caption font-dark">
                                       <a href="javascript:;" id="add_course" class="btn"><i class="fa fa-plus-circle" id="section_icon"></i>
                                        <span class="caption-subject bold uppercase">ADD COURSES</span></a>
                                        <a href="javascript:;" class="pull-middle minimize" data-iconid="#course_minimize_icon" data-container=".course"><i class="fa fa fa-caret-up fa-lg" id="course_minimize_icon"></i></a>
                                        </div>
                                        </div>
                                        <hr/>
                                        <div class="course">
                                        <div class="course_item">
                                        <input type="number" name="course_count" id="course_count" value="{{count($course)}}" class="hide">
                                        <div class="col-sm-12 course_container" id="course_container0" data-count="0">
                                        </div>
                                        <?php 
                                        $count = 1;
                                       foreach ($course->sortBy('course_sort_order') as $item){ 
                                          ?>
                                           <div class="col-sm-12 course_container" id="course_container{{$count}}" data-count="{{$count}}">
                                                <h5><strong>Course {{$count}}</strong></h5>
                                                <div class="remove pull-right"><a href="javascript:;" data-remove="#course_container{{$count}}" class="btn btn-default remove_icon">
                                                                <i class="icon-trash"></i></a></div>
                                                <div class="clearfix"></div><br />
                                                <div class="form-group col-sm-6"> 
                                                        <select name="course{{$count}}_name" id="course{{$count}}_name" class="form-control input-md" aria-invalid="false" required>
                                                                <option value="">Please select course</option>
                                                                <option value="GRE Group" @if($item->course_name=="GRE Group") selected @endif>GRE Group</option>
                                                                <option value="GRE One-on-One" @if($item->course_name=="GRE One-on-One") selected @endif>GRE One-on-One</option>
                                                                <option value="GMAT Group" @if($item->course_name=="GMAT Group") selected @endif>GMAT Group</option>
                                                                <option value="GMAT One-on-One" @if($item->course_name=="GMAT One-on-One") selected @endif>GMAT One-on-One</option>
                                                                <option value="TOEFL" @if($item->course_name=="TOEFL") selected @endif>TOEFL</option>
                                                                <option value="SAT" @if($item->course_name=="SAT") selected @endif>SAT</option>
                                                                <option value="ACT" @if($item->course_name=="ACT") selected @endif>ACT</option>
                                                                <option value="IELTS-General" @if($item->course_name=="IELTS-General") selected @endif>IELTS-General</option>
                                                                <option value="IELTS-Academic" @if($item->course_name=="IELTS-Academic") selected @endif>IELTS-Academic</option>
                                                                <option value="MS Admissions Counselling" @if($item->course_name=="MS Admissions Counselling") selected @endif>MS Admissions Counselling</option>
                                                                <option value="MBA Admissions Counselling" @if($item->course_name=="MBA Admissions Counselling") selected @endif>MBA Admissions Counselling</option>
                                                                <option value="Under-Grad Admissions Counselling" @if($item->course_name=="Under-Grad Admissions Counselling") selected @endif>Under-Grad Admissions Counselling</option>
                                                        </select> 
                                                </div>
                                                <div class="form-group col-sm-6"> 
                                                <input type="text" name="course{{$count}}_fee" id="course{{$count}}_fee" placeholder="Course Fee" value="{{old('course_fee',$item->course_fee)}}" class="form-control input-md" required> 
                                                </div>
                                                <div class="form-group col-sm-4"> 
                                                <input type="number" name="course{{$count}}_sort_order" id="course{{$count++}}_sort_order" placeholder="Row No" value="{{old('course_sort_order',$item->course_sort_order)}}" class="form-control input-md hide" required> 
                                                </div>
                                                <hr>
                                        </div>
                                        <?php 
                                     }?>
                                        
                                        <div class="clearfix"></div>
                                        <div class="add-sub-content pull-right">
                                        <a href="javascript:;" class="btn btn-default" id="add_course_row"><i class="icon-plus"></i> Add New Course</a></div><br>
                                        </div>
                                        <hr>
                                       
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="row">
                                       <div class="caption font-dark">
                                       <a href="javascript:;" id="add_billing" class="btn"><i class="fa fa-plus-circle" id="section_icon"></i>
                                        <span class="caption-subject bold uppercase">BILLING DETAILS</span></a>
                                        <a href="javascript:;" class="pull-middle minimize" data-iconid="#billing_minimize_icon" data-container=".billing"><i class="fa fa fa-caret-up fa-lg" id="billing_minimize_icon"></i></a>
                                        </div>
                                        </div>
                                        <hr/>
                                        <div class="billing">
                                        <div class="billing_item">
                                        <div class="form-group col-sm-4">
                                            <label for="total_fee">Total FEE : </label>
                                            <input type="number" name="total_fee" id="total_fee" placeholder="Total Fee" title="Total Fee" value="{{old('total_fee',$record->total_fee)}}" class="form-control input-md" required readonly>
                                         </div>
                                         <div class="form-group col-sm-4">
                                         <label for="discount">Discount : </label>
                                            <p>
                                            <select name="discount" id="discount" class="form-control input-md" aria-invalid="false" required>
                                                <option value="">Please select discount %</option>
                                                <option value="0" @if($record->discount==0) selected @endif>0%</option>
                                                <option value="5" @if($record->discount==5) selected @endif>5%</option>
                                                <option value="10" @if($record->discount==10) selected @endif>10%</option>
                                                <option value="15" @if($record->discount==15) selected @endif>15%</option>
                                                <option value="20" @if($record->discount==20) selected @endif>20%</option>
                                                <option value="Group" @if($record->discount=="Group") selected @endif>Group Discount</option>
                                            </select>
                                            </p>
                                         </div>
                                         <div class="form-group col-sm-4">
                                            <label for="Discounted FEE">Discounted FEE : </label>
                                            <input type="number" name="discounted_fee" id="discounted_fee" placeholder="Discounted Fee" title="Discounted Fee" value="{{old('discounted_fee',$record->discounted_fee)}}" class="form-control input-md" required readonly>
                                         </div>
                                         
                                         <div class="clearfix"></div>
                                        <div class="form-group col-sm-6">
                                            <label for="payment_type">Payment Type : </label>
                                            <p>
                                            <select name="payment_type" id="payment_type" class="form-control input-md" aria-invalid="false" required>
                                                <option value="">Please select payment type</option>
                                                <option value="Credit Card" @if($record->payment_type=="Credit Card") selected @endif>Credit Card</option>
                                                <option value="Debit Card" @if($record->payment_type=="Debit Card") selected @endif>Debit Card</option>
                                                <option value="Cash" @if($record->payment_type=="Cash") selected @endif>Cash</option>
                                                <option value="Cheque" @if($record->payment_type=="Cheque") selected @endif>Cheque</option>
                                                <option value="Digital" @if($record->payment_type=="Digital") selected @endif>Digital</option>
                                            </select>
                                            </p>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="paid_amount">Paid Amount : </label>
                                            <input type="number" name="paid_amount" id="paid_amount" placeholder="Paid Amount" title="Paid Amount" value="{{old('paid_amount',$record->paid_amount)}}" class="form-control input-md" required>
                                         </div>
                                         <div class="clearfix"></div>
                                         <div class="form-group col-sm-6">
                                            <label for="due_amount">Due Amount : </label>
                                            <input type="number" name="due_amount" id="due_amount" placeholder="Due Amount" title="Due Amount" value="{{old('due_amount',$record->due_amount)}}" class="form-control input-md" required readonly>
                                         </div>
                                         <div class="form-group col-sm-6">
                                            <label for="due_date">Due Date : </label>
                                            <input type="date" name="due_date" id="due_date" placeholder="Due Date" title="Due Date" value="{{old('due_date',$record->due_date)}}" class="form-control input-md" required>
                                         </div>
                                         <div class="form-group col-sm-12">
                                            <label for="note">Note : </label>
                                            <input type="text" name="note" id="note" placeholder="Note" title="Note" value="{{old('note',$record->note)}}" class="form-control input-md">
                                         </div>
                                         
                                        </div>
                                        <hr>
                                       
                                        </div>
                                        <div class="clearfix"></div>
                                   
                                   
                                        
                                       
                                        <button type="submit" class="btn grey">Submit</button>
                                        <a href="{{admin_url('invoice')}}" class="btn grey">Back</a>
                                </form>
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
<script src="{{asset('admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $("#add_course_row").on("click",function(){
        var count = $(".course_container").last().data("count");
        count=count+1;
        var custom_section = '<div class="col-sm-12 course_container" id="course_container'+count+'" data-count="'+count+'"> <h5><strong>Course '+count+'</strong></h5> <div class="remove pull-right"><a href="javascript:;" data-remove="#course_container'+count+'" class="btn btn-default remove_icon"> <i class="icon-trash"></i></a></div> <div class="clearfix"></div><br/><div class="form-group col-sm-6">  <select name="course'+count+'_name" id="course'+count+'_name" class="form-control input-md" aria-invalid="false" required> <option value=" ">Please select course</option> <option value="GRE Group">GRE Group</option><option value="GRE One-on-One">GRE One-on-One</option><option value="GMAT Group">GMAT Group</option><option value="GMAT One-on-One">GMAT One-on-One</option> <option value="TOEFL">TOEFL</option> <option value="SAT">SAT</option> <option value="ACT">ACT</option> <option value="IELTS-General">IELTS-General</option> <option value="IELTS-Academic">IELTS-Academic</option> <option value="MS Admissions Counselling">MS Admissions Counselling</option> <option value="MBA Admissions Counselling">MBA Admissions Counselling</option> <option value="Under-Grad Admissions Counselling">Under-Grad Admissions Counselling</option> </select> </div> <div class="form-group col-sm-6">  <input type="text" name="course'+count+'_fee" id="course'+count+'_fee" placeholder="Course Fee" value="" class="form-control input-md" required> </div> <div class="form-group col-sm-4"> <input type="number" name="course'+count+'_sort_order" id="course'+count+'_sort_order" placeholder="Row No" value="'+count+'" class="form-control input-md hide" required> </div> <hr> </div>';
        $("#course_count").val(count);
        var container_id = "#course_container"+(count-1);
        $(container_id).after(custom_section);
     });

        jQuery(document).on('click', '.minimize', function(){
        if($($(this).data('iconid')).hasClass("fa-caret-down")){
            console.log($(this).data('iconid'));
            $($(this).data('iconid')).removeClass("fa-caret-down");
            $($(this).data('iconid')).addClass("fa-caret-up");
            $($(this).data('container')).show();
         }
        else{
            $($(this).data('iconid')).removeClass("fa-caret-up");
            $($(this).data('iconid')).addClass("fa-caret-down");
            $($(this).data('container')).hide();
        }
     });
    jQuery(document).on('click', '.remove_icon', function() {
       var section_container_id = $(this).data("remove");
       
       $(section_container_id).remove();
       
     });

     $("#total_fee").on('click', function(){
        var count = $(".course_container").last().data("count");
        var total = 0;
        for(var i=1; i<=count;i++){
             total = total + Number($("#course"+i+"_fee").val());
             console.log(total);
        }
        
        $("#total_fee").val(total);
     });

     $("#discount").on('change', function(){
        if($(this).val() == "Group"){
            var discount = 10/100;
        }
        else{
            var discount = $(this).val()/100;
        }
        var total = Number($("#total_fee").val());
        var total_discount = total * discount;
        var discounted_price = total - total_discount;
        $("#discounted_fee").val(discounted_price);
     });

     $("#paid_amount").on('change', function(){
        
        var discounted_price = Number($("#discounted_fee").val());
        var paid_amount = Number($("#paid_amount").val());
        var due_amount = discounted_price - paid_amount;
        $("#due_amount").val(due_amount);
     });

     $("#due_amount").on('click', function(){
        
        var discounted_price = Number($("#discounted_fee").val());
        var paid_amount = Number($("#paid_amount").val());
        var due_amount = discounted_price - paid_amount;
        $("#due_amount").val(due_amount);
     });


    });
</script>

@endsection
