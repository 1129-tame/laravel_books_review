<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //indexが呼び出されたらindexページに飛ぶ
    public function index() {
        return view('index');
    }
}
