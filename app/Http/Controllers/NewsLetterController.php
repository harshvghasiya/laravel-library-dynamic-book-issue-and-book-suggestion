<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsLetter;
use App\Http\Requests\FrontNewsLetterRequest;

class NewsLetterController extends Controller
{

    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct()
    {
         $this->objModel = new NewsLetter;
    }

    /**
     * [storeFrontNewsLetter This function will store subscribed user data]
     * @param  FrontNewsLetterRequest $request [description]
     * @return [type]                          [description]
     */
    public function storeFrontNewsLetter(FrontNewsLetterRequest $request)
    {   
        return $this->objModel->storeFrontNewsLetter($request);
    }    

    /**
     * [verifyFrontNewsLetter This function is used to verify subscribed user detail]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function verifyFrontNewsLetter($id)
    {   
        return $this->objModel->verifyFrontNewsLetter($id);
    }

}
