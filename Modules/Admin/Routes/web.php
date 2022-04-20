<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web'],'prefix' => ADMIN_PREFIX_KEYWORD()], function()
{

    Route::any('login', 'LoginController@login')->name('admin.login.main');
    Route::any('forgot-password', 'LoginController@forgotPassword')->name('admin.forgot_password');
    Route::any('reset-password/{id}', 'LoginController@resetPassword')->name('admin.reset_password');
    Route::any('update-password', 'LoginController@updatePassword')->name('admin.update_password');
    Route::any('x/login', 'LoginController@postLogin')->name('admin.login');
    
});

Route::group(['middleware' => ['web','admin_auth'], 'prefix' => ADMIN_PREFIX_KEYWORD(), 'as'=>'admin.'],function(){


    Route::any('/save_tinymce_image', 'PluginController@saveTinymceImage')->name("save_tinymce_image");
    Route::any("/upload_image", 'PluginController@upload_image')->name('upload_img');
    Route::any("/deleteUploadedImage", 'PluginController@deleteUploadedImage')->name('delete_upload_img');
    Route::any("/upload_cropped_image", 'PluginController@upload_cropped_image')->name('upload_img_crop');
    
    Route::get('/', 'AdminController@index');
    Route::get('/logout','LoginController@logout')->name('logout');
    Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');


    // EDIT USER PROFILE

    Route::any('user-profile/edit/{id}','AdminController@editUserProfile')->name('profile.edit_user_profile');

    // Banner Content ROUTES
    Route::any('banners/popup-form','BannerController@popupForm')->name('banners.popup_form');
    Route::any('banners/get','BannerController@anyData')->name('banners.any_data');
    Route::any('banners/single_status_change','BannerController@SingleStatusChange')->name('banners.single_status_change');
    Route::any('banners/delete-all','BannerController@deleteAll')->name('banners.delete_all');
    Route::any('banners/status-all','BannerController@statusAll')->name('banners.status_all');
    Route::resource('banners','BannerController');

     // Team Content ROUTES
    Route::any('teams/popup-form','TeamController@popupForm')->name('teams.popup_form');
    Route::any('teams/get','TeamController@anyData')->name('teams.any_data');
    Route::any('teams/single_status_change','TeamController@SingleStatusChange')->name('teams.single_status_change');
    Route::any('teams/delete-all','TeamController@deleteAll')->name('teams.delete_all');
    Route::any('teams/status-all','TeamController@statusAll')->name('teams.status_all');
    Route::resource('teams','TeamController');

    // SETTING ROUTES
    Route::resource('settings','SettingController');

    // MailCredential ROUTES
    Route::resource('mailcredential','MailCredentialController');

    // EMAIL TEMPLATE ROUTES
    Route::any('email-template/preview/{id}','EmailTemplateController@preview')->name('email-template.preview');
    Route::any('email-template/get','EmailTemplateController@anyData')->name('email-template.any_data');
    Route::any('email-template/single_status_change','EmailTemplateController@SingleStatusChange')->name('email-template.single_status_change');
    Route::any('email-template/delete-all','EmailTemplateController@deleteAll')->name('email-template.delete_all');
    Route::any('email-template/status-all','EmailTemplateController@statusAll')->name('email-template.status_all');
    Route::resource('email-template','EmailTemplateController');

    // Social Media ROUTES
    Route::any('social_medias/get','SocialMediaController@anyData')->name('social_medias.any_data');
    Route::any('social_medias/single_status_change','SocialMediaController@SingleStatusChange')->name('social_medias.single_status_change');
    Route::any('social_medias/delete-all','SocialMediaController@deleteAll')->name('social_medias.delete_all');
    Route::any('social_medias/status-all','SocialMediaController@statusAll')->name('social_medias.status_all');
    Route::resource('social_medias','SocialMediaController');

    // CONTACT US ROUTE
    Route::any('contactus/get','ContactusController@anyData')->name('contactus.any_data');
    Route::any('contactus/delete-all','ContactusController@deleteAll')->name('contactus.delete_all');
    Route::any('contactus/status-all','ContactusController@statusAll')->name('contactus.status_all');
     Route::any('contactus/single_status_change','ContactusController@SingleStatusChange')->name('contactus.single_status_change');
    Route::resource('contactus','ContactusController');

    // NEWSLETTER ROUTES
    Route::any('news-letter/get','NewsLetterController@anyData')->name('news-letter.any_data');
    Route::any('news-letter/delete-all','NewsLetterController@deleteAll')->name('news-letter.delete_all');
    Route::any('news-letter/status-all','NewsLetterController@statusAll')->name('news-letter.status_all');
    Route::any('news-letter/single_status_change','NewsLetterController@SingleStatusChange')->name('news-letter.single_status_change');
    Route::resource('news-letter','NewsLetterController');

    //CATEGORY ROUTES
    Route::any('category/get','CategoryController@anyData')->name('category.any_data');
     Route::any('category/single_status_change','CategoryController@SingleStatusChange')->name('category.single_status_change');
    Route::any('category/delete-all','CategoryController@deleteAll')->name('category.delete_all');
    Route::any('category/status-all','CategoryController@statusAll')->name('category.status_all');
    Route::resource('category','CategoryController');

    // BLOG ROUTES
    Route::any('blogs/get','BlogController@anyData')->name('blogs.any_data');
    Route::any('blogs/delete-all','BlogController@deleteAll')->name('blogs.delete_all');
    Route::any('blogs/status-all','BlogController@statusAll')->name('blogs.status_all');
    Route::any('blogs/single_status_change','BlogController@SingleStatusChange')->name('blogs.single_status_change');
    Route::resource('blogs','BlogController');

    // MODULE ROUTES
    Route::any('modules/get','ModuleController@anyData')->name('modules.any_data');
    Route::any('modules/delete-all','ModuleController@deleteAll')->name('modules.delete_all');
    Route::any('modules/status-all','ModuleController@statusAll')->name('modules.status_all');
    Route::any('modules/single_status_change','ModuleController@SingleStatusChange')->name('modules.single_status_change');
    Route::resource('modules','ModuleController');

    // CMS ROUTES
    Route::any('cms/get','CmsController@anyData')->name('cms.any_data');
    Route::any('cms/delete-all','CmsController@deleteAll')->name('cms.delete_all');
    Route::any('cms/status-all','CmsController@statusAll')->name('cms.status_all');
    Route::any('cms/single_status_change','CmsController@SingleStatusChange')->name('cms.single_status_change');
    Route::resource('cms','CmsController');

    // ACL ROUTES
    Route::any('acl/get','AclController@anyData')->name('acl.any_data');
    Route::any('acl/delete-all','AclController@deleteAll')->name('acl.delete_all');
    Route::any('acl/status-all','AclController@statusAll')->name('acl.status_all');
    Route::any('acl/single_status_change','AclController@SingleStatusChange')->name('acl.single_status_change');
    Route::resource('acl','AclController');

    // RIGHTS ROUTES
    Route::any('right/get','RightController@anyData')->name('right.any_data');
    Route::any('right/delete-all','RightController@deleteAll')->name('right.delete_all');
    Route::any('right/status-all','RightController@statusAll')->name('right.status_all');
    Route::any('right/single_status_change','RightController@SingleStatusChange')->name('right.single_status_change');
    Route::resource('right','RightController');    


    // ADMIN USER ROUTES
    Route::any('admin_user/get','AdminUserController@anyData')->name('admin_user.any_data');
    Route::any('admin_user/delete-all','AdminUserController@deleteAll')->name('admin_user.delete_all');
    Route::any('admin_user/status-all','AdminUserController@statusAll')->name('admin_user.status_all');
    Route::any('admin_user/single_status_change','AdminUserController@SingleStatusChange')->name('admin_user.single_status_change');
    Route::resource('admin_user','AdminUserController');


    // PORTFOLIO ROUTES
    Route::any('portfolio/get','PortfolioController@anyData')->name('portfolio.any_data');
    Route::any('portfolio/single_status_change','PortfolioController@SingleStatusChange')->name('portfolio.single_status_change');
    Route::any('portfolio/delete-all','PortfolioController@deleteAll')->name('portfolio.delete_all');
    Route::any('portfolio/status-all','PortfolioController@statusAll')->name('portfolio.status_all');
    Route::resource('portfolio','PortfolioController');

    // TAG ROUTES
    Route::any('tag/get','TagController@anyData')->name('tag.any_data');
    Route::any('tag/single_status_change','TagController@SingleStatusChange')->name('tag.single_status_change');
    Route::any('tag/delete-all','TagController@deleteAll')->name('tag.delete_all');
    Route::any('tag/status-all','TagController@statusAll')->name('tag.status_all');
    Route::resource('tag','TagController');

    // TECHNOLOGY ROUTES
    Route::any('technology/get','TechnologyController@anyData')->name('technology.any_data');
    Route::any('technology/single_status_change','TechnologyController@SingleStatusChange')->name('technology.single_status_change');
    Route::any('technology/delete-all','TechnologyController@deleteAll')->name('technology.delete_all');
    Route::any('technology/status-all','TechnologyController@statusAll')->name('technology.status_all');
    Route::resource('technology','TechnologyController');

    // MENU ITEMS ROUTES
    Route::any('menu/get','MenuController@anyData')->name('menu.any_data');
    Route::any('menu/sorting','MenuController@sortedData')->name('menu.sorting');
    Route::any('menu/remove_menu','MenuController@removeMenu')->name('menu.remove_menu');
    Route::any('menu/menuitem_update','MenuController@menuitemUpdate')->name('menu.menuitem_update');
    Route::any('menu/menuitem_store','MenuController@menuitemStore')->name('menu.menuitem_store');
    Route::any('menu/menu_strucutre_data','MenuController@menuStrucutreData')->name('menu.menu_strucutre_data');
    Route::any('menu/menuitem_edit','MenuController@menuitemEdit')->name('menu.menuitem_edit');
    Route::resource('menu','MenuController');

});