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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('intervention-resizeImage',['as'=>'intervention.getresizeimage','uses'=>'FileController@getResizeImage']);
Route::post('intervention-resizeImage',['as'=>'intervention.postresizeimage','uses'=>'FileController@postResizeImage']);


//frontend routes
Route::get('/', 'Frontend\IndexController@index');
Route::resource('/aboutus', 'Frontend\AboutController');

Route::resource('/services', 'Frontend\ServicesController');

Route::resource('/contact', 'Frontend\ContactController');

Route::resource('/feedback', 'Frontend\FeedbackController');
Route::post('/feedback', 'Frontend\FeedbackController@store');

Route::resource('/news', 'Frontend\NewsController');
Route::get('/news/{date}/{slug}', 'Frontend\NewsController@show');

Route::resource('/christendom', 'Frontend\ChristendomController');
Route::get('/christendom/{date}/{slug}', 'Frontend\ChristendomController@show');

Route::resource('/photonews', 'Frontend\PhotoNewsController');
Route::get('/photonews/{id}', 'Frontend\PhotoNewsController@show');
Route::get('/photonews/{date}/{slug}', 'Frontend\PhotoNewsController@show');

Route::resource('/vaticannews', 'Frontend\VaticanNewsController');
Route::get('/vaticannews/{date}/{slug}', 'Frontend\VaticanNewsController@show');

Route::resource('/parishesnews', 'Frontend\ParishesNewsController');
Route::get('/parishesnews/{date}/{slug}', 'Frontend\ParishesNewsController@show');

Route::resource('/politics', 'Frontend\PoliticsController');
Route::get('/politics/{date}/{slug}', 'Frontend\PoliticsController@show');

Route::resource('/bishopsdesk', 'Frontend\BishopsDeskController');
Route::get('/bishopsdesk/{date}/{slug}', 'Frontend\BishopsDeskController@show');

Route::resource('/churchdocs', 'Frontend\ChurchsDocController');
Route::get('/churchdocs/{date}/{slug}', 'Frontend\ChurchsDocController@show');

Route::resource('/inspirational', 'Frontend\InspirationController');
Route::get('/inspirational/{date}/{slug}', 'Frontend\InspirationController@show');

Route::resource('/wits', 'Frontend\WitsController');
Route::get('/wits/{date}/{slug}', 'Frontend\WitsController@show');

Route::resource('/youngpeople', 'Frontend\YoungPeopleController');
Route::get('/youngpeople/{date}/{slug}', 'Frontend\YoungPeopleController@show');

Route::resource('/asiseeit', 'Frontend\AsISeeItController');
Route::get('/asiseeit/{date}/{slug}', 'Frontend\AsISeeItController@show');

Route::resource('/franktalk', 'Frontend\FrankTalkController');
Route::get('/franktalk/{date}/{slug}', 'Frontend\FrankTalkController@show');

Route::resource('/odogwu', 'Frontend\OdogwuController');
Route::get('/odogwu/{date}/{slug}', 'Frontend\OdogwuController@show');

Route::resource('/editorial', 'Frontend\EditorialController');
Route::get('/editorial/{date}/{slug}', 'Frontend\EditorialController@show');

Route::resource('/opinion', 'Frontend\OpinionController');
Route::get('/opinion/{date}/{slug}', 'Frontend\OpinionController@show');

Route::resource('/sports', 'Frontend\SportsController');
Route::get('/sports/{date}/{slug}', 'Frontend\SportsController@show');

Route::resource('/sportsprofile', 'Frontend\SportsProfileController');
Route::get('/sportsprofile/{date}/{slug}', 'Frontend\SportsProfileController@show');

Route::resource('/advertorial', 'Frontend\AdvertorialController');
Route::get('/advertorial/{date}/{slug}', 'Frontend\AdvertorialController@show');

Route::resource('/fidesinfo', 'Frontend\FidesInfoController');
Route::get('/fidesinfo/{date}/{slug}', 'Frontend\FidesInfoController@show');

Route::resource('/diocesannotifs', 'Frontend\DiocesanNotifsController');
Route::get('/diocesannotifs/{date}/{slug}', 'Frontend\DiocesanNotifsController@show');

Route::resource('/vaticannotifs', 'Frontend\VaticanNotifsController');
Route::get('/vaticannotifs/{date}/{slug}', 'Frontend\VaticanNotifsController@show');

Route::resource('/dosadinfo', 'Frontend\DosadNotifsController');
Route::get('/dosadinfo/{date}/{slug}', 'Frontend\DosadNotifsController@show');

Route::resource('/sundaytonic', 'Frontend\SundayTonicController');
Route::get('/sundaytonic/{date}/{slug}', 'Frontend\SundayTonicController@show');

Route::resource('/videos', 'Frontend\VideosController');
Route::get('/videos/{date}/{slug}', 'Frontend\VideosController@show');

//Route::post('/processMail', 'Frontend\ProcessMailController@index');
Route::get('/subscribe', 'Frontend\SubscribeController@store');

Route::get('/results', 'Frontend\SearchController@index');

Route::get('/testmail', 'Frontend\TestController@index');
Route::post('/testmail', ['as' => 'contact_store', 'uses' => 'Frontend\TestController@store']);

//backend routes
Route::get('admin', 'Admin\IndexController@index');
Route::resource('admin/aboutus', 'Admin\AboutController');

