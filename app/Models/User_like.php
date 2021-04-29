<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_like extends Model
{
    use HasFactory;

    protected $fillable = ['review_id','user_id']; //Laravel側から触っても良い

    // 1行取得
    public function likes($id) {
        return $this->where('review_id', $id)->where('user_id', \Auth::id())->first();
    }
    // すでにいいねしているか？
    public function is_like($id)
    {
        return $this->where('review_id', $id)->where('user_id', \Auth::id())->exists();
        //なければfalse,あればtrueを返す
    }
    
}
