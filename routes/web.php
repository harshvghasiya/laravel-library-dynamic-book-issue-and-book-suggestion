<?php

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

// usage inside a laravel route


Route::group(['as'=>'front.'],function(){

	Route::get('/test-size','HomeController@testSize')->name('testSize'); 
	// HOME PAGE ROUTES
	Route::get('/','HomeController@index')->name('home'); 
	Route::get('/portfolio','PortfolioController@getPortFolioAll')->name('get_port_folio_all'); 
	Route::get('/portfolio/{slug}','PortfolioController@getPortFolioDetail')->name('get_port_folio_detail'); 
	Route::get('/demo-post','HomeController@demo')->name('demo'); 
	Route::post('/home/popular-section','HomeController@popularSection')->name('home.popular_section'); 
	Route::get('pagination/blog_ajax', 'HomeController@blogAjax')->name('home.blog_ajax');
	// conatct us page
	Route::any('conatct-us/store', 'ContactUsController@storeFrontContactUs')->name('contact_us.store');
	
	
	// NEWS LETTER
	Route::any('news-letter/store', 'NewsLetterController@storeFrontNewsLetter')->name('news-letter.store');
	Route::any('news-letter/verify/{token}', 'NewsLetterController@verifyFrontNewsLetter')->name('news-letter.verify_front_news_letter'); ;
	
	// CATEGORY BLOG 
	Route::get('/category','CategoryController@allCategory')->name('category.get_all_category'); 
	Route::get('pagination/all_category', 'CategoryController@paginationCategory')->name('category.category_pagination_ajax');
	Route::get('pagination/single_category_all_blog', 'CategoryController@singlePaginationAllBlog')->name('category.single_pagination_all_blog');
	Route::get('/category/{slug}','CategoryController@singleCategoryAllBlog')->name('category.category_single'); 
	// BLOG DETAILS
	Route::post('/post/news_total_view_count','BlogController@totalViewCount')->name('blog.total_view_count'); 
	Route::post('/post/news_details_recent','BlogController@newsDetailRecent')->name('news.news_detail_recent'); 
	Route::get('/search-all-post/','BlogController@searchPost')->name('blog.search_post'); 
	Route::get('/post/{slug}','BlogController@blogDetail')->name('blog.details'); 
	Route::get('/blog','BlogController@searchPost')->name('blog.list'); 
	Route::get('pagination/tag_ajax', 'TagController@tagAjax')->name('tag.tag_ajax'); ;
	Route::get('/tag/{slug}','TagController@frontTagDetail')->name('tag.detail'); 
	// NEWS DETAILS
	Route::get('/{slug}','CmsController@detail')->name('cms.details'); 


});

