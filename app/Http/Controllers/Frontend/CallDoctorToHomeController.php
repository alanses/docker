<?php

namespace App\Http\Controllers\Frontend;

use App\Entity\HomeCallDoctor;
use ErrorException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CallDoctorToHomeController extends Controller
{
    public function saveDoctorsCallAtHome(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|min:3',
            'last_name'   => 'required|string|min:3',
            'second_name' => 'string|min:3',
            'email'       => 'required',
            'phone'       => 'required',
            'address'    => 'required|string|min:3',
        ]);

        if (count($validator->errors())) {
            return response()->json(['formError' => $validator->errors(),'status' => 0], 400);
        }

        try {
            HomeCallDoctor::create($request->all());
            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response(['status' => 0], 400);
        }
    }
}
