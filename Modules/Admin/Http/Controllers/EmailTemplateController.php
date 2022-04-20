<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\EmailTemplateRequest;
use Crypt;
use Cookie;
use App\Models\EmailTemplate;
use App\Models\Acl;

class EmailTemplateController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_EMAIL_TEMPLATE_MODULE, $this->user
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
        $this->objModel = new EmailTemplate;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function index()
    {
        $title = trans('lang_data.email_template_list_label');
        return view('admin::email_template.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function create()
    {
        $title = trans('lang_data.add_email_template_label');
        return view('admin::email_template.addedit',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function store(EmailTemplateRequest $request)
    {
        $request->validate([
            'title' => 'required|max:40',  
            'from' => 'required|max:40',  
            'subject' => 'required|max:40',  
            'description' => 'required',  
        ]);
        return $this->objModel->saveEmailTemplate($request);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function edit($id)
    {
        $emailTemplate=$this->objModel->getEmailTemplat(Crypt::decrypt($id));
        $encryptedId=$id;
        $title = trans('lang_data.edit_email_template_label');
        return view('admin::email_template.addedit',compact("emailTemplate","encryptedId","title"));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function update(Request $request, $id)
    {
        return $this->objModel->saveEmailTemplate($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function destroy(Request $request,$id)
    {
        $request['checkbox']=[$id];
        return $this->objModel->deleteAll($request);
    }

    /**
     * [anyData This fucntion is used to get resource list]
     * @param  Request $r [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function anyData(Request $r)
    {
        return $this->objModel->getEmailTemplateListData($r);
    }

    /**
     * [deleteAll This resource is used to delete specific records]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag G.
     */
    public function deleteAll(Request $request){

        return $this->objModel->deleteAll($request);
    }

    /**
     * [SingleStatusChange This resource us used to active or inActive single resource]
     * @param Request $request [description]
     * @author Chirag G.
     */
    public function SingleStatusChange(Request $request){
        
        return $this->objModel->SingleStatusChange($request);
    }

    /**
     * [statusAll This resource is used to active inactive specific resource data]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag G.
     */
    public function statusAll(Request $request){

        return $this->objModel->statusAll($request);
    }

    /**
     * [preview For preview email template for sending mail]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function preview($id){

        $emailTemplate =$this->objModel->getEmailTemplat(Crypt::decrypt($id));
        $email_body = trim($emailTemplate->description);
        return view("emails.mail_template",compact('email_body'));                
    }
}
