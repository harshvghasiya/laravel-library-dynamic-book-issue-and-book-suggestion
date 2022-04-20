<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Banner;
use App\Models\Acl;
use Modules\Admin\Http\Requests\BannerRequest;

class BannerController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_BANNER_MODULE, $this->user
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
        
        $this->objModel = new Banner;
    } 

    /**
     * [index This function is used to display listing of banner]
     * @return [type] [description]
     * @author Chirag G.
     */
    public function index()
    {
        $title = trans('lang_data.banner_listing_label');
        return view('admin::banner.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource of Banner.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function create()
    {
        $image="";
        $title = trans('lang_data.add_banner');

        return view('admin::banner.addedit',compact('image','title'));
    }

    /**
     * Store a newly created resource in databse for banner.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function store(BannerRequest $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:20',  
            'url' => 'required',  
        ]);
        return $this->objModel->saveBanner($request);
    }

    /**
     * Display the specified resource of banner.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource of banner.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function edit($id)
    {
        $title = trans('lang_data.edit_banner');
        $banner=$this->objModel->getBanner(Crypt::decrypt($id));
        $encryptedId=$id;
        $image=$banner->image;
        return view('admin::banner.addedit',compact("banner","encryptedId","image","title"));
    }

    /**
     * Update the specified resource in database for banner.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function update(BannerRequest $request, $id)
    {
        return $this->objModel->saveBanner($request,$id);
    }

    /**
     * Remove the specified resource from banner from database.
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
     * [anyData This function is used to get data of banner]
     * @param  Request $r [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function anyData(Request $r)
    {
        return $this->objModel->getBannerListData($r);
    }

    /**
     * [deleteAll This function is used to delete specific seletec data]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag G.
     */
    public function deleteAll(Request $request){
        
        return $this->objModel->deleteAll($request);
    }

    /**
     * [statusAll This function is used to active or inactive specific selected banner record]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag G.
     */
    public function statusAll(Request $request){
        
        return $this->objModel->statusAll($request);
    }

    /**
     * [SingleStatusChange This function is active inactive single record of banner.]
     * @param Request $request [description]
     * @author Chirag G.
     */
    public function SingleStatusChange(Request $request){

        return $this->objModel->SingleStatusChange($request);
    }

    public function popupForm(){

        return view('admin::banner._create')->render();
    }
}
