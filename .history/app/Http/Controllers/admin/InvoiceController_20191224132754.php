<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Course;
use App\Model\Customer;
use App\Model\Invoice;
use App\Model\DubaiCourses;
use App\Model\DubaiCustomer;
use App\Model\DubaiInvoices;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->country == "Dubai"){
            $records =  DubaiInvoices::orderBy('invoice_no','desc')->paginate(20);
            $customers = DubaiCustomer::all();
        }else{
            $records =  Invoice::orderBy('invoice_no','desc')->paginate(20);
            $customers = Customer::all();  
        }
        return view('admin.invoice.index', ['list'=>$records,'customer' =>$customers]);
    }

    public function viewAll($id)
    {
        //
        $records =  Invoice::where(['fk_customer_id'=>$id])->orderBy('invoice_no','asc')->paginate(20);
        $customers = Customer::all();
        return view('admin.invoice.index', ['list'=>$records ,'customer' =>$customers]);
    }

    public function pdfdownload($id){
        $record = Customer::where(['invoice_no'=>$id])->first();
        $course = Course::where(['fk_customer_id'=>$record->id])->get();
        
        $pdf = PDF::loadView('email.customer', ['record'=>$record,'course'=>$course]);
        return $pdf->download('{{$record->invoiceno}}.pdf');
    }

    public function fetch_data(Request $request){
        if($request->ajax()){
            $page = $request->get('page');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $invoices = Invoice::where('invoice_no', 'like', '%'.$query.'%')
                                ->orderBy('invoice_no','desc')
                                ->paginate(20);
            $customers = Customer::all();
            return view('admin.invoice.fetch_data',['list'=>$invoices,'customer' =>$customers]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $record = Invoice::latest()->first();
        $customer = Customer::findOrFail($id);
        $course = Course::where(['fk_customer_id'=>$customer->id])->get();
        
        if(!$record){
            $record_no = 1;
        }
        else{
            $record_no = $record->id+1;
        }
      
        //check first day in a year
        
        if ( date('z') === 0 ){
            $nextInvoiceNumber = date('y').date('m').'-0001';
        } else {
            //increase 1 with last invoice number
            $nextInvoiceNumber = Carbon::now()->format('y').Carbon::now()->format('m').'-'.str_pad($record_no,4,'0',STR_PAD_LEFT);
        }
        
       //return view('email.customer',['record'=>$record,'course'=>$course]);
     return view('admin.invoice.create',['invoice_no'=>$nextInvoiceNumber,'record'=>$customer,'course'=>$course,'invoice'=>$record]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $node = Customer::findOrFail($id);
        $node->total_fee = $request->total_fee;
        $node->discount_amount = $request->total_discount;
        $node->discounted_fee = $request->discounted_fee;
        $node->paid_amount = $request->paid_amount + $request->previous_paid;
        $node->due_amount = $request->due_amount;
        
        $node->save();

        $course = Course::where(['fk_customer_id'=>$node->id])->get();
        
        if($request->course_count > 0){
            if($request->course_count != count($course)){
                Course::where(['fk_customer_id'=>$id])->delete();
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
            
        }

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

        $invoice->previous_paid = $request->previous_paid;
        $invoice->previous_due = $request->previous_deu;
        $invoice->previous_discount = $request->previous_discount;
        $invoice->previous_discounted_fee = $request->previous_discounted_fee;
        $invoice->courses_opted = $request->courses_opted;

        $invoice->save();
        

        //Mail::to($node->email->send(new OrderShipped($order));
        //$this->email($node,$course);
        //$this->adminEmail($node,$course);
        //return redirect()->route(admin_url('invoice-pdf'),$node->invoice_no);
        //return view('email.customer',['record'=>$node,'course'=>$course])->render();
        return redirect('administrator/invoice');
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
    public function pdf($id)
    {
        //
        $invoice = Invoice::where(['invoice_no'=>$id])->first();
        $record = Customer::where(['id'=>$invoice->fk_customer_id])->first();
        $invoice_courses = explode(',',$invoice->courses_opted);
        if($invoice->courses_opted){
            $courses = Course::where(['fk_customer_id'=>$record->id])
            ->where(['course_name'=>end($invoice_courses)])
            ->first();
            $course = Course::where(['fk_customer_id'=>$record->id])
                    ->where('course_sort_order','<=',$courses->course_sort_order)
                    ->get();
        }
        else{
            $course = Course::where(['fk_customer_id'=>$record->id])
                    ->get();
        }
        return view('email.customer',['record'=>$record,'course'=>$course ,'invoice'=>$invoice])->render();

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
        $invoice = Invoice::findOrFail($id);
        $record = Customer::where(['id'=>$invoice->fk_customer_id])->first();
        $invoice_courses = explode(',',$invoice->courses_opted);
        if($invoice->courses_opted){
            $courses = Course::where(['fk_customer_id'=>$record->id])
            ->where(['course_name'=>end($invoice_courses)])
            ->first();
            $course = Course::where(['fk_customer_id'=>$record->id])
                    ->where('course_sort_order','<=',$courses->course_sort_order)
                    ->get();
        }
        else{
            $course = Course::where(['fk_customer_id'=>$record->id])
                    ->get();
        }
        
        return view('admin.invoice.edit', ['record'=>$record ,'course'=>$course,'invoice'=>$invoice]);
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
        //dd($request);
        $invoice = Invoice::findOrFail($id);
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

        $invoice->previous_paid = $request->previous_paid;
        $invoice->previous_due = $request->previous_deu;
        $invoice->previous_discount = $request->previous_discount;
        $invoice->previous_discounted_fee = $request->previous_discounted_fee;
        if($request->courses_opted){
            $invoice->courses_opted = $request->courses_opted;
        }
        

        $invoice->save();

       $node = Customer::where(['id'=>$invoice->fk_customer_id])->first();
       $node->total_fee = $request->total_fee;
       $node->discount_amount = $request->total_discount;
       $node->discounted_fee = $request->discounted_fee;
       $node->paid_amount = $request->paid_amount + $request->previous_paid;
       $node->due_amount = $request->due_amount;
       
       $node->save();

       $course = Course::where(['fk_customer_id'=>$node->id])->get();
       
       if($request->course_count > 0){
           if($request->courses_opted){
               Course::where(['fk_customer_id'=>$node->id])->delete();
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
           
       }
       
       return redirect('administrator/invoice');
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
        Customer::where(['id'=>$id])->delete();
        return redirect()->back();

    }
}
