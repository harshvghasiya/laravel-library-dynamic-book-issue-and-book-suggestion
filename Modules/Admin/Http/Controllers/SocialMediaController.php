<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\SocialMediaRequest;
use Crypt;
use App\Models\SocialMedia;
use App\Models\Acl;

class SocialMediaController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_SOCIAL_MEDIA_MODULE, $this->user
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
        
        $this->objModel = new SocialMedia;
    } 
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('lang_data.social_media_list');
        return view('admin::social_media.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $image ="";
        $title = trans('lang_data.add_social_media');
        return view('admin::social_media.addedit',compact('image','title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialMediaRequest $request)
    {
        $request->validate([
            'title' => 'required',  
            'url' => 'required',  
        ]);
        return $this->objModel->saveSocialMedia($request);
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
        $socialMedia=$this->objModel->getSocialMedia(Crypt::decrypt($id));
        $encryptedId=$id;
        $image =$socialMedia->image;
        $title = trans('lang_data.edit_social_media');
        return view('admin::social_media.addedit',compact("socialMedia","encryptedId","image","title"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialMediaRequest $request, $id)
    {
        //
        return $this->objModel->saveSocialMedia($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $request['checkbox']=[$id];
        return $this->objModel->deleteAll($request);
    }

     /**
     * [anyData This function is used to get data of acl]
     * @param  Request $r [description]
     * @return [type]     [description]
     * @author Chirag Ghevariya.
     */
    public function anyData(Request $r)
    {
        return $this->objModel->getSocialMediaListData($r);
     
    }
    /**
     * [deleteAll This function is used to delete specific seleted data]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag Ghevariya.
     */
    public function deleteAll(Request $request){
        
        return $this->objModel->deleteAll($request);
    }
    
     /**
     * [SingleStatusChange This function is used for active inactive single record of acl module.]
     * @param Request $request [description]
     * @author Chirag Ghevariya.
     */
    public function SingleStatusChange(Request $request){
        
        return $this->objModel->SingleStatusChange($request);
    }

    /**
     * [statusAll This function is used to active or inactive specific selected acl record]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag Ghevariya.
     */
    public function statusAll(Request $request){
        return $this->objModel->statusAll($request);
    }
}
