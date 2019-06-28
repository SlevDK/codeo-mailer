<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/account/create', 'AuthController@register');
Route::post('/account/token-obtain', 'AuthController@login');

// Authorized api requests
Route::middleware('auth:api')->group(function() {

    Route::get('/manager/campaigns', 'CampaignController@index');
    Route::apiResource('/manager/campaign', 'CampaignController', ['except' => ['index']]); // should be campaigns?

    Route::post('/manager/campaign/{id}/mails', 'MailController@store');
    Route::apiResource('/manager/mails', 'MailController', ['except' => ['index', 'store']]);

    Route::get('/manager/mails/{mail_id}/topics', 'TopicController@show');
    Route::put('/manager/mails/{id}/topics', 'TopicController@update');

    Route::get('/manager/mails/{mail_id}/body', 'BodyController@show');
    Route::put('/manager/mails/{id}/body', 'BodyController@update');

    Route::get('/manager/mails/{mail_id}/headers', 'HeaderController@show');
    Route::put('/manager/mails/{id}/headers', 'HeaderController@update');

});

