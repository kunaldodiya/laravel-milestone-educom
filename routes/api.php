<?php

Route::group(['prefix' => 'otp', 'middleware' => 'guest:api'], function () {
    Route::post('/request-otp', 'OtpController@requestOtp');
    Route::post('/verify-otp', 'OtpController@verifyOtp');
});

Route::group(['prefix' => 'device', 'middleware' => 'guest:api'], function () {
    Route::post('/authenticate', 'UserController@authenticate');
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:api'], function () {
    Route::post('/me', 'UserController@me');
    Route::post('/update', 'UserController@update');
    Route::post('/avatar/upload', 'UserController@uploadAvatar');
});

Route::group(['prefix' => 'home', 'middleware' => 'auth:api'], function () {
    Route::post('/schools', 'HomeController@getSchools');
    Route::post('/feedback', 'HomeController@sendFeedback');
});

Route::group(['prefix' => 'subscriptions', 'middleware' => 'auth:api'], function () {
    Route::post('/create', 'SubscriptionController@createSubscription');
});

Route::group(['prefix' => 'categories', 'middleware' => 'auth:api'], function () {
    Route::post('/all', 'CategoryController@getCategories');
});

Route::group(['prefix' => 'topics', 'middleware' => 'auth:api'], function () {
    Route::post('/all', 'TopicController@getTopics');
});

Route::group(['prefix' => 'videos', 'middleware' => 'auth:api'], function () {
    Route::post('/by-topic-id', 'VideoController@getVideos');
});

Route::group(['prefix' => 'reseller'], function () {
    Route::post("/login", "ResellerController@login")->name("login");
    Route::post("/institute", "ResellerController@getInstitute")
        ->name("institute")
        ->middleware('reseller');

    Route::post("/students/add", "ResellerController@addStudent")
        ->name("add-student")
        ->middleware('reseller');

    Route::post("/students/remove", "ResellerController@removeStudent")
        ->name("remove-student")
        ->middleware('reseller');

    Route::post("/subscriptions/toggle", "ResellerController@toggleSubscription")
        ->name("toggle-subscription")
        ->middleware('reseller');
});