Route::resource('admin/services', 'Admin\ServicesController');

Route::resource('admin/contact', 'Admin\ContactController');

Route::resource('/admin/news', 'Admin\NewsController');
Route::get('/admin/news/{date}/{slug}', 'Admin\NewsController@show');

Route::resource('/admin/christendom', 'Admin\ChristendomController');
Route::get('/admin/christendom/{date}/{slug}', 'Admin\ChristendomController@show');

Route::resource('/admin/photonews', 'Admin\PhotoNewsController');
Route::get('/admin/photonews/{id}', 'Admin\PhotoNewsController@show');
Route::get('/admin/photonews/create/{id}', 'Admin\PhotoNewsController@create');
//Route::get('/admin/photonews/{date}/{slug}', 'Admin\PhotoNewsController@show');

Route::resource('/admin/photoalbum', 'Admin\PhotoNewsAlbumController');
Route::get('/admin/photoalbum/{id}', 'Admin\PhotoNewsAlbumController@show');

Route::resource('/admin/vaticannews', 'Admin\VaticanNewsController');
Route::get('/admin/vaticannews/{date}/{slug}', 'Admin\VaticanNewsController@show');

Route::resource('/admin/parishesnews', 'Admin\ParishesNewsController');
Route::get('/admin/parishesnews/{date}/{slug}', 'Admin\ParishesNewsController@show');

Route::resource('/admin/politics', 'Admin\PoliticsController');
Route::get('/admin/politics/{date}/{slug}', 'Admin\PoliticsController@show');

Route::resource('/admin/bishopsdesk', 'Admin\BishopsDeskController');
Route::get('/admin/bishopsdesk/{date}/{slug}', 'Admin\BishopsDeskController@show');

Route::resource('/admin/churchdocs', 'Admin\ChurchsDocController');
Route::get('/admin/churchdocs/{date}/{slug}', 'Admin\ChurchsDocController@show');

Route::resource('/admin/inspirational', 'Admin\InspirationController');
Route::get('/admin/inspirational/{date}/{slug}', 'Admin\InspirationController@show');

Route::resource('/admin/wits', 'Admin\WitsController');
Route::get('/admin/wits/{date}/{slug}', 'Admin\WitsController@show');

Route::resource('/admin/youngpeople', 'Admin\YoungPeopleController');
Route::get('/admin/youngpeople/{date}/{slug}', 'Admin\YoungPeopleController@show');

Route::resource('/admin/asiseeit', 'Admin\AsISeeItController');
Route::get('/admin/asiseeit/{date}/{slug}', 'Admin\AsISeeItController@show');

Route::resource('/admin/franktalk', 'Admin\FrankTalkController');
Route::get('/admin/franktalk/{date}/{slug}', 'Admin\FrankTalkController@show');

Route::resource('/admin/odogwu', 'Admin\OdogwuController');
Route::get('/admin/odogwu/{date}/{slug}', 'Admin\OdogwuController@show');

Route::resource('/admin/editorial', 'Admin\EditorialController');
Route::get('/admin/editorial/{date}/{slug}', 'Admin\EditorialController@show');

Route::resource('/admin/opinion', 'Admin\OpinionController');
Route::get('/admin/opinion/{date}/{slug}', 'Admin\OpinionController@show');

Route::resource('/admin/sports', 'Admin\SportsController');
Route::get('/admin/sports/{date}/{slug}', 'Admin\SportsController@show');

Route::resource('/admin/sportsprofile', 'Admin\SportsProfileController');
Route::get('/admin/sportsprofile/{date}/{slug}', 'Admin\SportsProfileController@show');

Route::resource('/admin/advertorial', 'Admin\AdvertorialController');
Route::get('/admin/advertorial/{date}/{slug}', 'Admin\AdvertorialController@show');

Route::resource('/admin/fidesinfo', 'Admin\FidesInfoController');
Route::get('/admin/fidesinfo/{date}/{slug}', 'Admin\FidesInfoController@show');

Route::resource('/admin/diocesannotifs', 'Admin\DiocesanNotifsController');
Route::get('/admin/diocesannotifs/{date}/{slug}', 'Admin\DiocesanNotifsController@show');

Route::resource('/admin/vaticannotifs', 'Admin\VaticanNotifsController');
Route::get('/admin/vaticannotifs/{date}/{slug}', 'Admin\VaticanNotifsController@show');

Route::resource('/admin/dosadinfo', 'Admin\DosadNotifsController');
Route::get('/admin/dosadinfo/{date}/{slug}', 'Admin\DosadNotifsController@show');

Route::resource('/admin/sundaytonic', 'Admin\SundayTonicController');
Route::get('/admin/sundaytonic/{date}/{slug}', 'Admin\SundayTonicController@show');

Route::resource('/admin/videos', 'Admin\VideosController');
Route::get('/admin/videos/{date}/{slug}', 'Admin\VideosController@show');

Route::get('/admin/notify', 'Admin\NotificationController@index');

Route::resource('/admin/ads', 'Admin\AdsController');
//Route::get('/admin/ads/{date}/{slug}', 'Admin\AdsController@show');
Route::resource('/admin/comments', 'Admin\CommentsController');

Route::get('/admin/feature/{category}/{id}/{date}/{title}/{photo}/{slug}', 'Admin\FeaturedNewsController@create');

Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
