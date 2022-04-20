<?php
namespace Modules\Admin\Http\Controllers;

use App\Models\Acl;
use App\Models\MailCredential;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\MailCredentialRequest;

class MailCredentialController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_SETTINNG_MODULE, $this->user
            ) || $this->user->right_id  == 1)
            {
                return $next($request);
            }
            else
            {
                \Cache::flush();
                $succ_msg = trans('lang_data.you_do_not_have_access');
                flashMessage('error',$succ_msg);
                return redirect()->route('admin.logout');
            }
        
        });
        $this->objModel = new MailCredential;
    }
    /**
     * Display a setting page with data.
     * @return \Illuminate\Http\Response
     * @author Chiag G.
     */
    public function index()
    {   
        $title = trans('lang_data.mail_credential_label');
        $id = \Crypt::encrypt('1');
        $mailcredential=$this->objModel->getMailCredential(\Crypt::decrypt($id));
        $encryptedId = $id;
      
        return view('admin::mail_credential.addedit',compact("mailcredential","encryptedId","title"));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     * @author Chiag G.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chiag G.
     */
    public function store(Request $request)
    {
        

    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chiag G.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chiag G.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chiag G.
     */
    public function update(MailCredentialRequest $request, $id)
    {
        return $this->objModel->saveMailCredential($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

    }
}
