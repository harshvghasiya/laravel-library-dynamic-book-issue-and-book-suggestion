<?php

namespace App\Models;

use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class MailCredential extends Model
{
    protected $table="mail_credentials";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [saveSetting This resource are used to update data]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chiag G.
     */
    public function saveMailCredential($r,$id=NULL){
      $errors="";
      $input = $r->all();
      if ($id !== NULL)
      {
          $id=Crypt::decrypt($id);
          $obj = self::find($id);
      }
      else
      {
        $obj = new self;
      }

      
      
      $obj->mail_username= $input['mail_username'];
      $obj->mail_from_name= $input['mail_from_name'];
      $obj->mail_from_address= $input['mail_from_address'];
      $obj->mail_driver= $input['mail_driver'];
      $obj->mail_port= $input['mail_port'];
      $obj->mail_host= $input['mail_host'];
      $obj->mail_encryption= $input['mail_encryption'];
      $obj->status=$input['status'];
      
      try {
        $decrypted = decrypt($input['mail_password']);
      } catch (DecryptException $e) {
        $r->validate([
            'mail_password' => 'max:25',    
        ]);
        $obj->mail_password=$input['mail_password'];
      }

      $obj->save();

      $msg = trans('lang_data.mail_credential_save_message_label');
      flashMessage('success',$msg);
      

      return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
      
  }

  /**
   * [getSetting This resource are used to get data]
   * @param  [type] $id [description]
   * @return [type]     [description]
   * @author Chiag G.
   */
  public function getMailCredential($id)
  {
      $mailcredential=self::findOrfail($id);
      return $mailcredential;
  }

  
}
