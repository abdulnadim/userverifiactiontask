<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\LatestNews;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
   public function index(){
      return view('admin/login');
   }

    public function auth(Request $request){
      
      $email=$request->post('email');
      $password=$request->post('password');
      $result=Admin::where(['email'=>$email])->first();  
      
      if($result->id){
         if(Hash::check($password,$result->password)){           
            $request->session()->put('ADMIN_lOGIN', true);
            $request->session()->put('ADMIN_ID', $result->id);
            $request->session()->flash('status','Welcome'.' '.$result->user_name);
               return redirect('admin/dashboard');
         }else{
            $request->session()->flash('error', 'Please enter correct details');
            return redirect('/admin');
         }
      }
      else{
         $request->session()->flash('error', 'Please enter valid credential');
         return redirect('/admin');
      }
         
    }   
    
   public function dashboard()
   {
      return view('admin/dashboard');
   }
   public function updatepassword(){
         $r=Admin::find(1);
         $r->password=Hash::make('12345678');
         $r->save();
   }



}