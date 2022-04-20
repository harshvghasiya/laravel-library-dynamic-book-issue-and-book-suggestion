<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Tag;
use App\Models\Acl;
use Modules\Admin\Http\Requests\TagRequest;

class TagController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_TAG_MODULE, $this->user
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
        
        $this->objModel = new Tag;
    } 

    /**
     * [index This function is used to display listing of Tag]
     * @return [type] [description]
     * @author Chirag G.
     */
    public function index()
    {
        $title = trans('lang_data.tag_listing');
        return view('admin::tag.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource of tag.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function create()
    {
        $image="";
        $title = trans('lang_data.add_tag');
        return view('admin::tag.addedit',compact('image','title'));
    }

    /**
     * Store a newly created resource in databse for Tag.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function store(TagRequest $request)
    {
        return $this->objModel->saveTag($request);
    }

    /**
     * Display the specified resource of Tag.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource of Tag.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function edit($id)
    {
        $title = trans('lang_data.edit_tag');
        $tag=$this->objModel->getTag(Crypt::decrypt($id));
        $encryptedId=$id;
        return view('admin::tag.addedit',compact("tag","encryptedId","title"));
    }

    /**
     * Update the specified resource in database for Tag.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function update(TagRequest $request, $id)
    {
        return $this->objModel->saveTag($request,$id);
    }

    /**
     * Remove the specified resource from Tag from database.
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
     * [anyData This function is used to get data of Tag]
     * @param  Request $r [description]
     * @return [type]     [description]
     * @author Chirag G.
     */
    public function anyData(Request $r)
    {
        return $this->objModel->getTagListData($r);
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
     * [statusAll This function is used to active or inactive specific selected Tag record]
     * @param  Request $request [description]
     * @return [type]           [description]
     * @author Chirag G.
     */
    public function statusAll(Request $request){
        
        return $this->objModel->statusAll($request);
    }

    /**
     * [SingleStatusChange This function is active inactive single record of Tag.]
     * @param Request $request [description]
     * @author Chirag G.
     */
    public function SingleStatusChange(Request $request){

        return $this->objModel->SingleStatusChange($request);
    }
}
