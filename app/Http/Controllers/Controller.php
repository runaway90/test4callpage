<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Team;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @return Response
     */
    public function createEmployer(Request $request) : Response
    {
        $validator = Validator::make($request->query(),
            [   'id_team' => 'required|integer',
                'first_name' => 'string|max:191',
                'second_name' => 'string|max:191',
                'vacancy' => 'string|max:191'
            ],
            [   'id_team' => Team::ERROR_TEAM_ID,
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 409);
        }

        $getTeam = $this->takeTeam($request);
        if(!$getTeam){
            return response()->json(Team::ERROR_TEAM_ID, 409);
        }

        $newEmployer = new Employer();
        $newEmployer->first_name = $request->query->get(Employer::E_NAME);
        $newEmployer->second_name = $request->query->get(Employer::E_SURNAME);
        $newEmployer->vacancy = $request->query->get(Employer::E_VACANCY);

        $getTeam->employers()->save($newEmployer);

        return response('ok', 200);
    }

    /**
     * @param Request $request
     * @return  bool | array
     */
    public function takeEmployer(Request $request)
    {
        $employer = $request->query->get(Employer::E_ID);
        $get = Employer::where('id', $employer)->first();
        if(!$get){
            return false;
        }else{
            return $get;
        }

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createTeam(Request $request) : Response
    {
        $validator = Validator::make($request->query(),
            [   'name' => 'required|integer',
                'city' => 'string|max:191',
                'description' => 'string|max:191',
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 409);
        }

        $newTeam = new Team();
        $newTeam->name = $request->query->get(Team::TEAM_NAME);
        $newTeam->city = $request->query->get(Team::TEAM_CITY);
        $newTeam->description = $request->query->get(Team::TEAM_DESCRIPTION);
        $newTeam->save();

        return response('ok', 200);
    }

    /**
     * @param Request $request
     * @return  bool | array
     */
    public function takeTeam(Request $request)
    {
        $team = $request->query->get(Team::TEAM_ID);
        $get = Team::where('id', $team)->first();
        if(!$get){
            return false;
        }else{
            return $get;
        }
    }

}
