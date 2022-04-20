<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactus;
use App\Http\Requests\ContactUsRequest;

class ContactUsController extends Controller
{
    /**
     * [__construct This function is used to create and initialzation class object]
     */
    public function __construct()
    {
         $this->objModel = new Contactus;
    }

    /**
     * [storeFrontContactUs This function is used to store contact us data]
     * @param  ContactUsRequest $request [description]
     * @return [type]                    [description]
     * @author Chirag Ghevariya
     */
    public function storeFrontContactUs(ContactUsRequest $request)
    {   
        return $this->objModel->storeFrontContactUs($request);
    }

}
