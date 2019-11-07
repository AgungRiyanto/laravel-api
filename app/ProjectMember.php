<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $table = "projects_members";
    protected $fillable = ['user_id', 'project_id'];
}
