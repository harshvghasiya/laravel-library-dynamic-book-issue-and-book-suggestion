<?php
namespace App\Validator;
use Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;
class CustomeValidator extends Validator
{
	/**
	 * [validateCheckLabelTitle This will check title for language data]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validateCheckLabelTitle($attribute, $value, $parameters)
	{	
		$data = \Lang::get('lang_data');
		if(!empty($value) && array_key_exists($value,$data))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * [validateCheckEmailNewsLetter To check subcribed user for already exit or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validateCheckEmailNewsLetter($attribute, $value, $parameters)
	{	

		if (isset($value) && $value !=null) {
			
			$checkEmail = \App\Models\NewsLetter::where('email',$value)->first();

			if ($checkEmail == null) {
				
				return true;

			}else{

				return false;
			}

		}
	}

	public function validatecheckMenuExit($attribute, $value, $parameters)
	{	

		if (isset($value) && $value !=null) {
			
				
			
			$checkEmail = \App\Models\Menu::where('cms_id',Crypt::decrypt($value))->first();

			if ($checkEmail == null) {
				
				return true;

			}else{

				return false;
			}
			
		}
	}

	/**
	 * [validatecheckEmailExitAdminUser To check user email exit or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckEmailExitAdminUser($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0])) {

            $count = \App\Models\User::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("email", $value)
                ->count();

        } else {

            $count = \App\Models\User::where("email", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}

	/**
	 * [validatecheckRightExit To check right name is exit or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckRightExit($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0])) {

			$count = \App\Models\Right::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("name", $value)
                ->count();

        } else {

            $count = \App\Models\Right::where("name", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}	

	/**
	 * [validatecheckAclNameExit To check acm module name exit or not]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckAclNameExit($attribute, $value, $parameters)
	{	

		if (isset($parameters[0]) && !empty($parameters[0])) {

            $count = \App\Models\Acl::where("id", "!=", \Crypt::decrypt($parameters[0]))
                ->where("title", $value)
                ->count();

        } else {

            $count = \App\Models\Acl::where("title", $value)->count();
        }

        if ($count === 0) {

            return true;

        } else {

            return false;
        }
	}	

	/**
	 * [validatecheckEmailExitForgotPassword This will check email is exit during forgot password time]
	 * @param  [type] $attribute  [description]
	 * @param  [type] $value      [description]
	 * @param  [type] $parameters [description]
	 * @return [type]             [description]
	 */
	public function validatecheckEmailExitForgotPassword($attribute, $value, $parameters)
	{	
		
		$count = \App\Models\User::where("email", $value)->count();
        
		if ($count === 0) {

            return false;

        } else {

            return true;
        }
	}
	
}
?>