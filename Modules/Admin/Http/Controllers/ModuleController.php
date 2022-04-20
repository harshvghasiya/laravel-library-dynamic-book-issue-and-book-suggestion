<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\ModuleRequest;
use Crypt;
use App\Models\Module;
use App\Models\Acl;

class ModuleController extends Controller
{
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_CMS_MODULE_MODULE, $this->user
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
        $this->objModel = new Module;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function index()
    {   
        $title = trans('lang_data.module_list_label');
        return view('admin::module.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function create()
    {   
        $title = trans('lang_data.add_module');
        return view('admin::module.addedit',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function store(ModuleRequest $request)
    {

        $request->validate([
                'name' => 'required',
        ]);
        return $this->objModel->saveModule($request);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module=$this->objModel->getModule(Crypt::decrypt($id));
        $encryptedId=$id;
        $title = trans('lang_data.edit_module');
        return view('admin::module.addedit',compact("module","encryptedId","title"));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function update(ModuleRequest $request, $id)
    {
        return $this->objModel->saveModule($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $request['checkbox']=[$id];
        return $this->objModel->deleteAll($request);
    }

    /**
     * [anyData This resource are used to get data]
     * @param  Request $r [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function anyData(Request $r)
    {
        return $this->objModel->getModuleListData($r);
    }

    /**
     * [deleteAll This resource are used to delete specific record]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag G.
     */
    public function deleteAll(Request $request){

        return $this->objModel->deleteAll($request);
    }

    /**
     * [statusAll This resource are used to active or in ACtive specific record]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag G.
     */
     public function statusAll(Request $request){

        return $this->objModel->statusAll($request);
    }

    /**
     * [SingleStatusChange This resource are used to actie in-active single resource data]
     * @param Request $request [description]
     * @author Chirag G.
     */
    public function SingleStatusChange(Request $request){
        
        return $this->objModel->SingleStatusChange($request);
    }
}
