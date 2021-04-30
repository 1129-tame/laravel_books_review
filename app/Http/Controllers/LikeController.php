<?php

namespace App\Http\Controllers;
use App\Models\User_like;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\User;

class LikeController extends Controller
{
    public function like($id) {
        $is_like = User_like::like($id);

        if (!$is_like) {
            return redirect()->back()->with('flash_message', 'いいねをすでに押しています');
        } else {
            return redirect()->back()->with('flash_message', 'いいねを押しました');
        }

    }
    public function unlike($id) {
        $is_like = User_like::unlike($id);

        if (!$is_like) {
            return redirect()->back()->with('flash_message', 'いいねをまだしていません');
        } else {
            return redirect()->back()->with('flash_message', 'いいねを外しました。');
        }
    }
}
