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
                        <form action="{{route('invoice.update',$invoice->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    
                                       <div class="form-group col-sm-6">
                                            <!-- <label for="name">Invoice Number : yymm</label> -->
                                            <input type="text" name="invoice_no" id="invoice_no" placeholder="Invoice Number" title="Invoice Number" value="{{old('invoice_no',$invoice->invoice_no)}}" class="form-control input-md" required readonly>
                                         </div>
                                        <div class="form-group col-sm-6">
                                            <!-- <label for="name">Date : </label> -->
                                            <input type="date" name="date" id="date" placeholder="Date" title="Date" value="{{old('name',$invoice->invoice_date)}}" class="form-control input-md" required>
                                         </div>
                                        <div class="form-group col-sm-6">
                                            <!-- <label for="name">Name : </label> -->
                                            <input type="text" name="name" id="name" placeholder="Name" title="Name" value="{{old('name',$record->name)}}" class="form-control input-md" required readonly>
                                        </div>
                                         <div class="form-group col-sm-6">
                                            <!-- <label for="name">Email Id : </label> -->
                                            <input type="email" name="email" id="email" placeholder="Email" title="Email" value="{{old('email',$record->email)}}" class="form-control input-md" required readonly>
                                         </div>
                                         <div class="form-group col-sm-6">
                                            <!-- <label for="name">Contact : </label> -->
                                            <input type="contact" name="contact" id="contact" placeholder="Contact" title="Contact" value="{{old('contact',$record->contact)}}" class="form-control input-md" required readonly>
                                         </div>
                                         <div class="form-group col-sm-6">
                                            <!-- <label for="name">Contact : </label> -->
                                            <input type="text" name="school" id="school" placeholder="School/College" title="School/College" value="{{old('school',$record->school)}}" class="form-control input-md" readonly>
                                         </div>
                                         <div class="form-group col-sm-6">
                                            <!-- <label for="name">Contact : </label> -->
                                            <input type="text" name="city" id="city" placeholder="City" title="City" value="{{old('city',$record->city)}}" class="form-control input-md" readonly>
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
                                                        <select name="course{{$count}}_name" id="course{{$count}}_name" class="form-control input-md course-name" aria-invalid="false" required>
                                                                <option value="">Please select course</option>
                                                                <option value="GRE Group" @if($item->course_name=="GRE Group") selected @endif>GRE Group</option>
                                                                <option value="GRE One-on-One" @if($item->course_name=="GRE One-on-One") selected @endif>GRE One-on-One</option>
                                                                <option value="GMAT Group" @if($item->course_name=="GMAT Group") selected @endif>GMAT Group</option>
                                                                <option value="GMAT One-on-One" @if($item->course_name=="GMAT One-on-One") selected @endif>GMAT One-on-One</option>
                                                                <option value="TOEFL" @if($item->course_name=="TOEFL") selected @endif>TOEFL</option>
                                                                <option value="SAT Group" @if($item->course_name=="SAT Group") selected @endif>SAT</option>
                                                                <option value="SAT One-on-One" @if($item->course_name=="SAT One-on-One") selected @endif>SAT One-on-One</option>
                                                                <option value="ACT" @if($item->course_name=="ACT") selected @endif>ACT</option>
                                                                <option value="IELTS-General" @if($item->course_name=="IELTS-General") selected @endif>IELTS-General</option>
                                                                <option value="IELTS-Academic" @if($item->course_name=="IELTS-Academic") selected @endif>IELTS-Academic</option>
                                                                <option value="MS Admissions Counselling" @if($item->course_name=="MS Admissions Counselling") selected @endif>MS Admissions Counselling</option>
                                                                <option value="MBA Admissions Counselling" @if($item->course_name=="MBA Admissions Counselling") selected @endif>MBA Admissions Counselling</option>
                                                                <option value="Under-Grad Admissions Counselling" @if($item->course_name=="Under-Grad Admissions Counselling") selected @endif>Under-Grad Admissions Counselling</option>
                                                                <option value="Boaster Camp" @if($item->course_name=="Boaster Camp") selected @endif>Boaster Camp</option>
                                                                <option value="Refresher Course" @if($item->course_name=="Refresher Course") selected @endif>Refresher Course</option>
                                                                <option value="Other" @if($item->course_name=="Other") selected @endif>Other</option>
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
                                        <div class="form-group col-sm-6">
                                            <label for="total_fee">Total FEE : </label>
                                            <input type="number" name="total_fee" id="total_fee" placeholder="Total Fee" title="Total Fee" value="{{old('total_fee',$invoice->total_fee)}}" class="form-control input-md" required readonly>
                                         </div>
                                         <div class="form-group col-sm-6">
                                            <label for="total_fee">Previous Paid Amount : </label>
                                            <input type="number" name="previous_paid" id="previous_paid" placeholder="Total Paid Amount" title="Total Paid Amount" value="{{old('previous_paid',$invoice->previous_paid)}}" class="form-control input-md" required readonly>
                                         </div>
                                        

                                         <div class="form-group col-sm-6">
                                            <label for="Discounted FEE">Previous Discount : </label>
                                            <input type="number" name="previous_discount" id="previous_discount" placeholder="Total Discount" title="Total Discount" value="{{old('discounted_fee',$invoice->previous_discount)}}" class="form-control input-md" required readonly>
                                         </div>

                                         <div class="form-group col-sm-6">
                                            <label for="Discounted FEE">Previous Discounted FEE : </label>
                                            <input type="number" name="previous_discounted_fee" id="previous_discounted_fee" placeholder="Previous Discounted Fee" title="Previous Discounted Fee" value="{{old('discounted_fee', $invoice->previous_discounted_fee)}}" class="form-control input-md" required readonly>
                                         </div>
                                         <div class="form-group col-sm-6">
                                            <label for="total_fee">Previous Due Amount : </label>
                                            <input type="number" name="previous_deu" id="previous_deu" placeholder="Total Due Amount" title="Total Due Amount" value="{{old('due_amount',$invoice->previous_due)}}" class="form-control input-md" required readonly>
                                         </div>
                                         <div class="form-group col-sm-6">
                                         <label for="discount">Add Discount : </label>
                                            
                                            <select name="discount" id="discount" class="form-control input-md" aria-invalid="false" required>
                                                <option value="">Please select discount %</option>
                                                <option value="0"  @if($invoice->discount==0) selected @endif>0%</option>
                                                <option value="Discount Amount"  @if($invoice->discount == "Discount Amount") selected @endif>Discount Amount</option>
                                                
                                            </select>
                                        
                                         </div>

                                         @if($invoice->discount == "Discount Amount")
                                      
                                        <div class="form-group col-sm-6" id="discount_amount_div" style="display:block">
                                            <label for="Discount Amount">Discount Amount : </label>
                                            <input type="number" name="discount_amount" id="discount_amount" placeholder="Discount Amount" title="Discount Amount" value="{{old('discount_amount',$invoice->discount_amount)}}" class="form-control input-md" >
                                         </div>
                                         @else
                                         <div class="form-group col-sm-6" id="discount_amount_div" style="display:none">
                                            <label for="Discount Amount">Discount Amount : </label>
                                            <input type="number" name="discount_amount" id="discount_amount" placeholder="Discount Amount" title="Discount Amount" value="" class="form-control input-md">
                                         </div>
                                        @endif

                                     

                                         <div class="form-group col-sm-6">
                                            <label for="Discounted FEE">Total Discount : </label>
                                            <input type="number" name="total_discount" id="total_discount" placeholder="Total Discount" title="Total Discount" value="{{old('total_discount',$record->discount_amount)}}" class="form-control input-md" required readonly>
                                         </div>

                                         <div class="form-group col-sm-6">
                                            <label for="Discounted FEE">New Discounted FEE : </label>
                                            <input type="number" name="discounted_fee" id="discounted_fee" placeholder="Discounted Fee" title="Discounted Fee" value="{{old('discounted_fee',$invoice->discounted_fee)}}" class="form-control input-md" required readonly>
                                         </div>
                                         
                                         <div class="clearfix"></div>
                                        <div class="form-group col-sm-6">
                                            <label for="payment_type">Payment Type : </label>
                                           
                                            <select name="payment_type" id="payment_type" class="form-control input-md" aria-invalid="false" required>
                                                <option value="">Please select payment type</option>
                                                <option value="Credit Card" @if($invoice->payment_type=="Credit Card") selected @endif>Credit Card</option>
                                                <option value="Debit Card" @if($invoice->payment_type=="Debit Card") selected @endif>Debit Card</option>
                                                <option value="Cash" @if($invoice->payment_type=="Cash") selected @endif>Cash</option>
                                                <option value="Cheque" @if($invoice->payment_type=="Cheque") selected @endif>Cheque</option>
                                                <option value="Digital" @if($invoice->payment_type=="Digital") selected @endif>Digital</option>
                                                <option value="Bank Deposit" @if($invoice->payment_type=="Bank Deposit") selected @endif>Bank Deposit</option>
                                            </select>
                                            
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="paid_amount">Paid Amount : </label>
                                            <input type="number" name="paid_amount" id="paid_amount" placeholder="Paid Amount" title="Paid Amount" value="{{old('paid_amount',$invoice->paid_amount)}}" class="form-control input-md" required>
                                         </div>
                                         <div class="clearfix"></div>
                                         <div class="form-group col-sm-6">
                                            <label for="due_amount">Due Amount : </label>
                                            <input type="number" name="due_amount" id="due_amount" placeholder="Due Amount" title="Due Amount" value="{{old('due_amount',$invoice->due_amount)}}" class="form-control input-md" required readonly>
                                         </div>
                                         <div class="form-group col-sm-6">
                                            <label for="due_date">Due Date : </label>
                                            <input type="date" name="due_date" id="due_date" placeholder="Due Date" title="Due Date" value="{{old('due_date',$invoice->due_date)}}" class="form-control input-md">
                                         </div>
                                         <div class="form-group col-sm-12">
                                            <label for="note">Note : </label>
                                            <input type="text" name="note" id="note" placeholder="Note" title="Note" value="{{old('note',$invoice->note)}}" class="form-control input-md">
                                         </div>
                                         
                                        </div>
                                        <hr>
                                       
                                        </div>
                                        <div class="clearfix"></div>
                                   
                                   
                                        <input type="hidden" name="courses_opted" id="courses_opted" value="" />
                                       
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
        var custom_section = '<div class="col-sm-12 course_container" id="course_container'+count+'" data-count="'+count+'"> <h5><strong>Course '+count+'</strong></h5> <div class="remove pull-right"><a href="javascript:;" data-remove="#course_container'+count+'" class="btn btn-default remove_icon"> <i class="icon-trash"></i></a></div> <div class="clearfix"></div><br/><div class="form-group col-sm-6">  <select name="course'+count+'_name" id="course'+count+'_name" class="form-control input-md course-name" aria-invalid="false" required> <option value=" ">Please select course</option> <option value="GRE Group">GRE Group</option><option value="GRE One-on-One">GRE One-on-One</option><option value="GMAT Group">GMAT Group</option><option value="GMAT One-on-One">GMAT One-on-One</option> <option value="TOEFL">TOEFL</option> <option value="SAT">SAT</option> <option value="ACT">ACT</option> <option value="IELTS-General">IELTS-General</option> <option value="IELTS-Academic">IELTS-Academic</option> <option value="MS Admissions Counselling">MS Admissions Counselling</option> <option value="MBA Admissions Counselling">MBA Admissions Counselling</option> <option value="Under-Grad Admissions Counselling">Under-Grad Admissions Counselling</option><option value="Boaster Camp">Boaster Camp</option><option value="Refresher Course">Refresher Course</option><option value="Other">Other</option> </select> </div> <div class="form-group col-sm-6">  <input type="text" name="course'+count+'_fee" id="course'+count+'_fee" placeholder="Course Fee" value="" class="form-control input-md" required> </div> <div class="form-group col-sm-4"> <input type="number" name="course'+count+'_sort_order" id="course'+count+'_sort_order" placeholder="Row No" value="'+count+'" class="form-control input-md hide" required> </div> <hr> </div>';
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

     jQuery(document).on('change', '.course-name', function() {
            var inputs = $(".course-name");
            var courses_opted = [];
            for(var i = 0; i < inputs.length; i++){
                courses_opted.push($(inputs[i]).val());
            }
        $("input[name=courses_opted]").val(courses_opted.join(","));
        console.log($("#courses_opted").val());
        });

    jQuery(document).on('click', '.remove_icon', function() {
       var section_container_id = $(this).data("remove");
       $(section_container_id).remove();
       
       var inputs = $(".course-name");
            var courses_opted = [];
            for(var i = 0; i < inputs.length; i++){
                courses_opted.push($(inputs[i]).val());
            }
        $("input[name=courses_opted]").val(courses_opted.join(","));
        console.log($("#courses_opted").val());
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
        
       if($(this).val() == "Discount Amount"){
            var discount = 0;
            $("#discount_amount_div").show();
        }
        else{
            var discount = 0;
            $("#discount_amount_div").show();
            $("#discount_amount").attr('readonly', 'readonly');
            $("#discount_amount").val(discount);
        }
        var total_fee = Number($("#total_fee").val());
        var previous_discount = Number($("#previous_discount").val());
        var new_discount = total_fee * discount;
        var total_discount = previous_discount + new_discount;
        var discounted_price = total_fee - total_discount;
        $("#total_discount").val(total_discount);
        $("#discounted_fee").val(discounted_price);
     });

     $("#total_discount").on('click', function(){
        
        if($("#discount option:selected").text()== "Discount Amount"){
            var old_discount = Number($("#previous_discount").val());
            var new_discount = Number($('#discount_amount').val());
            var total_discount = old_discount + new_discount;
            $("#total_discount").val(total_discount);
        }
     });

     $(document).on('click', '#discounted_fee', function(){
        if($("#discount option:selected").text()== "Discount Amount"){
            var total_fee = Number($("#total_fee").val());
            var total_discount = Number($('#total_discount').val());
            var discounted_price = total_fee - total_discount;
            $("#discounted_fee").val(discounted_price);
            console.log(total_discount);
        }
    });

     $("#paid_amount").on('change', function(){
        
        var discounted_fee = Number($("#discounted_fee").val());
        var paid_amount = Number($("#paid_amount").val());
        var previous_paid = Number($("#previous_paid").val());
        
        var due_amount = discounted_fee - (previous_paid + paid_amount);
        $("#due_amount").val(due_amount);
     });

     $("#due_amount").on('click', function(){
        
        var discounted_fee = Number($("#discounted_fee").val());
        var paid_amount = Number($("#paid_amount").val());
        var previous_paid = Number($("#previous_paid").val());
        var due_amount = discounted_fee - (previous_paid + paid_amount);
        $("#due_amount").val(due_amount);
     });


    });
</script>

@endsection
