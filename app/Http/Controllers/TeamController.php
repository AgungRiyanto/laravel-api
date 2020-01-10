<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use DB;

class TeamController extends Controller {

    public function __construct() {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:teams,name',
            'description' => 'sometimes|string'
        ]);

        if($validator->fails()){
            return response()->error('the given data was in valid', $validator->errors()->toJson());
        }

        DB::beginTransaction();

        try {
            $teams = Team::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'created_by' => $this->user->id
            ]);
    
            TeamMember::create([
                'user_id' => $this->user->id,
                'team_id' => $teams->id
            ]);

            DB::commit();
    
            return response()->success('Successfully create team', $teams);
        } catch(\Exception $e) {
            DB::rollback();
            return response()->error($e->getMessage(), $e);
        }
    }

    public function getTeam() {
        $teams = Team::all();

        return response()->success('Teams list retrieved', $teams);
    }
}