<?php

namespace App\Http\Controllers;
use App\Models\User_like;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\User;

class LikeController extends Controller
{
    public function like($id) {

        $exist = $this->is_like($id);
        
        if ($exist) {
            return false; //すでにいいね済み
        } else {
            User_like::insert(['review_id' => $id, 'user_id' => \Auth::id(),]);
            // $b = Auth::user();
            // dd($b);
            return redirect()->back()->with('flash_message', 'いいねを押しました');
            

        }

        

        // return redirect(Route('show', ['id' => $id ]))->with('flash_message', 'いいねを押しました');
       
    }
    public function unlike($id) {

        $exist = $this->is_like($id);

        if ($exist) {
            $unlike = User_like::where('review_id', $id)->where('user_id', \Auth::id());  //->firstを消したら動いた。
            $unlike->delete();
            return redirect()->back()->with('flash_message', 'いいねを外しました。');
        } else {
            return false;
        }
        
    }

    // 1行取得
    public function likes($id) {
        return User_like::where('review_id', $id)->where('user_id', \Auth::id())->first();
    }
    // すでにいいねしているか？
    public function is_like($id)
    {
        return User_like::where('review_id', $id)->where('user_id', \Auth::id())->exists();
        //なければfalse,あればtrueを返す
    }
}
