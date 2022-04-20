<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Crypt;

class Setting extends Model
{
    protected $table="settings";
    const STATUS_ACTIVE ='1';
    const STATUS_INACTIVE ='0';

    /**
     * [saveSetting This resource are used to update data]
     * @param  [type] $r  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     * @author Chiag G.
     */
    public function saveSetting($r,$id=NULL){

    	$errors="";
    	$input = $r->all();
    	if ($id !== NULL)
      {
          $id=Crypt::decrypt($id);
    			$obj = self::find($id);
    	}
      else
      {
  	       $obj = new self;
      }
      /////////////////////// START LOGO//////////////////////
       if (isset($input['delete_logo_image']) && $input['delete_logo_image'] == 1) {
            
          if ($obj->logo_image !=null) {

              if(file_exists(SITE_LOGO_IMAGE_UPLOAD_PATH().$obj->logo_image))
              {
                  \File::delete(SITE_LOGO_IMAGE_UPLOAD_PATH().$obj->logo_image);
                  $obj->logo_image = NULL;
              }else{
                $obj->logo_image = NULL;
              }
          }
      }

      if (isset($input['logo_image']) && !empty($input['logo_image'])) {

            $imageName = UPLOAD_FILE($r,'logo_image',SITE_LOGO_IMAGE_UPLOAD_PATH());
            if ($imageName !="") {

              $obj->logo_image = $imageName;
            }
      }

      ///////////////////// END LOGO ///////////////

      if (isset($input['delete_author_image']) && $input['delete_author_image'] == 1) {
            
          if ($obj->author_image !=null) {

              if(file_exists(SITE_AUTHOR_IMAGE_UPLOAD_PATH().$obj->author_image))
              {
                  \File::delete(SITE_AUTHOR_IMAGE_UPLOAD_PATH().$obj->author_image);
                  $obj->author_image = NULL;
              }else{
                $obj->author_image = NULL;
              }
          }
      }

      if (isset($input['author_image']) && !empty($input['author_image'])) {

          $imageName = UPLOAD_FILE($r,'author_image',SITE_AUTHOR_IMAGE_UPLOAD_PATH());
          if ($imageName !="") {

            $obj->author_image = $imageName;
          }
      }
      //////////AUTOR END /////////////

      if (isset($input['delete_email_image']) && $input['delete_email_image'] == 1) {
            
          if ($obj->email_image !=null) {

              if(file_exists(EMAIL_LOGO_IMAGE_UPLOAD_PATH().$obj->email_image))
              {
                  \File::delete(EMAIL_LOGO_IMAGE_UPLOAD_PATH().$obj->email_image);
                  $obj->email_image = NULL;
              }else{
                $obj->email_image = NULL;
              }
          }
      }

      if (isset($input['email_image']) && !empty($input['email_image'])) {

          $imageName = UPLOAD_FILE($r,'email_image',EMAIL_LOGO_IMAGE_UPLOAD_PATH());
          if ($imageName !="") {

            $obj->email_image = $imageName;
          }
      }
      ///////END EMAIL IMAGE //////////////

      if (isset($input['delete_favicon_image']) && $input['delete_favicon_image'] == 1) {
            
          if ($obj->favicon_image !=null) {

              if(file_exists(FAVICON_LOGO_IMAGE_UPLOAD_PATH().$obj->favicon_image))
              {
                  \File::delete(FAVICON_LOGO_IMAGE_UPLOAD_PATH().$obj->favicon_image);
                  $obj->favicon_image = NULL;
              }else{
                $obj->favicon_image = NULL;
              }
          }
      }

      if (isset($input['favicon_image']) && !empty($input['favicon_image'])) {

          $imageName = UPLOAD_FILE($r,'favicon_image',FAVICON_LOGO_IMAGE_UPLOAD_PATH());
          if ($imageName !="") {

            $obj->favicon_image = $imageName;
          }
      }
      /////////END FAVICON IMAGE

      if (isset($input['delete_home_page_banner_image']) && $input['delete_home_page_banner_image'] == 1) {
            
          if ($obj->home_page_banner_image !=null) {

              if(file_exists(HOME_PAGE_BANNER_LOGO_IMAGE_UPLOAD_PATH().$obj->home_page_banner_image))
              {
                  \File::delete(HOME_PAGE_BANNER_LOGO_IMAGE_UPLOAD_PATH().$obj->home_page_banner_image);
                  $obj->home_page_banner_image = NULL;
              }else{
                $obj->home_page_banner_image = NULL;
              }
          }
      }
      
      if (isset($input['home_page_banner_image']) && !empty($input['home_page_banner_image'])) {

          $imageName = UPLOAD_FILE($r,'home_page_banner_image',HOME_PAGE_BANNER_LOGO_IMAGE_UPLOAD_PATH());
          if ($imageName !="") {

            $obj->home_page_banner_image = $imageName;
          }
      }

      $obj->site_url= $input['site_url'];
      $obj->email= $input['email'];
      $obj->second_email= $input['second_email'];
      $obj->address= $input['address'];
      $obj->second_address= $input['second_address'];
      $obj->mobile= $input['mobile'];
      $obj->address_latitude=$input['address_latitude'];
      $obj->address_longitude=$input['address_longitude'];
      $obj->map_address=$input['map_address'];
      $obj->second_mobile= $input['second_mobile'];
      $obj->author_name=  isset($input['author_name']) ? $input['author_name'] : NULL;
      $obj->author_description_one =  isset($input['author_description_one']) ? $input['author_description_one'] : NULL;
      $obj->author_description_two =  isset($input['author_description_two']) ? $input['author_description_two'] : NULL;
      $obj->save();

      $msg = trans('lang_data.setting_save_message_label');
      flashMessage('success',$msg);

      return response()->json(['success' => true,'msg'=>$msg, 'status'=>1,'errors' => $errors]);
      
  }

