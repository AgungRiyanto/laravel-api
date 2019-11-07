<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = "teams_members";
    protected $fillable = ['user_id', 'team_id'];
}
