<?php

namespace App\Models;

use Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;

class Contactus extends Model
{
    protected $table="contactus";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [getContactusListData This function is used to get contact us user list]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getContactusListData($request){

    	$sql=self::select("*");
    	return Datatables::of($sql)
    						->addColumn('action',function($data){
    							return '<a href="javascript:void(0)" data-route="'.route('admin.contactus.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
    						})
                ->editColumn('id',function($data){
                    return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
                })
                ->filter(function ($query) use ($request) {
                
                  if (isset($request['keyword']) && $request['keyword'] != "") {
                      $query->where('name', $request['keyword'])
                             ->orWhere('email',$request['keyword'])
                             ->orWhere('message',$request['keyword']);
                  }
                })
                ->rawColumns(['id','action'])
    						->make(true);
    }

    /**
     * [getContactus To get contact us page detail]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getContactus($id)
    {
        $country=self::findOrfail($id);
        return $country;
    }

    /**
     * [statusAll This function is used to active or inactive sepcifuc resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    public function statusAll($r){

       $input=$r->all();

        foreach ($input['checkbox'] as $key => $c) {

              $l = self::where('id',\Crypt::decrypt($c))->first();

              if ($l !=NULL) {
                  
                  if ($l->status == 1) {
                    $l->status = self::STATUS_INACTIVE;
                  }else{
                    $l->status = self::STATUS_ACTIVE;
                  }
                  $l->save();
              }
        }
        
       return response()->json(['success' => 1, 'msg' => trans('lang_data.banner_delete_message_label')]);
    }

     /**
     * [deleteAll This funtion is used to delete specific resources]
     * @param  [type] $r [description]
     * @return [type]    [description]
     * @author Chirag G.
     */
    public function deleteAll($r){

        $input=$r->all();
        foreach ($input['checkbox'] as $key => $c) {
            
            $obj = $this->findOrFail(Crypt::decrypt($c));
            $obj->delete();
            $msg = "Contactus Record Deleted Successfully.";
        }

        return response()->json(['success' => 1, 'msg' => "Contact us deleted successfully"]);   
    }

    /**
     * [storeFrontContactUs This function is used to store contact us detail of front user]
     * @param  [type] $r [description]
     * @return [type]    [description]
     */
    public function storeFrontContactUs($r){

      $setting = GET_SETTINNG_DATA();
      $errors="";
      $input = $r->all();
      
      $obj = new self;
      $obj->name = $input['name'];
      $obj->email = $input['email'];
      $obj->message = $input['message'];
      $obj->subject = $input['subject'];
      $obj->save();

      if ($obj !=null) {
        $mailcredential=getMailCredential();
        if($mailcredential != null ){

        $data  = \App\Models\EmailTemplate::where('title','send_mail_to_user_for_contact_us')->where('status',1)->first();

        if ($data !=null) {
          
          $template                         = $data->description;
          $sender                           = $data->from;
          
          $email_body = str_replace(array('###NAME###', '###SITE_URL###','###SITE_NAME###'), array($obj->name,route('front.home'),trans('lang_data.app_name')), $template);
              
          if (env('IS_LIVE_DEMO_LOCAL') == 'local') {
           Config::set('mail.driver',getMailCredential()->mail_driver);                                        
            Config::set('mail.host',getMailCredential()->mail_host);                      
            Config::set('mail.port',getMailCredential()->mail_port);                    
            Config::set('mail.encryption',getMailCredential()->mail_encryption);
            Config::set('mail.username',getMailCredential()->mail_username);                  
            Config::set('mail.from.name',getMailCredential()->mail_from_name);                  
            Config::set('mail.from.address',getMailCredential()->mail_from_address);                  
            Config::set('mail.password',getMailCredential()->mail_password);

            \Mail::send('emails.mail_template', ['email_body' => $email_body,'emailTemplate'=>$data], function ($message) use ($obj, $data) {
                $message->to($obj->email, $obj->name)->subject($data->subject);
                $message->from($data->from,trans('lang_data.app_name'));
            });
          }
        }

        $adminEmail  = \App\Models\EmailTemplate::where('title','send_mail_to_admin_for_contact_us')->where('status',1)->first();

        if ($adminEmail !=null) {
          
          $template                         = $adminEmail->description;
          $sender                           = $adminEmail->from;
          
          $email_body = str_replace(array('###NAME###','###EMAIL###','###SUBJECT###','###MESSAGE###','###SITE_URL###','###SITE_NAME###'), array($obj->name,$obj->email,$obj->subject,$obj->message,route('front.home'),trans('lang_data.app_name')), $template);
              
          if (env('IS_LIVE_DEMO_LOCAL') == 'local') {
          
            \Mail::send('emails.mail_template', ['email_body' => $email_body,'emailTemplate'=>$adminEmail], function ($message) use ($obj, $adminEmail,$setting) {
                $message->to([$setting->second_email,'info@softtechover.com'],$setting->author_name)->subject($adminEmail->subject);
                $message->from($adminEmail->from,trans('lang_data.app_name'));
            });
          }
        }
              
        $msg = trans('lang_data.thank_you_for_contact_label');
        flashMessage('success',$msg);
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
        
      }

        $msg = 'Currently Mail Cant Sended ';
        flashMessage('error',$msg);
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
    }

    }
}
