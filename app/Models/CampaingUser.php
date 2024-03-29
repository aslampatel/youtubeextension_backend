<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaingUser extends Model
{
    use HasFactory;
    
    protected $fillable = ["user_id", "campaign_id", "owner_id", "coin"];
}
