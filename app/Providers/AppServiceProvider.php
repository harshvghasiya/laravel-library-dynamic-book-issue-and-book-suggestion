<?php

namespace App\Providers;

use App\Validator\CustomeValidator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
         $socialMediaContent = GET_SOCIAL_MEDIA_DATA();
        $cmsPages = GET_CMS_PAGE();
        $headerSectionLink = getCmsFooterAndTopSection(\App\Models\Module::CONST_DISPLAY_ON_HEADER);
        $menuLinks=getMenuLink();
        $getChildSectionLink=getChildSectionLink(8,\App\Models\Module::CONST_DISPLAY_ON_HEADER);

        $footerSectionLink = getCmsFooterAndTopSection(\App\Models\Module::CONST_QUICK_LINK); 
        $settingData = GET_SETTINNG_DATA();
        $mailcredential=getMailCredential();
        $categoryFooter = GET_FOOTER_CATEGORY();
        $portfolio=GET_RECENT_WORK_PORTFOLIO();
        $ourService = getCmsMultipleData(\App\Models\Cms::CONST_SERVICE_PAGE);                            

        view()->share(['socialMediaContent'=>$socialMediaContent,'cmsPages'=>$cmsPages,'settingData'=>$settingData,'setting'=>$settingData,'categoryFooter'=>$categoryFooter,
          'headerSectionLink'=>$headerSectionLink,'ourService'=>$ourService,'footerSectionLink'=>$footerSectionLink,'portfolio'=>$portfolio,'getChildSectionLink'=>$getChildSectionLink,'menuLinks'=>$menuLinks]);

        $this->app->validator->resolver(function($translator, $data, $rules, $messages) {
            return new CustomeValidator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
