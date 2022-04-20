<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\User;
use App\Models\Right;
use App\Models\Acl;
use Modules\Admin\Http\Requests\AdminUserRequest;

class AdminUserController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_ADMIN_USER_MODULE, $this->user
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
        
        },["except"=>['post',"update","patch"]]);
        
        $this->objModel = new User;
        $this->objModelRight = new Right;
    } 

    /**
     * [index This function is used to display listing of Admin User]
     * @return [type] [description]
     * @author Chirag G.
     */
    public function index()
    {
        $title = trans('lang_data.admin_user_listing');
        return view('admin::admin_user.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource of Admin User.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function create()
    {
        $image="";
        $title = trans('lang_data.add_admin_user');
        $rightList = $this->objModelRight->getRightDown();
        return view('admin::admin_user.addedit',compact('image','title','rightList'));
    }

    /**
     * Store a newly created resource in databse for Admin User.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function store(AdminUserRequest $request)
    {
        return $this->objModel->saveAdminUser($request);
    }

    /**
     * Display the specified resource of Admin User.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource of Admin User.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function edit($id)
    {
        $title = trans('lang_data.edit_admin_user');
        $adminUser=$this->objModel->getAdminUser(Crypt::decrypt($id));
        $encryptedId=$id;
        $rightList = $this->objModelRight->getRightDown();
        return view('admin::admin_user.addedit',compact("adminUser","encryptedId","title","rightList"));
    }

    /**
     * Update the specified resource in database for Admin User.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function update(AdminUserRequest $request, $id)
    {
        return $this->objModel->saveAdminUser($request,$id);
    }

    /**
     * Remove the specified resource from Admin User from database.
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
     * [anyData This function is used to get data of Admin User]
     * @param  Request $r [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function anyData(Request $r)
    {
        return $this->objModel->getAdminUserListData($r);
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
     * [statusAll This function is used to active or inactive specific selected Admin User record]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag G.
     */
    public function statusAll(Request $request){
        
        return $this->objModel->statusAll($request);
    }

    /**
     * [SingleStatusChange This function is active inactive single record of Admin User.]
     * @param Request $request [description]
     * @author Chirag G.
     */
    public function SingleStatusChange(Request $request){

        return $this->objModel->SingleStatusChange($request);
    }
}
