<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Department;
use App\Entity\PositionHeld;
use App\Entity\Specialization;
use App\Entity\Workers;
use App\Services\PhotoService;
use App\Services\WorkersService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WorkersService $workersService)
    {
        $data = $workersService->getWorkersInfo();
        return view('admin.workers.workers', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $position_helds = PositionHeld::all();
        $specializations = Specialization::all();
        return view('admin.workers.create', compact('departments', 'position_helds', 'specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PhotoService $photo, WorkersService $workersService)
    {
        $user = User::create($workersService->getDataForCreateUser($request));
        $worker = Workers::create($workersService->getDataForCreateWorker($request, $user));

        if ($request->hasFile('image')) {
            $photo->savePhoto($request, $user);
        }
        return redirect('admin/workers')->with('message', 'Працівник добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, WorkersService $workersService)
    {
        $data = $workersService->getWorkerInfo($id);
        return view('admin.workers.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, WorkersService $workersService)
    {
        $data = $workersService->getWorkerInfo($id);
        $departments = Department::all();
        $position_helds = PositionHeld::all();
        $specializations = Specialization::all();
        return view('admin.workers.edit', compact('data', 'departments', 'position_helds', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PhotoService $photoService, WorkersService $workersService)
    {
        $worker = Workers::findOrFail($id);
        $user = User::findOrFail($worker->user_id);
        $worker->update($workersService->getDataForCreateWorker($request, $user));
        $user->update($workersService->getDataForCreateUser($request));

        if ($request->hasFile('image')) {
            $photoService->updatePhoto($request, $user);
        }

        return redirect('admin/workers')->withSuccess('Працівник змінений');
    }

    public function destroy($id)
    {
        $worker = Workers::findOrFail($id);
        $user = User::findOrFail($worker->user_id);
        $worker->delete();
        $user->delete();
        return redirect('admin/workers')->with('message', "Працівник " . $worker->name . " видалений");
    }
}
