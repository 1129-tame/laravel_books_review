<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_like extends Model
{
    use HasFactory;

    protected $fillable = ['review_id','user_id']; //Laravel側から触っても良い

    public function is_like() {
        return true;
    }
}
