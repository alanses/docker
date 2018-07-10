<?php

namespace App\Http\Controllers\Admin;

use App\Entity\HomeCallDoctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class PatientsCallHomeController extends Controller
{

    public function callDoctorByDay()
    {
        $data = HomeCallDoctor::where('created_at', '=>', Carbon::today()
            ->toDateString())
            ->get();

        return response()->json([
            'DoctorCalls' => $data
        ], 201);

    }

    public function callDoctorByWeek(Carbon $carbon)
    {
        $data = HomeCallDoctor::where('created_at', '=>', $carbon->startOfWeek())
            ->orWhere('created_at', '<=', $carbon->endOfWeek())
            ->get();

        return response()->json([
            'DoctorCalls' => $data
        ], 201);

    }

    public function callDoctorByMonth(Carbon $carbon)
    {
        $data = HomeCallDoctor::where('created_at', '>=', $carbon->startOfMonth())
            ->orWhere('created_at', '<=', $carbon->endOfMonth())
            ->get();

        return response()->json([
            'DoctorCalls' => $data
        ], 201);

    }
}
