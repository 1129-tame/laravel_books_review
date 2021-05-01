<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\User_like;
use Auth;

class ReviewController extends Controller
{
    //indexが呼び出されたらindexページに飛ぶ
    public function index() {

        $reviews = Review::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
        // dd($reviews);

        return view('index', compact('reviews'));
    }

    public function show($id) {
        $review = Review::where('id', $id)->where('status', 1)->first(); //一件取得
        // いいねを押したかどうか、判別
        $like = User_like::where('review_id', $id)->where('user_id', \Auth::id())->exists();

        $like_count = User_like::where('review_id', $id)->count();

        return view('show', compact('review', 'like', 'like_count'));
    }

    public function create() {
        return view('review');
    }

    public function store(Request $request) {
        $post = $request->all();

        //バリデーション
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'mimes:jpeg, png, jpg, gif, svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->store('/public/images');
            $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'body' => $post['body'], 'image' => $request->file('image')->hashName()];
        } else {
            $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'body' => $post['body']];
        }
        

        Review::insert($data);

        return redirect('/')->with('flash_message', '投稿が完了しました');
    }
}
