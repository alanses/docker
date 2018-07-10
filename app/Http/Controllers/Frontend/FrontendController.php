<?php

namespace App\Http\Controllers\Frontend;

use App\Entity\Department;
use App\Entity\Schedule;
use App\Entity\Specialization;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {

        return view('frontend.index');
    }

    public function callDoctorAtHome()
    {
        return view('frontend.calldoctor');
    }

    public function showNews()
    {
        return view('frontend.news');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function makeRecordToDoctor()
    {
        $departments = Department::all();
        $specializations = Specialization::all();
        return view('frontend.recorddoctor', compact('departments', 'specializations'));
    }

    public function cabinetUser()
    {
        return view('frontend.cabinetuser');
    }

    public function cabinetDoctor()
    {
        try {
            $user = User::with('worker')->where('id', '=', Auth::user()->id)
                ->get()
                ->first();
            return view('frontend.cabinetdoctor', compact('user'));
        } catch (\Exception $exception) {
            return redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function generateTalon(Request $request)
    {
        $data = Schedule::where('id', '=', $request->id)
            ->with('user')
            ->with('doctor')
            ->get()
            ->first();
        $department = Department::where('id', '=', $data->doctor->department_id)->get()->first();
        return view('frontend.talon', compact('data', 'department'));
    }


}
