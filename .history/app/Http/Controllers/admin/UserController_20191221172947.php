<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  User::paginate(20);
        return view('admin.users.index', ['list'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
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
        $this->validate($request, [
            'firstName' => 'required',
            'email' => 'required|unique:users',
            'country' => 'required',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password'
        ]);
        $db = new User();
        
        $db->name = $request->firstName." ".$request->lastName;
        $db->email = $request->email;
        $db->country = $request->country;
        $db->email_verified_at = Carbon::now();
        $db->password = Hash::make($request->password);
        $db->role = 2;
        $db->save();
       
        return back()->with('success', 'User Creation Successfully Done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user =  User::findOrFail($id);
        // return view('admin.users.show', ['list'=>$user]);
    }

    public function view($id)
    {
        
        $user =  User::findOrFail($id);
        return view('admin.users.show', ['list'=>$user]);
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
    }
}
