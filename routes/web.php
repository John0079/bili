<?php

$clientId = 1;
$clientSecret = 'qnRIuTsukdVdftVqydR2pck5z0U17AP6qWmGNy5q';


Route::view('/', 'welcome');

// bili 登录页面
Route::view('/login', 'login');


// 第三方登陆，重定向
Route::get('/lishen/login',
    function (\Illuminate\Http\Request $request) use ($clientId) {
        $request->session()->put('state', $state = \Illuminate\Support\Str::random(40));

        $query = http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => 'http://bili.com/auth/callback',
            'response_type' => 'code',
            'scope' => '*',
            'state' => $state,
        ]);

        return redirect('http://lishen.com/oauth/authorize?'.$query);
    });



// 回调地址，获取 code，并随后发出获取 token 请求
Route::view('/auth/callback', 'auth_callback');

Route::post('/get/token', function (\Illuminate\Http\Request $request) use (
    $clientId,
    $clientSecret
) {
    // csrf 攻击处理
    $state = $request->session()->pull('state');
    throw_unless(
        strlen($state) > 0 && $state === $request->params['state'],
        InvalidArgumentException::class
    );


    $response
        = (new \GuzzleHttp\Client())->post('http://lishen.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => 'http://bili.com/auth/callback',
            'code' => $request->params['code'],
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});


// 刷新 token
Route::view('/refresh/page', 'refresh_page');

Route::post('/refresh', function (\Illuminate\Http\Request $request) use (
    $clientId,
    $clientSecret
) {
    $http = new GuzzleHttp\Client;
    $response = $http->post('http://lishen.com/oauth/token', [
        'form_params' => [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->params['refresh_token'],
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});