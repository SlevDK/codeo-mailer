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
    Route::apiResource('/manager/campaign', 'CampaignController', ['except' => ['index']]);

});

