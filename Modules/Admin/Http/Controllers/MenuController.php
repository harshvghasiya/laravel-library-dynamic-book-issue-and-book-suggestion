<?php
namespace Modules\Admin\Http\Controllers;

use App\Models\Acl;
use App\Models\Menu;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\CmsRequest;
use Modules\Admin\Http\Requests\MenuRequest;

class MenuController extends Controller
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
        
        $this->objModel = new Menu;
    } 
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $title =trans('lang_data.menu_list_label');
        return view('admin::menu.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $image="";
        $title =trans('lang_data.add_menu_label');
        return view('admin::menu.addedit',compact("image","title"));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        return $this->objModel->saveMenu($request);
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

    public function menuitemStore(Request $request)
    {
        return $this->objModel->saveMenuItem($request);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function sortedData(Request $request)
    {
        return $this->objModel->sortedData($request);
    }

    public function removeMenu(Request $request)
    {
        return $this->objModel->removeMenu($request);
    }

    public function menuitemUpdate(CmsRequest $request)
    {
        return $this->objModel->menuitemUpdate($request);
    }

    public function menuStrucutreData(Request $request)
    {
        return view('admin::menu.menustrucutre');
    }

    public function menuitemEdit(Request $request)
    {
        return $this->objModel->menuitemEdit($request);
    }
}
