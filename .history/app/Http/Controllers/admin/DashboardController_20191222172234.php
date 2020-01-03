<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Course;
use App\Model\Customer;
use App\Model\Invoice;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function fetch_data(Request $request){
        if($request->ajax()){
            $month = $request->get('month');
            $year = substr($request->get('year'),-2);
            $customers = Customer::join('invoices', 'invoices.fk_customer_id', '=' , 'customers.id')
                                ->where('invoices.invoice_no' ,'LIKE', $year.'%')
                                ->where('invoices.invoice_no' ,'LIKE', '%'.$month.'-%')
                                ->select(DB::raw('customers.id as id,customers.name as name,invoices.invoice_no as invoice_no,invoices.paid_amount as paid_amount,invoices.courses_opted as course_name,invoices.due_amount as due_amount,invoices.discounted_fee as course_fee'))->get();
           
            // if($month != "" && $year!= "" && $course!=""){
            //     $customers = Customer::join('courses', 'courses.fk_customer_id', '=' , 'customers.id')
            //                     ->join('invoices', 'invoices.fk_customer_id', '=' , 'customers.id')
            //                     ->where('courses.course_name' ,'=',$course)
            //                     ->where('invoices.invoice_no' ,'LIKE', $year.'%')
            //                     ->where('invoices.invoice_no' ,'LIKE', '%'.$month.'-%')
            //                     ->select(DB::raw('customers.name as name,invoices.invoice_no as invoice_no,invoices.paid_amount as paid_amount,courses.course_name as course_name,courses.course_fee as course_fee'))->paginate(1000);
            // }
            // elseif($month != "" && $year != ""){
            //     $customers = Customer::join('courses', 'courses.fk_customer_id', '=' , 'customers.id')
            //                     ->join('invoices', 'invoices.fk_customer_id', '=' , 'customers.id')
            //                     ->where('invoices.invoice_no' ,'LIKE', $year.'%')
            //                     ->where('invoices.invoice_no' ,'LIKE', '%'.$month.'-%')
            //                     ->select(DB::raw('customers.name as name,invoices.invoice_no as invoice_no,invoices.paid_amount as paid_amount,courses.course_name as course_name,courses.course_fee as course_fee'))->paginate(1000);
            // }
            // elseif($year != "" && $course != ""){
            //     $customers = Customer::join('courses', 'courses.fk_customer_id', '=' , 'customers.id')
            //                     ->join('invoices', 'invoices.fk_customer_id', '=' , 'customers.id')
            //                     ->where('invoices.invoice_no' ,'LIKE', $year.'%')
            //                     ->where('courses.course_name' ,'=',$course)
            //                     ->select(DB::raw('customers.name as name,invoices.invoice_no as invoice_no,invoices.paid_amount as paid_amount,courses.course_name as course_name,courses.course_fee as course_fee'))->paginate(1000);
            // }
            // elseif($month != "" && $course != ""){
            //     $customers = Customer::join('courses', 'courses.fk_customer_id', '=' , 'customers.id')
            //                     ->join('invoices', 'invoices.fk_customer_id', '=' , 'customers.id')
            //                     ->where('courses.course_name' ,'=',$course)
            //                     ->where('invoices.invoice_no' ,'LIKE', '%'.$month.'-%')
            //                     ->select(DB::raw('customers.name as name,invoices.invoice_no as invoice_no,invoices.paid_amount as paid_amount,courses.course_name as course_name,courses.course_fee as course_fee'))->paginate(1000);
            // }
            // else{
            //     $customers = Customer::join('courses', 'courses.fk_customer_id', '=' , 'customers.id')
            //                     ->join('invoices', 'invoices.fk_customer_id', '=' , 'customers.id')
            //                     ->where(function ($q) use($course,$year,$month){
            //                         $q->where('courses.course_name' ,'=',$course);
            //                         $q->orWhere('invoices.invoice_no' ,'LIKE', '%'.$month.'%');
            //                         $q->orWhere('invoices.invoice_no' ,'LIKE', $year.'%');
            //                     })
            //                     ->select(DB::raw('customers.name as name,invoices.invoice_no as invoice_no,invoices.paid_amount as paid_amount,courses.course_name as course_name,courses.course_fee as course_fee'))->paginate(1000);

            // }
            
            $total = $customers->sum('paid_amount');
            $courses = Course::all();                          
            return view('admin.dashboard-monthly-overview',['list'=>$customers,'total'=>$total,'course'=>$courses]);
        }
    }

    public function season_fetch_data(Request $request){
        if($request->ajax()){
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');
            $invoices = Invoice::join('customers', 'invoices.fk_customer_id', '=' , 'customers.id')
                            ->whereBetween('invoices.invoice_date' ,[$start_date,$end_date])
                            ->orderBy('invoices.invoice_date','asc')
                            ->select(DB::raw('customers.id as id,customers.name as name,invoices.invoice_no as invoice_no,invoices.invoice_date as invoice_date,invoices.paid_amount as paid_amount,invoices.courses_opted as course_name,invoices.discounted_fee as course_fee'))->get();
           
            $total = $invoices->sum('paid_amount');
                                       
            return view('admin.dashboard-season-overview',['list'=>$invoices,'total'=>$total]);
        }
    }

    public function course_fetch_data(Request $request){
        if($request->ajax()){
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');
            $course = $request->get('course');
            if($end_date == "" && $start_date == ""){
                
                $invoices = Invoice::join('customers', 'invoices.fk_customer_id', '=' , 'customers.id')
                                   ->join('courses', 'courses.fk_customer_id', '=' , 'invoices.fk_customer_id')
                                   ->where('courses.course_name' ,'LIKE', '%'.$course.'%')
                                   ->orderBy('invoices.invoice_date','asc')
                                   ->select(DB::raw('customers.id as id,customers.name as name,courses.course_name as course_name,courses.course_fee as course_fee,invoices.invoice_no as invoice_no,invoices.invoice_date as invoice_date,invoices.paid_amount as paid_amount,invoices.discounted_fee as total_fee'))->get();
            }

            else{
                if($end_date == ""){
                    $end_date = Carbon::now(); 
                    $end_date = $end_date->format("Y-m-d"); 
                }
                if($start_date == ""){
                    $start_date = Carbon::now(); 
                    $start_date = $start_date->format("Y-m-d");
                }
                $invoices = Invoice::join('customers', 'invoices.fk_customer_id', '=' , 'customers.id')
                           ->join('courses', 'courses.fk_customer_id', '=' , 'invoices.fk_customer_id')
                           ->whereBetween('invoices.invoice_date' ,[$start_date,$end_date])
                           ->where('courses.course_name' ,'LIKE', '%'.$course.'%')
                           ->orderBy('invoices.invoice_date','asc')
                           ->select(DB::raw('customers.id as id,customers.name as name,courses.course_name as course_name,courses.course_fee as course_fee,invoices.invoice_no as invoice_no,invoices.invoice_date as invoice_date,invoices.paid_amount as paid_amount,invoices.discounted_fee as total_fee'))->get();

            }
            
            
            $total = $invoices->sum('paid_amount');
                                       
            return view('admin.dashboard-course-overview',['list'=>$invoices,'total'=>$total]);
        }
    }
    /**
     * step form
     *
     * @return void
     */
    function index(){
       $params['total_users'] = User::count();
       $params['total_customer'] = Customer::count(); 
       $params['total_revenue'] = Customer::sum('discounted_fee'); 
       $params['total_due'] = Customer::sum('due_amount');
       $params['total_paid'] = Customer::sum('paid_amount');
       $params['list'] = "";
       $params['total'] = "";
       $params['due_list'] = Customer::where('due_amount','!=',0)->get();

       if(Auth::user()->role == 1){
        return view('admin.dashboard',$params);
       }
       else{
        return view('employee.dashboard',$params);  
       }
        
    }
}
