<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "youtube_link", "poster", "channel_info", "watch_method", "video", "subscribe_channel", "video_comment", "video_like", "like_comment", "traffic_soure", "min_time", "max_time", "add_skip", "limit_budget", "budget","used_coin"];
}
