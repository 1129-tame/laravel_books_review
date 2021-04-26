<?php

namespace App\Http\Controllers;
use App\Models\User_like;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class LikeController extends Controller
{
    public function like($id) {
        User_like::insert(['review_id' => $id, 'user_id' => \Auth::id(),
          ]);

        // return redirect(Route('show', ['id' => $id ]))->with('flash_message', 'いいねを押しました');
        return redirect()->back()->with('flash_message', 'いいねを押しました');
    }
    public function unlike($id) {
        $unlike = User_like::where('review_id', $id)->where('user_id', \Auth::id());  //->firstを消したら動いた。
        
        $unlike->delete();

        return redirect()->back()->with('flash_message', 'いいねを外しました。');
    }

    // 1行取得
    public function likes($id) {
        return User_like::where('review_id', $id)->where('user_id', \Auth::id())->first();
    }
    // すでにいいねしているか？
    public function is_like($id)
    {
        return User_like::likes($id)->exists();
    }
}
