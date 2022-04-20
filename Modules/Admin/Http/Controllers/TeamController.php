<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Team;
use App\Models\Acl;
use Modules\Admin\Http\Requests\TeamRequest;

class TeamController extends Controller
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
        
        $this->objModel = new Team;
    } 

    /**
     * [index This function is used to display listing of banner]
     * @return [type] [description]
     * @author Chirag G.
     */
    public function index()
    {
        $title = trans('lang_data.team_listing_label');
        return view('admin::team.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource of Team.
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function create()
    {
        $image="";
        $title = trans('lang_data.add_team');

        return view('admin::team.addedit',compact('image','title'));
    }

    /**
     * Store a newly created resource in databse for Team.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function store(TeamRequest $request)
    {
        
        return $this->objModel->saveTeam($request);
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
        $title = trans('lang_data.edit_team');
        $team=$this->objModel->getTeam(Crypt::decrypt($id));
        $encryptedId=$id;
        $image=$team->image;
        return view('admin::team.addedit',compact("team","encryptedId","image","title"));
    }

    /**
     * Update the specified resource in database for banner.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Chirag G.
     */
    public function update(TeamRequest $request, $id)
    {
        return $this->objModel->saveTeam($request,$id);
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
        return $this->objModel->getTeamListData($r);
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
