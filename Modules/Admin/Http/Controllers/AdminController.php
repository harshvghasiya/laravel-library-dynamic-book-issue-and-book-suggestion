<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Right;

class AdminController extends Controller
{   
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct(){

        $this->objModel = new User;
        $this->objModelRight = new Right;
    } 
    /**
     * This function is used to get login page.
     * @return Response
     */
    public function index()
    {
        $title ="Login";
        return redirect()->route('admin.login.main',compact("title"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * This function is used to update user profile
       @author Chirag Ghevariya
     */
    public function editUserProfile($id){

        $title = trans('lang_data.edit_admin_user');
        $adminUser=$this->objModel->getAdminUser(\Crypt::decrypt($id));
        $encryptedId=$id;
        $rightList = $this->objModelRight->getRightDown();
        return view('admin::admin_user.edit_user_profile',compact("adminUser","encryptedId","title","rightList"));        
    }
}
