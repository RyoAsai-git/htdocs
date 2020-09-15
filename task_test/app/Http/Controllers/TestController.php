<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index() {
        //先ほどのweb.php内の命令からここが実行される
        return view('tests.test');
        //resources/views/tests/に飛ぶ 
        //test.blade.php
    }
}
