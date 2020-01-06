<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<div class="container">
<!-- <div class="col-sm-12">
<a href="{{admin_url('pdf/')}}/{{$record->id}}">Download PDF</a>
</div> -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-2">
                        

                        <div class="col-md-6 text-left">
                            <p class="font-weight-bold mb-1">Invoice #{{$invoice->invoice_no}}</p>
                            <h3 class="mb-1" style="color:#0000be">Eduanannt Education LLC</h3>
                            <p class="text-muted mb-1">810,Burjuman Business Tower,
                                                      Burjuman</p>		
                            <p class="text-muted">0585853551 / 043260100</p>
                            <p class="text-muted">Date : {{\Carbon\Carbon::parse($invoice->invoice_date)->format('M d, Y')}}</p>
                        </div>

                        <div class="col-md-6 text-center">
                            <img src="{{url('assets/images/logo.png')}}" style="width: 75%; max-width: 300px">
                        </div>
                    </div>

                    <hr class="my-1">

                    <div class="row p-3">
                        
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Student Information</p>
                            <p class="mb-1">{{$record->name}}</p>
                            <p class="mb-1">{{$record->email}}</p>
                            <p class="mb-1">{{$record->contact}}</p>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 text-left">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted font-weight-bold">Payment Type : </span> {{$invoice->payment_type}}</p>
                            @if($invoice->due_amount != 0)
                            <p class="mb-1"><span class="text-muted font-weight-bold">Due Date : </span> {{\Carbon\Carbon::parse($invoice->due_date)->format('M d, Y')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Fee</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Paid Amount</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Due Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($course->sortBy('course_sort_order') as $item) {
                                        ?>
                                    <tr>
                                    <td>{{$item->course_name}}</td>
                                    <td>dh {{$item->course_fee}}</td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    <?php } ?>
                                    
                                    @if($invoice->discount_amount != 0)
                                    <tr>
                                        <td>Fee</td>
                                        <td><span class="font-weight-bold">dh {{$invoice->total_fee}}</span></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                   
                                    <tr>
                                        <td>Discounted Fee</td>
                                        <td><span class="font-weight-bold">dh {{$invoice->discounted_fee}}</span></td>
                                        <td><span class="font-weight-bold">dh {{$invoice->paid_amount}}</span></td>
                                        <td><span class="font-weight-bold">dh {{$invoice->due_amount}}</span></td>
                                        
                                    </tr>
                                    @else
                                    <tr>
                                        <td>Total Fee</td>
                                        <td><span class="font-weight-bold">dh {{$invoice->total_fee}}</span></td>
                                        <td><span class="font-weight-bold">dh {{$invoice->paid_amount}}</span></td>
                                        <td><span class="font-weight-bold">dh {{$invoice->due_amount}}</span></td>
                                        
                                    </tr>
                                    @endif
                                    @if($invoice->vat == 1)
                                    <tr>
                                        <td>VAT (5%)</td>
                                        <td>dh {{$invoice->vat_amount}}</td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    @endif
                                    <!-- <tr>
                                        <td></td>
                                        <td></td>
                                        <td><span class="font-weight-bold">dh {{$record->paid_amount}}</span></td>
                                        <td><span class="font-weight-bold">dh {{$record->due_amount}}</span></td>
                                    </tr> -->
                                   
                                </tbody>
                            </table>
                        </div>
                        <p style="padding-left:20px;padding-bottomm:0px" class="text-muted"> Notes : {{$invoice->note}}.</p> 
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white">
                    <div class="py-3 px-5 text-right">
                            <div class="mb-2">Total paid</div>
                            <div class="h2 font-weight-light">dh {{$invoice->paid_amount + $invoice->previous_paid}}</div>
                        </div>
                        @if($invoice->discount_amount != 0)
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Total Discount</div>
                            <div class="h2 font-weight-light">dh {{$invoice->discount_amount}}</div>
                        </div>
                         <!-- <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discounted Price</div>
                            <div class="h2 font-weight-light">dh {{$invoice->discounted_fee}}</div>
                        </div> -->
                        @endif
                        </div>
                    <div class="text-dark text-center" style="padding: 10px;">
                        <h6 >Thank you for choosing Anannt!</h6>
                        <br>   
                    </div>
                    <div class="text-dark p-2 text-left">
                        <p>Note: This is a computer generated Receipt, it does not require any signature or stamp.</p>
                        <ol>
                            <li>Cancellation of classes are NOT allowed unless agreed by both the parties.</li>
                            <li>We have NO Refund/transfer policy.</li>
                            <li>For any further queries please feel free to email at support@anannt.com</li>
                            <li>NO score guarantee offered.</li>
                        </ol>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


