<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller 
{
    public function getProject() {
        $payload = Project::all();

        return response()->json(['payload' => $payload], 200);
    }
}