<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public $timestamps = false;

    // a follow belongs to a user (inverse of follows())
    public function followed() {
        return $this->belongsTo(User::class, 'followed_id')->withTrashed();
    }

    // a follower belongs to a user (inverse of followers())
    public function follower() {
        return $this->belongsTo(User::class, 'follower_id')->withTrashed();
    }
}
