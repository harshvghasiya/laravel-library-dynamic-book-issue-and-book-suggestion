<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class NewsLetter extends Model
{

    protected $table="newsletters";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [getNewsLetterListData This function is used to get newsletter listing]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getNewsLetterListData($request){

        $sql=self::select("*");
        return Datatables::of($sql)
              						->addColumn('action',function($data){
              							
                            $string = '<a href="'.route('admin.news-letter.edit',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                            if (env('ACCESS_TO_DELETE') == true) {

                                $string .='<a href="javascript:void(0)" data-route="'.route('admin.news-letter.destroy',Crypt::encrypt($data->id)).'" class="btn btn-xs btn-danger delete_record"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            } 
                            
                            return $string;
              						})
                          ->editColumn('id',function($data){
                              return '<input type="checkbox" name="checkbox[]" class="select_checkbox_value" value="'.Crypt::encrypt($data->id).'" />';
                          })
                          ->addColumn('status',function($data){
                              return getStatusIcon($data);
                          })
                          ->filter(function ($query) use ($request) {

                              if (isset($request['keyword']) && $request['keyword'] != "") {
                                  $query->where('email', $request['keyword']);
                              }                    
                          })
                  			->rawColumns(['id','action','status','created_at','updated_at'])
                  			->make(true);
    }

    /**
     * [saveNewsLetter This function is used to save and update newsletter data ]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function saveNewsLetter($r,$id=NULL){

    	$errors="";
    	$input = $r->all();
    	if ($id !== NULL) {

        $id=Crypt::decrypt($id);
			  $obj = self::find($id);
          
      }else{

      	$obj = new self;

      }
      
      $obj->email = $input['email'];
      $obj->status = $input['status'];
      $obj->save();

      $msg = trans('lang_data.record_successfully_saved_label');
      flashMessage('success',$msg);
      return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);

    }    

    /**
     * [storeFrontNewsLetter This function is used to save subscribed data of user]
     * @param  [type] $r [description]
     * @return [type]    [description]
     */
    public function storeFrontNewsLetter($r){

      $errors="";
      $input = $r->all();
      
      $token = GENERATE_TOKEN();
      $obj = new self;
      $obj->email = $input['email'];
      $obj->token = $token;
      $obj->status = self::STATUS_INACTIVE;
      $obj->save();

      if ($obj !=null) {

        $link  = route("front.news-letter.verify_front_news_letter",$obj->token);
        $data  = \App\Models\EmailTemplate::where('title','verify_front_news_letter')->first();
        $template = $data->description;
        $sender  = $data->from;
        
        
        $email_body = str_replace(array('###LINK###', '###SITE_URL###','###SITE_NAME###'), array($link,route('front.home'),trans('lang_data.app_name')), $template);
            
        if (env('IS_LIVE_DEMO_LOCAL') != 'local') {

          \Mail::send('emails.mail_template', ['email_body' => $email_body,'emailTemplate'=>$data], function ($message) use ($obj, $data) {
              $message->to($obj->email, "Subscriber")->subject($data->subject);
              $message->from($data->from,trans('lang_data.app_name'));
          });
        }
              
        $msg = trans('lang_data.thanks_you_for_subscribed_label');
        flashMessage('success',$msg);
        return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
        
      }

    }

    /**
     * [getNewsLetter To get newsletter details]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getNewsLetter($id)
    {
        $newsLetter=self::findOrfail($id);
        return $newsLetter;
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
            $msg = trans('lang_data.record_successfully_deleted_label');
        }
        return response()->json(['success' => 1, 'msg' => trans('lang_data.record_successfully_deleted_label') ]);
    }

    /**
     * [SingleStatusChange This function is used to active in active single status]
     * @param [type] $r [description]
     * @author Chirag G.
     */
    public function SingleStatusChange($r){

      $l = self::where('id',\Crypt::decrypt($r->id))->first();
      if ($l !=NULL) {
          
          if ($l->status == 1) {
            $l->status = self::STATUS_INACTIVE;
          }else{
            $l->status = self::STATUS_ACTIVE;
          }
          $l->save();
          return response()->json(['status' => $l->status]);
      }
    }  

    /**
     * [verifyFrontNewsLetter This function is used to verify user after subscribed newsletter]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function verifyFrontNewsLetter($id){

      if (isset($id) && $id !="") {
        
        $check = self::where('token',$id)->first();
        if ($check !=NULL) {

          $check->token = NULL;
          $check->save();

          $msg = "Your email address successfully verified.";
          $type ="success";

        }else{

          $msg = "Link is expire or sommething is wrong.!";
          $type ="error";

        }

      }else{

        $msg = "Link is expire or sommething is wrong.!";
        $type ="error";

      }

      flashMessage($type,$msg);
      return redirect()->route('front.home');
    
    }
}