  /**
   * [getSetting This resource are used to get data]
   * @param  [type] $id [description]
   * @return [type]     [description]
   * @author Chiag G.
   */
  public function getSetting($id)
  {
      $setting=self::findOrfail($id);
      return $setting;
  }

  /**
   * [getSettingLogoImageUrl This resource are used to get image url logo]
   * @return [type] [description]
   * @author Chiag G.
   */
  public function getSettingLogoImageUrl(){

      $imageUrl_u=NO_IMAGE_URL().'/'.'no_image.png';
      $imagePath=SITE_LOGO_IMAGE_UPLOAD_PATH().$this->logo_image;
      $imageUrl=SITE_LOGO_IMAGE_UPLOAD_URL().$this->logo_image;
      if (isset($this->logo_image) && !empty($this->logo_image) && file_exists($imagePath) ) {
          return $imageUrl;
      }else{
          $imageUrl=$imageUrl_u;
      }
      return $imageUrl;
  }

  /**
   * [getsettineBannerImg This resource are used to get image url of banner]
   * @return [type] [description]
   * @author Chiag G.
   */
  public function getsettineBannerImg(){

      $imageUrl_u=NO_IMAGE_URL().'/'.'no_image.png';
      $imagePath=HOME_PAGE_BANNER_LOGO_IMAGE_UPLOAD_PATH().'/'.$this->home_page_banner_image;
      $imageUrl=HOME_PAGE_BANNER_LOGO_IMAGE_UPLOAD_URL().'/'.$this->home_page_banner_image;
      if (isset($this->home_page_banner_image) && !empty($this->home_page_banner_image) && file_exists($imagePath) ) {
          return $imageUrl;
      }else{
          $imageUrl=$imageUrl_u;
      }
      return $imageUrl;
  }

