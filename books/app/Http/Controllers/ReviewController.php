<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use Auth;

class ReviewController extends Controller
{
    //indexが呼び出されたらindexページに飛ぶ
    public function index() {
        return view('index');
    }

    public function create() {
        return view('review');
    }

    public function store(Request $request) {
        $post = $request->all();
        $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'body' => $post['body']];
        // dd($post);
        // dd($data);
        Review::insert($data);

        return redirect('/');
    }
}
