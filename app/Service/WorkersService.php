<?php

namespace App\Services;

use App\Entity\Workers;

Class WorkersService
{

    public function getWorkersInfo()
    {
        return Workers::leftjoin('specializations', 'workers.specialization_id', '=', 'specializations.id')
            ->join('position_helds', 'workers.position_id', '=', 'position_helds.id')
            ->join('departments', 'workers.department_id', '=', 'departments.id')
            ->join('users', 'workers.user_id', '=', 'users.id')
            ->select(['*',
                'departments.title as departmentName',
                'departments.address as departmentAddress',
                'position_helds.name as positionWorker',
                'specializations.name as specializationWorker',
                'workers.id as idWorker',
            ])
            ->get();
    }

    public function getWorkerInfo($id)
    {
        return Workers::leftjoin('specializations', 'workers.specialization_id', '=', 'specializations.id')
            ->join('position_helds', 'workers.position_id', '=', 'position_helds.id')
            ->join('departments', 'workers.department_id', '=', 'departments.id')
            ->join('users', 'workers.user_id', '=', 'users.id')
            ->select(['*',
                'departments.title as departmentName',
                'departments.address as departmentAddress',
                'position_helds.name as positionWorker',
                'specializations.name as specializationWorker',
                'workers.id as idWorker',
                'specializations.id as specializationId',
                'position_helds.id as positionHeldsId',
                'departments.id as departmentsId',
            ])
            ->where('workers.id', '=', $id)
            ->get()
            ->first();
    }

    public function getDataForCreateUser($request)
    {
        return $request->only(
            'name',
            'password',
            'email',
            'image '
        );
    }

    public function getDataForCreateWorker($request, $user)
    {
        $dateFromRequst = $request->except(
            'password',
            'email',
            'image'
        );
        $dateFromRequst['user_id'] = $user->id;
        return $dateFromRequst;
    }
    
    
    
}