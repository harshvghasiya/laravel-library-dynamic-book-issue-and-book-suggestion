<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\SettingRequest;
use Crypt;
use App\Models\Setting;
use App\Models\Acl;

class SettingController extends Controller
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
        $this->objModel = new Setting;
    }
    /**
     * Display a setting page with data.
     * @return \Illuminate\Http\Response
     * @author Chiag G.
     */
    public function index()
    {   
        $title = trans('lang_data.setting_label');
        $id = \Crypt::encrypt('1');
        $setting=$this->objModel->getSetting(\Crypt::decrypt($id));
        $encryptedId = $id;
        if($setting->logo_image){
        $logo_image = $setting->logo_image;

        }else{
            $logo_image ='';
        } 

        if($setting->author_image){
            $author_image = $setting->author_image;

        }else{
            $author_image ='';
        }

        if($setting->favicon_image){
            $favicon_image = $setting->favicon_image;
        }else{
            $favicon_image ='';
        } 
        if($setting->email_image){
            $email_image = $setting->email_image;

        }else{
            $email_image ='';
        }
        if($setting->home_page_banner_image){
            $home_page_banner_image = $setting->home_page_banner_image;

        }else{
            $home_page_banner_image ='';
        }
      
        return view('admin::setting.setting',compact("setting","encryptedId","logo_image", "favicon_image", "email_image", "home_page_banner_image","author_image","title"));
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
    public function update(SettingRequest $request, $id)
    {
        return $this->objModel->saveSetting($request,$id);
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
