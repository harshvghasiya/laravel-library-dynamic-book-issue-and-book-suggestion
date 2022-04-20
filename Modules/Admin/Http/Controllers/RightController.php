<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Right;
use App\Models\Acl;
use Modules\Admin\Http\Requests\RightRequest;

class RightController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_RIGHT_MODULE, $this->user
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
        $this->objModel = new Right;
        $this->objModelAcl = new Acl;
    } 

    /**
     * [index This function is used to display listing of banner]
     * @return [type] [description]
     * @author Chirag G.
     */
    public function index()
    {
        $title = trans('lang_data.right_listing');
        return view('admin::right.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource of Banner.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function create()
    {
        $image="";
        $title = trans('lang_data.add_right');
        $aclModule = $this->objModelAcl->getAclModuleForRight();
        return view('admin::right.addedit',compact('title','aclModule'));
    }

    /**
     * Store a newly created resource in databse for banner.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function store(RightRequest $request)
    {
        return $this->objModel->saveRight($request);
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
        $title = trans('lang_data.edit_right');
        $right=$this->objModel->getRight(Crypt::decrypt($id));
        $encryptedId=$id;
        $aclModule = $this->objModelAcl->getAclModuleForRight();
        $rightModule=\App\Models\RightModule::where('right_id',\Crypt::decrypt($id))->get();
        return view('admin::right.addedit',compact("right","encryptedId","title","aclModule","rightModule"));
    }

    /**
     * Update the specified resource in database for banner.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function update(RightRequest $request, $id)
    {
        return $this->objModel->saveRight($request,$id);
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
        return $this->objModel->getRightListData($r);
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
}
