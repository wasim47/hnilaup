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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'Index@index')-> name('home');
Route::get('management', 'Index@management')->name('management');
Route::get('messages/{id}', 'Index@messages')->name('management.details');
Route::get('holdinginfo', 'Index@holdinginfo')->name('holdinginfo');

Route::get('photos', 'Index@photos')->name('photos');
Route::get('videos', 'Index@videos')->name('videos');
Route::get('members', 'Index@employee')->name('members');
Route::get('employee/{id}', 'Index@employee_details')->name('employee.details');

Route::get('notice', 'Index@notice')->name('notice');
Route::get('notice/{id}', 'Index@notice_details')->name('notice.details');

Route::get('content', 'Index@index')->name('home');
Route::get('content/{slug}', 'Index@contents')->name('websitecontent');
Route::get('content/{slug}/{sslug}', 'Index@contents')->name('websitecontent');
Route::get('content/{slug}/{sslug}/{ssslug}', 'Index@contents')->name('websitecontent');

Route::any('userapprove', 'CommonController@permissions')->name('user.approve');
Route::any('usersapprove', 'CommonController@permissionsUser')->name('users.approve');
Route::get('testingdata', 'CommonController@updateSlug');
Route::any('masterdelete', 'CommonController@deletedata')->name('masterdelete');
Route::get('holdingsearch','Index@getAjaxUserData')->name('frontend.ajaxsearch');


Route::group(['prefix' => 'secretary', 'namespace' => 'Secretary'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
	Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('secretary.login');
		
	 // Password Reset Routes...
    Route::get('/forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('secretary.forgotpassword');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('secretary.passemail');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('secretary.password.reset');
    Route::post('/resetpassowrd', 'Auth\ResetPasswordController@resetpassword')->name('secretary.resetpassowrd');	
});

Route::group(['prefix' => 'secretary',  'namespace' => 'Secretary', 'middleware' => 'auth:secretary'], function()
{
	Route::get('/profile', 'ProfileController@index')->name('secretary.profile');		
	Route::post('/new-user', 'ProfileController@storeNewUser')->name('secretary.newuser');
	Route::post('/useredit', 'ProfileController@userUpdate')->name('secretary.useredit');	
	Route::post('/secretaryprofile', 'ProfileController@updateProfile')->name('secretary.updateprofile');	
	Route::post('/change-password', 'ProfileController@updatepassword')->name('secretary.passwordupdate');
    Route::post('logout', 'Auth\LoginController@logout')->name('secretary.logout');
	Route::get('/printinfo/{id}', 'ProfileController@printdata')->name('secretary.printinfo');	
	
	
	Route::get('/ajaxsearch','ProfileController@getAjaxUserData')->name('userdata.ajaxsearch');
});


//////////////////////////////////////////////////////////////////////////////////// Admin Routing Areas /////////////////////////////////////////////////////////////////////////
Route::get('administration', 'Auth\LoginController@showLoginForm')->name('administration');
Route::post('adminlogin', 'Auth\LoginController@login')->name('adminlogin');

//Auth::routes();
Route::group(['prefix' => 'administration',  'middleware' => 'auth:administration'], function()
{
	Route::post('/logout', ['uses' => 'Auth\LoginController@logout'])->name('administration.logout');
	Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);
	Route::post('/', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);
	
	Route::post('/password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
	Route::get('/password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
	Route::post('/password/reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);
	Route::get('/password/reset/{token}', ['as' => 'password.reset','uses' => 'Auth\ResetPasswordController@showResetForm']);
	
	// Registration Routes...
	Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
	Route::post('register', ['as' => '', 'uses' => 'Auth\RegisterController@register']);
	
	Route::any('masterdelete', 'CommonController@deletedata');
	Route::any('permissions', 'CommonController@permissions')->name('permissions');
	Route::any('permissionsuser', 'CommonController@permissionsUser')->name('permissionsuser');
	
	Route::get('/article/ajaxsearch','ArticleController@searchajax')->name('article.ajaxsearch');
	
	Route::resource('admins','AdminController');
	Route::resource('menus','MenusController');
	Route::resource('contents','ContentController');
	Route::resource('banner','BannerController');
	Route::resource('logo','LogoController');
	Route::resource('employee','EmployeeController');
	Route::resource('usefulllink','UsefulllinkController');
	Route::resource('noticetype','NoticetypeController');
	Route::resource('notice','NoticeController');
	Route::resource('management','ManagementController');
	Route::resource('photogalery','PhotoGalleryController');
	Route::resource('gallery','GalleryController');
	Route::resource('video','VideoController');	
	Route::resource('secretary','SecretaryController');
	Route::resource('news','NewsController');
	Route::resource('documents','DocumentController');
	Route::resource('holdinginfo','HoldinginfoController');
	Route::resource('receipt','ReceiptController');
	Route::resource('fixbanner','FixbannerController');
	Route::get('receipt/print/{id}','ReceiptController@prints')->name('receipt.print');
	Route::get('/ajaxmenu','MenusController@searchmenu')->name('menu.ajaxmenu');
	
	
	Route::get('/holding/samplefiledownload','CommonController@sampleFileDownload')->name('holding.samplefiledownload');
	Route::post('/holding/import','CommonController@import')->name('holding.import');
	Route::get('/holding/export','CommonController@export')->name('holding.export');
});
