<?php

namespace App\Http\Controllers\Frontend;

use App\Entity\Schedule;
use App\Entity\Workers;
use App\Http\Resources\SearchDoctorsCollection;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserCabinetController extends Controller
{
    public function changeSetings(Request $request)
    {
        try {
            $user = User::findOrFail($request->input('id'));
            $user->update([
                'name' => $request->input('name'),
                'second_name' => $request->input('second_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);
            return response()->json(['updated' => 1], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => 1], 400);
        }
    }

    public function logOut()
    {
        Auth::logout();
        return response()->json([
            'status' => 1
        ], 202);

    }


    public function getListRegistrationToDoctorWeek(Carbon $carbon)
    {

        $data = clone $carbon;

        $userCalls = User::leftJoin('schedules', 'users.id', '=', 'schedules.user_id')
            ->leftJoin('workers', 'schedules.doctor_id', '=', 'workers.id')
            ->leftJoin('specializations', 'workers.specialization_id', '=', 'specializations.id')
            ->select(['*',
                'specializations.name as specializationDoctor',
                'workers.name as doctorName',
                'workers.second_name as doctorSecondName',
                'workers.last_name as doctorLastName',
                'schedules.id as numberTalon'
            ])
            ->where('schedules.user_id', '=', Auth::user()->id)
            ->whereDate('date', '>', $data->startOfWeek())
            ->whereDate('date', '<', $carbon->endOfWeek())
            ->get();
        if(!empty($userCalls)) {
            return response()->json([
                'userCalls' => $userCalls
            ], 201);
        }else{
            return response()->json([
                'error' => 1
            ], 400);
        }

    }

    public function getListRegistrationToDoctorMonth(Carbon $carbon)
    {
        $data = clone $carbon;

        $userCalls = User::leftJoin('schedules', 'users.id', '=', 'schedules.user_id')
            ->join('workers', 'schedules.doctor_id', '=', 'workers.id')
            ->leftJoin('specializations', 'workers.specialization_id', '=', 'specializations.id')
            ->select(['*',
                'specializations.name as specializationDoctor',
                'workers.name as doctorName',
                'workers.second_name as doctorSecondName',
                'workers.last_name as doctorLastName',
                'schedules.id as numberTalon'
            ])
            ->where('schedules.user_id', '=', Auth::user()->id)
            ->whereDate('date', '>', $data->startOfMonth())
            ->whereDate('date', '<', $carbon->endOfMonth())
            ->get();
        if(!empty($userCalls)) {
            return response()->json([
                'userCalls' => $userCalls
            ], 201);
        }else{
            return response()->json([
                'error' => 1
            ], 400);
        }
    }

    public function getUserData()
    {
        try {
            $user = Auth::user();
            return response()->json([
                'user' => $user
            ], 202);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 1
            ], 400);
        }


    }

    public function searchDoctors(Request $request)
    {
        $data = $request->all();
        $resultSearch = Workers::LeftJoin('schedules', 'workers.id','=','schedules.doctor_id')
            ->leftJoin('users', 'workers.user_id', '=', 'users.id')
            ->select(['*',
                'workers.name as workerName',
                'workers.second_name as workerSecondName',
                'workers.last_name as workerLastName',
                'workers.description as userDescription',
                'users.image as userImage',
                'schedules.id as schedulesIdentify'
            ])
            ->where('workers.specialization_id', '=', $data['specialization'])
            ->where('workers.department_id', '=', $data['department'])
            ->where('schedules.date', '=', $data['dataForRegistration'])
            ->where('schedules.status', '=', 0)
            ->get();

        return (new SearchDoctorsCollection($resultSearch))
            ->response()
            ->setStatusCode(201);

    }

    public function makeRecordToDoctor(Request $request)
    {
        try {
            $data = $request->all();
            Schedule::where('id', '=', $request['schedulesIdentify'])
                ->get()
                ->first()
                ->update([
                    'user_id' => $data['user_identificator'],
                    'status' => 1
                ]);
            return response()->json([
                'success' => '1',
                'schedule_identify' => $request['schedulesIdentify']
            ], 201);
        }catch (\Exception $exception) {
            return response()->json(['success' => '0'], 400);
        }

    }
}
