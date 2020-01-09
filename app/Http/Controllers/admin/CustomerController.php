<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\Course;
use App\Model\Customer;
use App\Model\Invoice;
use Carbon\Carbon;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $records =  Customer::orderBy('id','desc')->paginate(20);
        return view('admin.customer.index', ['list'=>$records]);
    }

    public function fetch_data(Request $request){
        if($request->ajax()){
            $page = $request->get('page');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $customers = Customer::where('name', 'like', '%'.$query.'%')
                                ->orderBy('id','desc')
                                ->paginate(20);
            
            return view('admin.customer.fetch_data',['list'=>$customers]);
        }
    }

    public function pdfdownload($id){
        $record = Customer::where(['invoice_no'=>$id])->first();
        $course = Course::where(['fk_customer_id'=>$record->id])->get();
        
        $pdf = PDF::loadView('email.customer', ['record'=>$record,'course'=>$course]);
        return $pdf->download('{{$record->invoiceno}}.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $record = Invoice::latest()->first();
        
        if(!$record){
            $record_no = 1;
        }
        else{
            $invoice_no = substr($record->invoice_no, -4);
            $record_no = $invoice_no+1;
        }
        
        
      
        //check first day in a year
        
        if ( date('z') === 0 ){
            $nextInvoiceNumber = Carbon::now()->format('y').Carbon::now()->format('m').'-0001';
        } else {
            //increase 1 with last invoice number
            $nextInvoiceNumber = Carbon::now()->format('y').Carbon::now()->format('m').'-'.str_pad($record_no,4,'0',STR_PAD_LEFT);
        }
        
       //return view('email.customer',['record'=>$record,'course'=>$course]);
     return view('admin.customer.create',['invoice_no'=>$nextInvoiceNumber]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $node = new Customer;
        
        $node->date = $request->date;
        $node->name = $request->name;
        $node->email = $request->email;
        $node->contact = $request->contact;
        $node->school = $request->school;
        $node->city = $request->city;
        $node->total_fee = $request->total_fee;
        $node->discount = $request->discount;
        if($request->discount_amount){
            $node->discount_amount = $request->discount_amount;  
        }
        else{
            $discount_amount = $request->total_fee - $request->discounted_fee;
            $node->discount_amount = $discount_amount;
        }
        
        $node->discounted_fee = $request->discounted_fee;
        $node->paid_amount = $request->paid_amount;
        $node->due_amount = $request->due_amount;
        
        $node->save();

        $invoice = new Invoice;
        $invoice->fk_customer_id = $node->id;
        $invoice->invoice_no = $request->invoice_no;
        $invoice->invoice_date = $request->date;
        $invoice->payment_type = $request->payment_type;
        $invoice->due_date = $request->due_date;
        $invoice->note = $request->note;
        $invoice->total_fee = $request->total_fee;
        $invoice->discount = $request->discount;
        if($request->discount_amount){
            $invoice->discount_amount = $request->discount_amount;  
        }
        else{
            $discount_amount = $request->total_fee - $request->discounted_fee;
            $invoice->discount_amount = $discount_amount;
        }
        $invoice->discounted_fee = $request->discounted_fee;
        $invoice->paid_amount = $request->paid_amount;
        $invoice->due_amount = $request->due_amount;

        $invoice->previous_paid = 0;
        $invoice->previous_due = 0;
        $invoice->previous_discount = 0;
        $invoice->previous_discounted_fee = 0;
        $invoice->courses_opted = $request->courses_opted;

        $invoice->save();


        if($request->course_count > 0){
            for($i=1;$i<=$request->course_count;$i++){
                if($request->{'course'.$i.'_name'}){
                    $course = new Course;
                    $course->fk_customer_id = $node->id;
                    $course->course_name = $request->{'course'.$i.'_name'};
                    $course->course_sort_order = $request->{'course'.$i.'_sort_order'};
                    $course->course_fee = $request->{'course'.$i.'_fee'};
                    $course->save();
                }
            }
        }
        return redirect('administrator/customer');
    }

    // public function email($node,$course){
    //     $mailMessage = view('email.customer',['record'=>$node,'course'=>$course])->render();
    //     $mailer = new MandrillMail();
    //     $mailer->mandrillSendMail($node->email,$node->name,'Anannt Payment Invoice',$mailMessage);
    // }

    // public function adminEmail($node,$course){
    //     $mailMessage = view('email.customer',['record'=>$node,'course'=>$course])->render();
    //     $mailer = new MandrillMail();
    //     $mailer->mandrillSendMail('support@anannt.com','Admin','Anannt Payment Invoice',$mailMessage);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $record = Customer::where(['invoice_no'=>$id])->first();
        $course = Course::where(['fk_customer_id'=>$record->id])->get();
        return view('email.customer',['record'=>$record,'course'=>$course])->render();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $record =  Customer::findOrFail($id);
        $course = Course::where(['fk_customer_id'=>$record->id])->get();
        $invoice = Invoice::where(['fk_customer_id'=>$record->id])->first();
        return view('admin.customer.edit', ['record'=>$record ,'course'=>$course,'invoice'=>$invoice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $node = Customer::findOrFail($id);
        $node->date = $request->date;
        $node->name = $request->name;
        $node->email = $request->email;
        $node->contact = $request->contact;
        $node->school = $request->school;
        $node->city = $request->city;
        // $node->total_fee = $request->total_fee;
        // $node->discount = $request->discount;
        // if($request->discount_amount){
        //     $node->discount_amount = $request->discount_amount;  
        // }
        // else{
        //     $discount_amount = $request->total_fee - $request->discounted_fee;
        //     $node->discount_amount = $discount_amount;
        // }
        
        // $node->discounted_fee = $request->discounted_fee;
        // $node->paid_amount = $request->paid_amount;
        // $node->due_amount = $request->due_amount;
        $node->save();

        // $invoice = Invoice::where(['fk_customer_id'=>$id])->first();
        // $invoice->fk_customer_id = $node->id;
        // $invoice->invoice_no = $request->invoice_no;
        // $invoice->invoice_date = $request->date;
        // $invoice->payment_type = $request->payment_type;
        // $invoice->due_date = $request->due_date;
        // $invoice->note = $request->note;
        // $invoice->total_fee = $request->total_fee;
        // if($request->discount_amount){
        //     $invoice->discount = $request->discount_amount;  
        // }
        // else{
        //     $discount_amount = $request->total_fee - $request->discounted_fee;
        //     $invoice->discount = $discount_amount;
        // }
        // $invoice->discounted_fee = $request->discounted_fee;
        // $invoice->paid_amount = $request->paid_amount;
        // $invoice->due_amount = $request->due_amount;
        // $invoice->save();

        //  //Course table delete old entries
        //  $courses = Course::where(['fk_customer_id'=>$id])->delete();
        //   //Course table new entries
        //  if($request->course_count > 0){
        //     for($i=1;$i<=$request->course_count;$i++){
        //         if($request->{'course'.$i.'_name'}){
        //             $course = new Course;
        //             $course->fk_customer_id = $node->id;
        //             $course->course_name = $request->{'course'.$i.'_name'};
        //             $course->course_sort_order = $request->{'course'.$i.'_sort_order'};
        //             $course->course_fee = $request->{'course'.$i.'_fee'};
        //             $course->save();
        //         }
        //     }
        // }

        
        
        return redirect('administrator/customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Course::where(['fk_customer_id'=>$id])->delete();
        Invoice::where(['fk_customer_id'=>$id])->delete();
        Customer::where(['id'=>$id])->delete();
        return redirect()->back();

    }
}
