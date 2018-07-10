<?php

namespace App\Http\Controllers\Frontend;

use App\Entity\Schedule;
use App\Entity\Workers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorCabinetController extends Controller
{
    public function changeSetings(Request $request)
    {
        $data = $request->only([
            'name',
            'second_name',
            'last_name',
            'email',
            'description',
            'id',
            'worker'
        ]);
        try {
            $user = User::findOrFail($data['id']);
            $user->worker->update([
                'description' => $data['worker']['description']
            ]);
            $user->update([
                'name' => $data['name'],
                'second_name' => $data['second_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email']
            ]);
            return response()->json([
                'updated' => 1
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'updated' => 0
            ], 400);
        }
    }

    public function getInfoAboutDoctor(Request $request)
    {
        $data = User::with('worker')->where('id', '=', Auth::user()->id)
            ->get()
            ->first();

        $workerInformation = Workers::with('specilization')
            ->with('department')
            ->where('user_id', Auth::user()->id)
            ->get();

        return response()->json([
            'user' => $data,
            'workerInformation' => $workerInformation
        ], 203);
    }

    public function getScheduleWeek(Request $request, Carbon $carbon)
    {

        $data = new Carbon();
        $selectedByWeek = Schedule::with('user')
            ->where('doctor_id', $request->all()['worker']['id'])
            ->whereDate('date', '>', $data->startOfWeek())
            ->whereDate('date', '<', $carbon->endOfWeek())
            ->get();

        if(!empty($selectedByWeek)){
            return response()->json(['schedule' => $selectedByWeek], 201);
        } else {
            return response()->json(['empty' => 0], 400);
        }
    }

    public function getScheduleMonth(Request $request, Carbon $carbon)
    {
        $data = new Carbon();

        $selectedByMonth = Schedule::with('user')
            ->where('doctor_id', $request->input('id'))
            ->whereDate('date', '>', $data->startOfMonth())
            ->whereDate('date', '<', $carbon->endOfMonth())
            ->get();

        return response()->json([
            'schedule' => $selectedByMonth
        ], 201);
    }

    public function saveNewReception(Request $request)
    {
        $data = $request->all();
        try {
            $this->checkTimeForRegistration($data);
            if(!empty($this->checkTimeForRegistration($data))){
                throw new \Exception();
            } else {
                Schedule::create($request->all());
                return response()->json(['status', 1], 201);
            }
        } catch (\Exception $exception) {
            return response()->json(['status', 0], 400);
        }
    }

    /**
     * Return true if time end doctor id qnique.
     */
    private function checkTimeForRegistration($request)
    {
        return Schedule::where('doctor_id', '=', $request['doctor_id'])
            ->whereDate('date', '=', $request['date'])
            ->whereBetween('start', [$request['start'], $request['end']])
            ->orwhereBetween('end', [$request['end'], $request['start']])
            ->get()
            ->count();
}
}
