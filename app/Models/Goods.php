<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /** @use HasFactory<\Database\Factories\GoodsFactory> */
    use HasFactory;

    protected $fillable = ['goods'];    /**ユーザからの入力を受け付ける */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
