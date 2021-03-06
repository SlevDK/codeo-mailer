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

    Route::get('/account', 'AccountController@show');

    Route::get('/manager/campaigns', 'CampaignController@index');
    Route::apiResource('/manager/campaign', 'CampaignController', ['except' => ['index']]); // should be campaigns?

    Route::get('/manager/campaign/{id}/target-emails', 'MaillistController@show');  // should be campaigns?
    Route::put('/manager/campaign/{id}/target-emails', 'MaillistController@update');    // should be campaigns?

    Route::get('/manager/campaign/{id}/proxy-settings', 'CampaignProxySettingsController@show');
    Route::put('/manager/campaign/{id}/proxy-settings', 'CampaignProxySettingsController@update');

    Route::get('/manager/campaign/{id}/from-email-settings', 'CampaignFromEmailSettingsController@show');
    Route::put('/manager/campaign/{id}/from-email-settings', 'CampaignFromEmailSettingsController@update');

    Route::get('/manager/campaign/{id}/randomizer-settings', 'CampaignRandomizerSettingsController@show');
    Route::put('/manager/campaign/{id}/randomizer-settings', 'CampaignRandomizerSettingsController@update');

    Route::get('/manager/campaign/{id}/additional-settings', 'CampaignAdditionalSettingsController@show');
    Route::put('/manager/campaign/{id}/additional-settings', 'CampaignAdditionalSettingsController@update');


    /******************** MAILS ***********************/
    Route::post('/manager/campaign/{id}/mails', 'MailController@store');
    Route::apiResource('/manager/mails', 'MailController', ['except' => ['index', 'store']]);

    Route::get('/manager/mails/{id}/topics', 'TopicController@show');
    Route::put('/manager/mails/{id}/topics', 'TopicController@update');

    Route::get('/manager/mails/{id}/body', 'BodyController@show');
    Route::put('/manager/mails/{id}/body', 'BodyController@update');

    Route::get('/manager/mails/{id}/headers', 'HeaderController@show');
    Route::put('/manager/mails/{id}/headers', 'HeaderController@update');

    Route::get('/manager/mails/{id}/settings', 'MailSettingsController@show');
    Route::put('/manager/mails/{id}/settings', 'MailSettingsController@update');

    Route::get('/manager/mails/{id}/to-aliases', 'ToAliasController@show');
    Route::put('/manager/mails/{id}/to-aliases', 'ToAliasController@update');

    Route::get('/manager/mails/{id}/from-aliases', 'FromAliasController@show');
    Route::put('/manager/mails/{id}/from-aliases', 'FromAliasController@update');

    Route::get('/manager/mails/{id}/from-domains', 'FromDomainController@show');
    Route::put('/manager/mails/{id}/from-domains', 'FromDomainController@update');

    Route::get('/manager/mails/{id}/from-logins', 'FromLoginController@show');
    Route::put('/manager/mails/{id}/from-logins', 'FromLoginController@update');

    /**********************************************************/

    /********************* DATABASES *****************************/
    Route::apiResource('/databases/topics', 'Database\TopicController');
    Route::apiResource('/databases/maillists', 'Database\MaillistController');
    Route::apiResource('/databases/proxies', 'Database\ProxyController');
    Route::apiResource('/databases/headers', 'Database\HeaderController');
    Route::apiResource('/databases/from-domains', 'Database\FromDomainController');

    Route::apiResource('/databases/files', 'Database\FileController');
    Route::post('/databases/files/{directory}/', 'Database\FileController@storeToDirectory');
    Route::delete('/databases/files/{directory}/{file}', 'Database\FileController@destroyFromDirectory');

});

