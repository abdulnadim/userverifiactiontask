<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmailVerification;
use Carbon\Carbon;

use App\Notifications\emailVerificationRequest;
use App\Notifications\emailVerificationSucess;
use Illuminate\Http\Request;
use Illuminate\Http\Support\Facades\DB;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function index(){      
        $data=User::all();
        if(sizeof($data)){
            $data=$data;
        }else{
            $data=[];
        }
        return view('admin/userlist',["data"=>$data]);
    }

    static function userlist(){      
        $data=User::orderBy('id','desc')->get();
        if(sizeof($data)){
            $data=$data;
        }else{
            $data=[];
        }
        return $data;
    }

   
    public function manage_user(Request $request,$id='')
    {   
        
        if($id > 0){
            $user=User::where(['id'=>$id])->first();
            $result['name']=$user->name;
            $result['email']=$user->email;
            $result['mobile']=$user->address;
            $result['id']=$user->id;

        }else{
            $result['name']="";
            $result['email']="";
            $result['mobile']="";           
            $result['id']="";
        }
        
        return view("admin/useradd",$result);
    }

    public function verifyEmail($email='', $token=''){
            
        $data = ['email'=>$email,"token"=>$token];   
        // print_r($data);
        // die;         
        $check = Emailverification::where([['token', $token], ['email', base64_decode($email)]])->first();
       
        if(!empty($check)){
            $emaildecode=base64_decode($email);
                $user = User::where('email',$emaildecode)->first();
                if(!$user) {                        
                    $data['wrong_email'] = trans('customMessages.wrongEmail');
                    return view('user.emailVerification',$data);
                }else{
                    $user->is_userverified = 1;
                    $user->email_verified_at = carbon::now()->format('Y-m-d h:i:s');
                    $user->save();
                    $data['is_userverified'] = trans('customMessages.is_userverified');
                    Emailverification::where([['token', $token], ['email', base64_decode($email)]])->delete();
                    return view('user.emailVerification',$data);
                }
        }else{
           $data['invalid'] = trans('customMessages.verificationTokenInvalid');
            return view('user.emailVerification',$data);
        }
    

    }

    public function user_manage_process(Request $request)
    {      
       
        $request->validate([
            'name'=>'required',
            'email'=>"required|email",
            'mobile'=>'required',
        ]);
        if($request->post('id') >0){
           $user=User::find($request->post('id')) ;
           $msg="User Updated";
        }else{
            $user= new User;
            $msg="User Created";
        }
        
        // dd($request);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
          
       $query=$user->save();
        if($query==true){
            $otp=Str::uuid();
                        $emailVerify= EmailVerification::where('email',$request->email)->first();
                        if(!empty($emailVerify)){
                            $result1 = EmailVerification::where('email',$request->email)->update(['token'=>$otp]);                           
                        }else{
                            $emailVerify = new EmailVerification;
                            $emailVerify->email = $request->email;
                            $emailVerify->token= $otp;
                            $result1 = $emailVerify->save();
                            
                        } 
            $user->notify(new emailVerificationRequest($otp)); 
            $request->session()->flash('msg', $msg);            
            return redirect('admin/user');
        }else{
            $request->session()->flash('erroe_msg',"failed try again");            
            return redirect('admin/user');
        }
       
    }

    public function delete(Request $request,$id)
    {       
        $model=User::find($id);
        $model->delete();     
        $request->session()->flash('msg',"User  Deleted");
        return redirect('admin/user');

    }
    

}