  /**
   * [getSettingLogoFrontImageUrl This resource are used to get image url of logo]
   * @return [type] [description]
   * @author Chiag G.
   */
  public static function getSettingLogoFrontImageUrl($field){

      $imageUrl_u=NO_IMAGE_URL().'/'.'no_image.png';
      $imagePath=SITE_LOGO_IMAGE_UPLOAD_PATH().'/'.$field;
      $imageUrl=SITE_LOGO_IMAGE_UPLOAD_URL().'/'.$field;
      if (isset($field) && !empty($field) && file_exists($imagePath) ) {
          return $imageUrl;
      }else{
          $imageUrl=$imageUrl_u;
      }
      return $imageUrl;
  }  

  /**
   * [getSettingAuthorFrontImageUrl This resource are used to get image url author]
   * @return [type] [description]
   * @author Chiag G.
   */
  public static function getSettingAuthorFrontImageUrl($field){

      $imageUrl_u=NO_IMAGE_URL().'/'.'no_image.png';
      $imagePath=SITE_AUTHOR_IMAGE_UPLOAD_PATH().'/'.$field;
      $imageUrl=SITE_AUTHOR_IMAGE_UPLOAD_URL().'/'.$field;
      if (isset($field) && !empty($field) && file_exists($imagePath) ) {
          return $imageUrl;
      }else{
          $imageUrl=$imageUrl_u;
      }
      return $imageUrl;
  }

  /**
   * [getsettineAuthorImgDynamic This resource are used to get image url of author]
   * @return [type] [description]
   * @author Chiag G.
   */
  public function getsettineAuthorImgDynamic(){

      $imageUrl_u=NO_IMAGE_URL().'no_image.png';
      $imagePath=SITE_AUTHOR_IMAGE_UPLOAD_PATH().$this->author_image;
      $imageUrl=SITE_AUTHOR_IMAGE_UPLOAD_URL().$this->author_image;
      if (isset($this->author_image) && !empty($this->author_image) && file_exists($imagePath) ) {
          return $imageUrl;
      }else{
          $imageUrl=$imageUrl_u;
      }
      return $imageUrl;
  }

  /**
   * [getsettineFaviconImgDynamic This resource are used to get image url of favicon]
   * @return [type] [description]
   * @author Chiag G.
   */
  public function getsettineFaviconImgDynamic(){

      $imageUrl_u=NO_IMAGE_URL().'no_image.png';
      $imagePath=FAVICON_LOGO_IMAGE_UPLOAD_PATH().$this->favicon_image;
      $imageUrl=FAVICON_LOGO_IMAGE_UPLOAD_URL().$this->favicon_image;
      if (isset($this->favicon_image) && !empty($this->favicon_image) && file_exists($imagePath) ) {
          return $imageUrl;
      }else{
          $imageUrl=$imageUrl_u;
      }
      return $imageUrl;
  }

  /**
   * [getsettineEmailImgDynamic This resource are used to get image url of email logo]
   * @return [type] [description]
   * @author Chiag G.
   */
  public function getsettineEmailImgDynamic(){

      $imageUrl_u=NO_IMAGE_URL().'no_image.png';
      $imagePath=EMAIL_LOGO_IMAGE_UPLOAD_PATH().$this->email_image;
      $imageUrl=EMAIL_LOGO_IMAGE_UPLOAD_URL().$this->email_image;
      if (isset($this->email_image) && !empty($this->email_image) && file_exists($imagePath) ) {
          return $imageUrl;
      }else{
          $imageUrl=$imageUrl_u;
      }
      return $imageUrl;
  }

  /**
   * [ApiGetSettingData This resource are used to get data for API]
   * @author Chirag G.
   */
  public static function ApiGetSettingData(){

    $data = GET_SETTINNG_DATA();
    if ($data !=null) {
        $data->email_image = $data->getsettineEmailImgDynamic();
        $data->favicon_image = $data->getsettineFaviconImgDynamic();
        $data->author_image = $data->getsettineAuthorImgDynamic();
        return response()->json(['status' => 200,'msg'=>trans('lang_data.data_successfully_retrived_label'),'data' => $data ]);exit;
    }else{

       return response()->json(['status' => 204,'msg'=>trans('lang_data.there_is_no_data_found_label'),'data' => (object)[] ]);exit;
    }
  }
  
}
