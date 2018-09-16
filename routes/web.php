<?php

/**
 * Route URI's
 */
Route::group(['prefix' => config('uptube.routes.prefix')], function() {

    /**
     * Authentication
     */
    Route::get(config('uptube.routes.authentication_uri'), function()
    {
        return redirect()->to(Uptube::createAuthUrl());
    });

    /**
     * Redirect
     */
    Route::get(config('uptube.routes.redirect_uri'), function(Illuminate\Http\Request $request)
    {
        if(!$request->has('code')) {
            throw new Exception('$_GET[\'code\'] is not set. Please re-authenticate.');
        }

        $token = Uptube::authenticate($request->get('code'));

        Uptube::saveAccessTokenToDB($token);

        return redirect(config('uptube.routes.redirect_back_uri', '/'));
    });

});
