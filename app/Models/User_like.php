<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_like extends Model
{
    use HasFactory;

    protected $fillable = ['review_id','user_id']; //Laravel側から触っても良い

    public static function like($id) {
        $model = new User_like();
        $exist = $model->is_like($id);
        
        if ($exist) {
            return false; //すでにいいね済み
        } else {
            User_like::insert(['review_id' => $id, 'user_id' => \Auth::id(),]);
            return true;
        }
    }

    public static function unlike($id) {
        $model = new User_like();
        $exist = $model->is_like($id);

        if ($exist) {
            $unlike = User_like::where('review_id', $id)->where('user_id', \Auth::id()); 
            $unlike->delete();
            return true;
        } else {
            return false;
        }
    }

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
