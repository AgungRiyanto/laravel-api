<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class ProjectController extends Controller {

    public function __construct() {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:projects,name',
            'description' => 'sometimes|string'
        ]);

        if($validator->fails()){
            return response()->error('the given data was in valid', $validator->errors()->toJson());
        }

        $projects = Project::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'created_by' => $this->user->id
        ]);

        ProjectMember::create([
            'user_id' => $this->user->id,
            'project_id' => $projects->id
        ]);

        return response()->success('Successfully create project', $projects);
    }

    public function getProject() {
        $projects = Project::all();

        return response()->success('Project list retrieved', $projects);
    }
}