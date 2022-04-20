<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\LoginRequest;
use Modules\Admin\Http\Requests\ForgotPasswordRequest;
use Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{   


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * [login To get login page view for admin user ]
     * @return [type] [description]
     */
    public function login(){
        
        return view('admin::auth.login');
    }

    /**
     * [postLogin This function is used to check login for admin user]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            flashMessage('success',trans('lang_data.login_success'));
            return redirect()->route('admin.dashboard');
        } else {

           flashMessage('error',trans('lang_data.valid_pass_email'));
           return redirect()->back();
        }
    }

    /**
     * [logout To logout user session this function is used]
     * @return [type] [description]
     */
    public function logout(){

        \Auth::logout();
        flashMessage('success',trans('lang_data.logout_msg'));
        return redirect(route('admin.login.main'));
    }

    /**
     * [forgotPassword This function is used to check forgot password logic]
     * @param  Request $r [description]
     * @return [type]     [description]
     */
    public function forgotPassword(Request $r){

        $input = $r->all();

        $checkUserExit = \App\Models\User::where("email",$input['email'])->first();
        
        if ($checkUserExit == NULL) {

            flashMessage('error',trans('lang_data.this_email_addres_not_exit'));
            return redirect()->back();

        } else {

            $token = GENERATE_TOKEN();
            $link  = route("admin.reset_password",$token);
            $data  = \App\Models\EmailTemplate::where('title','verify_front_news_letter')->first();
            $template                         = $data->description;
            $sender                           = $data->from;
            
            $email_body = str_replace(array('###LINK###','###SITE_NAME###'), array($link,route('front.home')), $template);
            
            if (env('IS_LIVE_DEMO_LOCAL') !="local") {
                
                \Mail::send('emails.mail_template', ['email_body' => $email_body], function ($message) use ($obj, $data) {
                    $message->to($obj->email, "User name")->subject($data->subject);
                    $message->from($data->from, "Softtechover.com");
                });
            }

            $checkUserExit->update(['forgot_password_token'=>$token]);
            flashMessage('success',trans('lang_data.we_have_sended_link_reset_your_password'));
            return redirect()->back();
        }
    }

    /**
     * [resetPassword To reset password page this function is used]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function resetPassword($id){

        $user = \App\Models\User::where('forgot_password_token',$id)->first();

        if ($user == null) {
            
            flashMessage('error',trans('lang_data.link_expire_wrong'));
            return redirect()->route('admin.login.main');

        }else{


            return view("admin::auth.reset_password",compact("user"));
        }

    }

    /**
     * [updatePassword To upddate password after forgot process]
     * @param  Request $r [description]
     * @return [type]     [description]
     */
    public function updatePassword(Request $r){

        $input = $r->all();
        if ($input['password'] == "") {
            
            flashMessage('error',trans('lang_data.password_required'));
            return redirect()->back();            

        }

        if (isset($input['token'])) {
                
            $user = \App\Models\User::where('forgot_password_token',$input['token'])->first();

            if ($user != null) {
                
                $user->password = \Hash::make($input['password']);
                $user->forgot_password_token = NULL;
                $user->save();

                flashMessage('success',trans('lang_data.passowrd_change_done'));
                return redirect()->route('admin.login.main');

            }else{

                flashMessage('error',trans('lang_data.link_expire_wrong'));
                return redirect()->back();

            }

        }else
        {
            flashMessage('error',trans('lang_data.link_expire_wrong'));
            return redirect()->back();
        }


    }
}
