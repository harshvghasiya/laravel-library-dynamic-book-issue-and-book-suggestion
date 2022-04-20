<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\NewsLetter;
use App\Models\Acl;

class NewsLetterController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            if (CHECK_RIGHTS_TO_ACCESS_DENIED(Acl::CONST_NEWSLETTER_MODULE, $this->user
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
        $this->objModel = new NewsLetter;
    } 

    /**
     * [index This function is used to display listing of acl]
     * @return [type] [description]
     * @author Chirag Ghevariya.
     */
    public function index()
    {   
        $title = trans('lang_data.news_letter_label');
        return view('admin::news_letter.index',compact('title'));
    }

     /**
     * Show the form for creating a new resource of acl.
     * @return \Illuminate\Http\Response
     * @author Chirag Ghevariya.
     */
    public function create()
    {   
        $title = trans('lang_data.add_newsletter_label');
        return view('admin::news_letter.addedit',compact('title'));
    }

    /**
     * Store a newly created resource in databse for acl.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chirag Ghevariya.
     */
    public function store(Request $request)
    {
        return $this->objModel->saveNewsLetter($request);
    }

    /**
     * Display the specified resource of acl.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource of acl.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag Ghevariya.
     */
    public function edit($id)
    {
        $newsLetter = $this->objModel->getNewsLetter(Crypt::decrypt($id));
        $encryptedId= $id;
        $title = trans('lang_data.edit_newsletter_label');
        return view('admin::news_letter.addedit',compact("newsLetter","encryptedId","title"));
    }

     /**
     * Update the specified resource in database for acl.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag Ghevariya.
     */
    public function update(Request $request, $id)
    {
        return $this->objModel->saveNewsLetter($request,$id);
    }

    /**
     * Remove the specified resource from from database.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag Ghevariya.
     */
    public function destroy(Request $request,$id)
    {
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
        return $this->objModel->getNewsLetterListData($r);
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
