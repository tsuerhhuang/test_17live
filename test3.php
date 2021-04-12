<?php

// 3.Laravel 當中的 middleware 能夠在進入 controller 和離開 controller 後提供額外的操作，參考 官方文件 。若換成自己設計類似的 middleware ，請描述一下會如何設計以及設計的做法。
// 在此提供兩種做法

// 1.製作在controller 內的__construct
class TestController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('web');
    }
}

// 2.製作在route內處理

// 先經過middleware才經過controller
Route::middleware('auth')->get('test', function () {});
Route::get('test', function () {})->middleware('auth');

// middleware 的說明

class TestMiddleware
{
    public function handle($request, Closure $next)
    {
        echo 'before';
        $response = $next($request); // 處理request
        echo 'after';

        return $response;
    }
}
