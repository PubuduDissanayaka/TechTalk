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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/map', function () {
    return view('events.testmap');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Auth::routes();


Route::get('/dashboard', 'DashboardController@dashboard');


Route::resource('/profile', 'ProfileController');

Route::resource('blog-posts', 'BlogPostController');

Route::resource('catagories', 'CatagoryController');

Route::resource('events', 'EventController');

Route::post('notification/get', 'NotificationController@get');
Route::post('notification/read', 'NotificationController@read');
Route::post('notification/readall', 'NotificationController@readall');

Route::resource('feedcomments', 'NewsFeedCommentController');

Route::resource('comments', 'blogCommentController');

Route::resource('/friends', 'friendController');
Route::post('/friends/remove', 'friendController@remove');
Route::post('/request', 'friendController@request');



Route::get('/chat/{id}', 'ChatController@show')->middleware('auth')->name('chat.show');

Route::get('/chat', 'ChatController@index')->middleware('auth')->name('chat.index');

Route::post('/chat/getChat/{id}', 'ChatController@getChat')->middleware('auth');

Route::post('/chat/sendChat', 'ChatController@sendChat')->middleware('auth')->name('chat.send');

Route::resource('news-feed', 'NewsFeedController');

Route::resource('eventcomments', 'EventCommentController');

Route::resource('register-user', 'RegController');

Route::get('/verification/{token}' , 'RegController@verification');

Route::post('/profile/picture/upload', 'ProfileController@proPicUpload')->name('upload.propic');

Route::resource('vacancy', 'VacancyController')->middleware('auth');
Route::post('/vacancy/apply', 'VacancyController@apply')->middleware('auth')->name('cv.apply');


Route::resource('study', 'StudyController');
Route::post('/study/apply', 'StudyController@apply')->middleware('auth')->name('study.apply');

Route::resource('studycomments', 'StudyCommentController');

Route::resource('studyrating', 'StudyRatingController');
Route::resource('userrating', 'UserRatingController');

Route::get('/search', 'SearchController@index')->name('search.index');
Route::post('/search/action', 'SearchController@action')->name('search.action');


Route::post('/news-feed/like', 'NewsFeedController@like');
Route::resource('addskills', 'UserProSkillController');
Route::resource('sendmessage', 'SendMsgController');


