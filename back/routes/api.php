<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Route;
use romanzipp\Twitch\Enums\GrantType;
use romanzipp\Twitch\Twitch;

Route::post('login', [\App\Http\Controllers\Api\OAuthController::class, 'issueToken']);

Route::get('/', static function () {
    $twitch = new Twitch;
    $twitch->setClientId(config('services.twitch.key'));
    $twitch->setClientSecret(config('services.twitch.secret'));
    // $twitch->setToken('h22ejuubauvaz7kzede1b017qzjkfz');
    $result = $twitch->getOAuthToken(grantType:  GrantType::CLIENT_CREDENTIALS);
    // $result = $twitch->getUsers();
    // if (!$result->success()) {
    //     return response()->json([
    //         'test' => $result->getErrorMessage()
    //     ]);
    // };

    if (!$result->success()) {
        return response()->json([
            'test' => $result->getErrorMessage()
        ]);
    }
    $twitch->setToken(
        $result->data()->access_token
    );

    return response()->json([
        $twitch->getUsers(['login' => 'stray228'])->shift()
    ]);

    // $response = \Http::withHeaders([
    //     // 'Authorization' => 'Bearer h22ejuubauvaz7kzede1b017qzjkfz',
    //     'Authorization' => 'Bearer ' . config('services.twitch.key'),
    //     // 'client_id' => config('services.twitch.key'),
    //     'client_id' => 'h22ejuubauvaz7kzede1b017qzjkfz',
    // ])->get('https://api.twitch.tv/helix/users', [
    //     'client_id' => 'h22ejuubauvaz7kzede1b017qzjkfz'
    // ]);

    // return $response->json();

    // Get User by Username
    // $result = $twitch->getUsers(['login' => 'pepper_fm']);
    // $result = $twitch->getOAuthToken(null, GrantType::CLIENT_CREDENTIALS, ['user:read:email']);
    $result = $twitch->getUsers();

    // Shift result to get single user data
    // $user = $result->shift();

    // return $user;
    // return $result->data()->access_token;
    return $result;
});
