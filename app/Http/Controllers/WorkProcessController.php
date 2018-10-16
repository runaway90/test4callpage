<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Team;
use App\WorkingList;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class WorkProcessController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function addNewWorkingHours(Request $request): Response
    {
        $validator = Validator::make($request->query(),
            [   'id_employer' => 'required|integer',
                'date' => 'required|date',
                'work_from' => 'required|date_format:H:i',
                'work_to' => 'required|date_format:H:i'
                ],
            [   'id_employer' => Employer::ERROR_EMPLOYER_DATA_REQUIRED,
                'date' => WorkingList::ERROR_FORMAT_DATE,
                'work_from' => WorkingList::ERROR_FORMAT_TIME,
                'work_to' => WorkingList::ERROR_FORMAT_TIME,
                ]);

        if ($validator->fails()) {
                return response()->json($validator->errors(), 409);
            }

        $employer = $request->query->get(Employer::E_ID);
        $date = $request->query->get(WorkingList::WL_DATE);
        $from = Carbon::parse($request->query->get(WorkingList::WL_FROM));
        $to = Carbon::parse($request->query->get(WorkingList::WL_TO));

        $alreadyWorkInThisDay = WorkingList::where('employer_id', $employer)->where('date', $date)->count();
        if($alreadyWorkInThisDay > 0) {
            return response()->json(Employer::ERROR_MORE_THEN_ONCE_IN_DAY, 409);
        }

        $correctEmployer = $this->takeEmployer($request);
        if(!$correctEmployer){
            return response()->json(Employer::ERROR_EMPLOYER_ID, 409);
        }

        $newWorkPeriod = new WorkingList();
        $newWorkPeriod->date = $date;
        $newWorkPeriod->work_from = $from->toTimeString() ;
        $newWorkPeriod->work_to = $to->toTimeString();
        $newWorkPeriod->minutes_per_day = $to->diffInMinutes($from);

        $correctEmployer->workingList()->save($newWorkPeriod);

        return response('ok', 200);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function workInThisTeamInThisDay(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->query(),
            [   'id_team' => 'required|integer',
                'date' => 'required|date',
                'super_number' => 'required|integer',
            ],
            [   'id_team' => Team::ERROR_TEAM_ID,
                'date' => WorkingList::ERROR_FORMAT_DATE,
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 409);
        }

        $team = $request->query->get(Team::TEAM_ID);
        $superNumber = $request->query->get('super_number');
        $date = Carbon::parse($request->query->get('date'));

        $teamNotExist = Team::where('id', $team)->count();
        if($teamNotExist == 0) {
            return response()->json('Team not exist, please check Id or create new Team', 409);
        }

        $teamEmployers = Employer::where('team_id', $team)->get();
        $employersWorkingTimes =$teamEmployers->each->workingList;

        $results = [];
        $countResponseDate = 0;

        for($date; ; $date->addDay(1)) {
            if ($countResponseDate == $superNumber) {
                break;
            }
            $dataString = $date->toDateString();
            $dates = [];

            foreach ($employersWorkingTimes as $employer) { // see all employer by one, looking for list with actual date

                $lists = $employer->workingList->where('date', $dataString)->all();

                    foreach ($lists as $list) {
                        $array = [];
                        $dates = array_merge($dates, ['' . $list->work_from . ', ' . $list->work_to . '']);
                    }

            }
            if($dates) {
                $array = ['date' => $date->toDateString(),
                    'slot' => $dates];
                $results = array_merge($results, [$array]);
                $countResponseDate++;
            }
        }
        return response()->json($results);
    }

    /**
     * @return JsonResponse
     */
    public function getAllWorkingData() : JsonResponse
    {
        $list = new WorkingList;
        $get = $list->getAll();
        return response()->json($get);
    }

}
